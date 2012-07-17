<?php

class TinyMapper {

	protected
		$CI,
		$_properties = array(
			'class' => NULL,
			'table' => NULL,
			'action' => NULL,
			'object' => NULL,
			'primary_key' => NULL,
			'primary_key_field' => 'id'
		),
		$sandbox = array();
	public
		$errors = array();

	public function __construct($key = NULL) {
		$this->_properties['class'] = get_called_class();
		if($this->_properties['class'] == 'TinyMapper') {
			return;
		}
		$this->CI =& get_instance();
		$this->CI->load->helper('inflector');
		$this->_properties['table'] = isset($this->table) ? $this->table : plural($this->_properties['class']);
		$this->_properties['action'] = ($key == NULL) ? 'new' : 'edit'; // new or existing object
		if(is_object($key)) { // if $id is an object, we will not load data from DB
			$this->_properties['object'] = $key;
			if(method_exists($this, '__post_load')) {
				$this->__post_load($key);
			}
		}
		if(isset($this->primary_key)) {
			$this->_properties['primary_key_field'] = $this->primary_key;
		}
		$this->_properties['primary_key'] = is_object($key) && isset($key->{$this->_properties['primary_key_field']}) ? $key->{$this->_properties['primary_key_field']} : $key; // anyway, we need ID
	}
	
	public function sandbox_on() {
		foreach(get_object_vars($this->CI->db) as $key=>$value) {
			if(strpos($key, 'ar_') === 0) {
				$this->sandbox[$key] = $value;
				$this->CI->db->$key = is_array($value) ? array() : FALSE;
			}
		}
	}
	
	public function sandbox_off() {
		foreach($this->sandbox as $key=>$value) {
			$this->CI->db->$key = $value;
		}
		$this->sandbox = array();
	}
	
	public function exists() {
		$this->load_object();
		return is_object($this->_properties['object']);
	}
	
	protected function load_object() {
		if($this->_properties['action'] == 'edit') {
			$this->CI->db->_reset_select();
			if(method_exists($this, '__pre_load')) {
				$this->__pre_load();
			}
			
			$this->sandbox_on();
			$object = $this->CI->db->where($this->_properties['primary_key_field'], $this->_properties['primary_key'])->limit(1)->get($this->_properties['table'])->result_object();
			$this->sandbox_off();
			if(isset($object[0])) {
				$this->_properties['object'] = $object[0];
				if(isset($this->_properties['object']->{$this->created_field})) {
					$this->_properties['object']->{'original_'.$this->created_field} = $this->_properties['object']->{$this->created_field};
				}
				if(isset($this->_properties['object']->{$this->updated_field})) {
					$this->_properties['object']->{'original_'.$this->updated_field} = $this->_properties['object']->{$this->updated_field};
				}
			} else {
				return;
			}
			if(method_exists($this, '__post_load')) {
				$this->__post_load($this->_properties['object']);
			}
		}
	}
	
	public function __isset($key) {
		return isset($this->_properties['object']->$key);
	}
	
	public function __unset($key) {
		unset($this->_properties['object']->$key);
	}
	
	public function __get($key) {
		if(! is_object($this->_properties['object'])) { // if object is not loaded
			switch($this->_properties['action']) {
				case 'new':
					return FALSE;
				case 'edit':
					$this->load_object(); // load that object
					break;
			}
		}
		if(isset($this->_properties['object']->$key)) { // if object field wanted
			if((isset($this->created_field) && $key == $this->created_field) || (isset($this->updated_field) && $key == $this->updated_field)) {
				return date('D jS M Y - g:ia', $this->_properties['object']->$key);
			}
			return $this->_properties['object']->$key;
		}
		$_key = $key;
		$key = isset($this->as) && isset($this->as[$key]) ? $this->as[$key] : $key;
		if(isset($this->has_many) && in_array($key, $this->has_many)) { // has_many association!
			$model_name = str_replace(' ', '_', ucwords(singular(humanize($key)))); // user_posts to User_Post
			if(isset($this->where[$key])) { // where property allows to set additional WHERE for query
				foreach($this->where[$key] as $field=>$value) {
					$this->CI->db->where($field, $value);
				}
			}
			$model = new $model_name;
			// @TODO
			if(isset($model->order_by)) {
				$this->CI->db->order_by($model->order_by[0], $model->order_by[1]);
			} elseif(isset($model->created_field)) {
				$this->CI->db->order_by($model->created_field, 'desc');
			} elseif(isset($model->updated_field)) {
				$this->CI->db->order_by($model->updated_field, 'desc');
			} elseif(isset($model->primary_key)) {
				$this->CI->db->order_by($model->primary_key, 'desc');
			} else {
				$this->CI->db->order_by('id', 'desc');
			}
			unset($model);
			$results = $this->CI->db->where((isset($this->foreign_keys[$key]) ? $this->foreign_keys[$key] : strtolower($this->_properties['class']).'_'.$this->_properties['primary_key_field']),$this->_properties['primary_key'])->get($key);
			$this->_properties['object']->$_key = array();
			foreach($results->result_object() as $result) {
				array_push($this->_properties['object']->$_key, new $model_name($result)); // convert plain DB result data to TinyMapper model
			}
		}
		if(isset($this->belongs_to) && in_array($key, $this->belongs_to) || isset($this->has_one) && in_array($key, $this->has_one)) { // belongs_to and has_one associations
			$model_name = str_replace(' ', '_', humanize($key)); // user_post to User Post
			$foreign_key = (isset($this->foreign_keys) && isset($this->foreign_keys[$key])) ? $this->foreign_keys[$key] : $_key.'_'.$this->_properties['primary_key_field'];
			$result = $this->CI->db->get_where(plural($key), array('id' => $this->__get($foreign_key)), 1)->result_object();
			if(isset($result[0]) && is_object($result[0])) {
				$this->_properties['object']->$_key = new $model_name($result[0]);
			}
		}
		return isset($this->_properties['object']->$_key) ? $this->_properties['object']->$_key : NULL;
	}
	
	public function __set($key, $value) {
		if(! isset($this->_properties['object'])) {
			switch($this->_properties['action']) {
				case 'new':
					$this->_properties['object'] = new stdClass;
					break;
				case 'edit':
					$this->load_object();
					break;
			}
		}
		$this->_properties['object']->$key = $value;
	}
	
	public function save($upload = TRUE) {
		if(is_object($this->_properties['object'])) {
			foreach($this->_properties['object'] as $key) { // delete has_many, belongs_to, has_one associations
				if(is_object($key)) {
					unset($this->_properties['object']->$key);
				}
			}
		}
		if(isset($this->created_field, $this->_properties['object']->{'original_'.$this->created_field})) {
			unset($this->_properties['object']->{'original_'.$this->created_field});
		}
		if(isset($this->updated_field, $this->_properties['object']->{'original_'.$this->updated_field})) {
			unset($this->_properties['object']->{'original_'.$this->updated_field});
		}
		if(isset($this->validation)) { // Validation
			$__POST = $_POST;
			foreach($this->_properties['object'] as $key=>$value) {
				$_POST[$key] = $value; // dirty hack for CI Validation
			}
			$this->CI->load->library('form_validation');
			$this->CI->form_validation->set_rules($this->validation);
			if($this->CI->form_validation->run() == FALSE) {
				foreach($this->_properties['object'] as $key=>$value) {
					flash('field_'.$key, $value);
				}
				foreach($this->CI->form_validation->_error_array as $field=>$error) {
					array_push($this->errors, $error);
				}
				$_POST = $__POST;
				return FALSE;
			}
			$_POST = $__POST;
		}
		if(isset($this->updated_field)) { // updated_field is needed for both new and edit actions
			$name = $this->updated_field;
			$this->_properties['object']->$name = time();
			unset($name);
		}
		if(method_exists($this, '__pre_save')) {
			$this->__pre_save($upload);
		}
		if(isset($this->has_attached) && $upload == TRUE) {
			$result = $this->has_attached($this->has_attached);
			if(! $result) {
				return FALSE;
			}
		}
		unset($this->_properties['object']->{$this->_properties['primary_key_field']});
		switch($this->_properties['action']) {
			case 'new':
				if(method_exists($this, '__pre_create')) {
					$this->__pre_create();
				}
				if(isset($this->created_field)) {
					$this->_properties['object']->{$this->created_field} = time();
				}
				$this->CI->db->insert($this->_properties['table'], $this->_properties['object']);
				$this->_properties['primary_key'] = $this->CI->db->insert_id(); // update ID
				$this->_properties['action'] = 'edit';
				$this->_properties['object']->{$this->_properties['primary_key_field']} = $this->_properties['primary_key'];
				if(isset($this->number_field_on)) {
					foreach($this->number_field_on as $model_name) {
						$_model_name = str_replace(' ', '_', humanize(singular($model_name)));
						if(class_exists($_model_name)) {
							$test_model = new $_model_name;
							$primary_key_field = $model_name.'_id';
							if(isset($test_model->foreign_keys, $test_model->foreign_keys[plural($this->_properties['class'])])) {
								$primary_key_field = $test_model->foreign_keys[plural($this->_properties['class'])];
							}
							unset($test_model);
							if(isset($this->as)) {
								foreach($this->as as $key=>$value) {
									if($value == str_replace('_id', '', $primary_key_field)) {
										$primary_key_field = $key.'_id';
										break;
									}
								}
							}
							if(isset($this->_properties['object']->$primary_key_field)) {
								$primary_key = $this->_properties['object']->$primary_key_field;
								$model = new $_model_name($primary_key);
								$number_key = plural($this->_properties['class']).'_number';
								$model->$number_key = $model->$number_key + 1;
								$model->save();
							}
						}
					}
				}
				if(method_exists($this, '__post_create')) {
					$this->__post_create();
				}
				break;
			case 'edit':
				if(method_exists($this, '__pre_edit')) {
					$this->__pre_edit();
				}
				$this->CI->db->where($this->_properties['primary_key_field'], $this->_properties['primary_key'])->set($this->_properties['object'])->update($this->_properties['table']);
				if(method_exists($this, '__post_edit')) {
					$this->__post_edit();
				}
				break;
		}
		$this->_properties['object']->{$this->_properties['primary_key_field']} = $this->_properties['primary_key'];
		if(method_exists($this, '__post_save')) {
			$this->__post_save();
		}
		return TRUE;
	}
	
	public function remove() {
		if(method_exists($this, '__pre_remove')) {
			$this->__pre_remove($this->_properties['object']);
		}
		$this->CI->db->where($this->_properties['primary_key_field'], $this->_properties['primary_key'])->limit(1)->delete($this->_properties['table']);
		if(isset($this->has_attached)) { // we need to clean saved files, right?
			if(file_exists($this->_properties['object']->{$this->has_attached['field_name'].'_path'})) {
				unlink($this->_properties['object']->{$this->has_attached['field_name'].'_path'});
			}
			if(file_exists($this->_properties['object']->{$this->has_attached['field_name'].'_thumb_path'})) {
				unlink($this->_properties['object']->{$this->has_attached['field_name'].'_thumb_path'});
			}
		}
		if($this->dependent == TRUE) { // if other models are dependent on what TinyMapper deletes
			if(isset($this->has_many)) { // delete models in has_many association
				foreach($this->has_many as $name) {
					$models = $this->__get($name);
					foreach($models as $model) {
						$model->remove();
					}
				}
			}
			if(isset($this->has_one)) { // delete models in has_one association
				foreach($this->has_one as $name) {
					$this->__get($name)->remove();
				}
			}
		}
		if(method_exists($this, '__post_remove')) {
			$this->__post_remove($this->_properties['object']);
		}
	}
	
	public function count($resource = '') {
		// seperate count() method created because
		// after count_all_results(), get(), get_where and such methods
		// CI cleans query options(WHERE, ORDER BY, LIMIT, OFFSET, etc)
		// TinyMapper needs to save the world!
		$where = $this->CI->db->ar_where;
		$this->sandbox_on();
		$this->CI->db->ar_where = $where;
		$table = $this->_properties['table'];
		if($resource) {
			$key = isset($this->foreign_keys, $this->foreign_keys[$resource]) ? $this->foreign_keys[$resource] : singular($this->_properties['class']).'_'.$this->_properties['primary_key_field'];
			//$this->CI->db->ar_where = $where;
			$this->CI->db->where($key, $this->_properties['primary_key']);
			$table = isset($this->as, $this->as[$resource]) ? $this->as[$resource] : $resource;
		}
		$count = $this->CI->db->count_all_results($table, FALSE);
		$this->sandbox_off();
		return $count;
	}
	
	public function get() { // also, TinyMapper needs its own get()
		if(isset($this->created_field)) {
			$this->CI->db->order_by($this->created_field, 'desc');
		} elseif(isset($this->updated_field)) {
			$this->CI->db->order_by($this->updated_field, 'desc');
		} elseif(isset($this->primary_key)) {
			$this->CI->db->order_by($this->primary_key, 'desc');
		} else {
			$this->CI->db->order_by('id', 'desc');
		}
		$result = $this->CI->db->get($this->_properties['table']);
		if($result->num_rows() > 0) {
			$models = array();
			$model_name = ucfirst($this->_properties['class']);
			foreach($result->result_object() as $item) {
				$model = new $model_name($item);
				$models[] = $model;
			}
			return $models;
		}
		return array();
	}
	
	public function from($resource, $resource_name) {
		$_resource = isset($this->as, $this->as[$resource]) ? $this->as[$resource] : $resource;
		$model_name = str_replace(' ', '_', humanize($_resource));
		$model = new $model_name;
		$model = $model->find_by_name($resource_name);
		if($model) {
			$value = $model->name || $model->title;
			$this->CI->db->where($resource.'_id', $value);
		}
		return $this;
	}
	
	public function has_attached($config) {
		
		// Check nothing uploaded
		$nothing_uploaded = TRUE;
		
		foreach($_FILES as $file)
		{
			if(strlen($file['name']) > 0)
			{
				$nothing_uploaded = FALSE;
				break;
			}
		}

		if(isset($config['required']) && $nothing_uploaded)
		{
			return TRUE;
		}
		
		if(! isset($config['upload_path'], $config['field_name'])) {
			return FALSE;
		}
		$is_required = (isset($config['required']) && $config['required'] == TRUE) ? TRUE : FALSE;
		if(! is_object($this->_properties['object'])) {
			$this->load_object();
		}
		if(! isset($_FILES[$config['field_name']]) || ! isset($_FILES[$config['field_name']]['name']) || $_FILES[$config['field_name']]['name'] == '' && @$this->_properties['object']->{$config['field_name'].'_filename'} !== '') {
			return TRUE;
		}
		if(isset($this->_properties['object']->{$config['field_name'].'_filename'}) && isset($_FILES[$config['field_name']])) {
			$this->_properties['object']->{$config['field_name'].'_filename'} = '';
			$this->_properties['object']->{$config['field_name'].'_size'} = '';
			$this->_properties['object']->{$config['field_name'].'_url'} = '';
			$this->_properties['object']->{$config['field_name'].'_mime'} = '';
			if(file_exists($this->_properties['object']->{$config['field_name'].'_path'})) {
				unlink($this->_properties['object']->{$config['field_name'].'_path'});
			}
			$this->_properties['object']->{$config['field_name'].'_path'} = '';
			if(isset($this->_properties['object']->{$config['field_name'].'_thumb_path'})) {
				if(file_exists($this->_properties['object']->{$config['field_name'].'_thumb_path'})) {
					unlink($this->_properties['object']->{$config['field_name'].'_thumb_path'});
				}
				$this->_properties['object']->{$config['field_name'].'_thumb_path'} = '';
				$this->_properties['object']->{$config['field_name'].'_thumb_url'} = '';
			}
		}
		$config['driver'] OR $config['driver'] = 'files';
		$config['max_size'] = $size = (int) str_replace('M', '', ini_get('upload_max_filesize')) * 1024 * 1024;
		$this->CI->load->library('upload');
		$this->CI->upload->initialize($config);
		if(! $this->CI->upload->do_upload($config['field_name'])) {
			foreach($this->CI->upload->error_msg as $key=>$error) {
				array_push($this->errors, $error);
			}
			return FALSE;
		}
		$data = $this->CI->upload->data();
		$this->_properties['object']->{$config['field_name'].'_filename'} = $data['file_name'];
		$this->_properties['object']->{$config['field_name'].'_size'} = $data['file_size'];
		$this->_properties['object']->{$config['field_name'].'_url'} = str_replace('.', '', $config['upload_path']).'/'.$data['file_name'];
		$this->_properties['object']->{$config['field_name'].'_mime'} = $data['file_type'];
		$this->_properties['object']->{$config['field_name'].'_path'} = $data['full_path'];
		if(isset($this->has_attached['img'])) {
			$this->has_attached['img']['source_image'] = $data['full_path'];
			$this->CI->load->library('image_lib');
			$this->CI->image_lib->initialize($this->has_attached['img']);
			$method = isset($this->has_attached['img']['method']) ? $this->has_attached['img']['method'] : 'resize';
			if(! $this->CI->image_lib->$method()) {
				foreach($this->CI->image_lib->error_msg as $key=>$error) {
					array_push($this->errors, $error);
				}
			} else {
				$this->_properties['object']->{$config['field_name'].'_thumb_url'} = str_replace('.', '', $config['upload_path']).'/'.$data['raw_name'].'_thumb'.$data['file_ext'];
				$this->_properties['object']->{$config['field_name'].'_thumb_path'} = FCPATH.str_replace('.', '', $config['upload_path']).'/'.$data['raw_name'].'_thumb'.$data['file_ext'];
			}
		}
		switch($config['driver']) {
			case 'files':
				return TRUE;
			case 's3':
				break;
			default:
				// @TODO Error
				return FALSE;
		}
	}
	
	public function action() {
		return $this->_properties['action'];
	}
	
	public function data($properties) {
		$this->_properties['object'] = is_array($properties) ? (object) $properties : $properties;
	}
	
	public function properties() {
		$this->load_object();
		return $this->_properties['object'];
	}
	
	public function push($relation, $properties, $upload = TRUE) {
		$model_name = str_replace(' ', '_', ucwords(str_replace('_', ' ', singular($relation))));
		if(! class_exists($model_name)) {
			return FALSE; // Exception to be here
		}
		$model = new $model_name;
		$key = strtolower($this->_properties['class']).'_'.$this->_properties['primary_key_field'];
		if(! isset($properties[$key])) {
			$properties[$key] = $this->_properties['primary_key'];
		}
		$model->data($properties);
		$model->save($upload);
	}
	
	public function find_by($field, $value) {
		$this->sandbox_on();
		$model_name = $this->_properties['class'];
		$model = new $model_name;
		$result = $model->where($field, $value)->limit(1)->get($this->_properties['table']);
		$this->sandbox_off();
		return isset($result[0]) ? $result[0] : NULL;
	}
	
	public function has_relation($name, $amount = 'one') {
		if($amount == 'one') {
			$name = singular($name);
			if(isset($this->as, $this->as[$name])) {
				$name = $this->as[$name];
			}
			return (isset($this->has_one) && in_array($name, $this->has_one)) || (isset($this->belongs_to) && in_array($name, $this->belongs_to));
		}
		$name = plural($name);
		if(isset($this->as, $this->as[$name])) {
			$name = $this->as[$name];
		}
		return isset($this->has_many) && in_array($name, $this->has_many);
	}
	
	public function __call($method, $arguments) { // TinyMapper thinks, that you want to use CI DB's methods
		if(strpos($method, 'find_by') === 0) {
			list($trash, $field) = explode('find_by_', $method);
			return $this->find_by($field, $arguments[0]);
		}
		call_user_func_array(array($this->CI->db, $method), $arguments);
		return $this;
	}

	/**
	 * Retrieve and generate a form_dropdown friendly array (adapted from Jamie Rumbelow's base model)
	 *
	 * @link http://github.com/jamierumbelow/codeigniter-base-model
	 * @copyright Copyright (c) 2012, Jamie Rumbelow <http://jamierumbelow.net>
	 */
	function dropdown()
	{
		$args = func_get_args();

		if(count($args) == 2)
		{
			list($key, $value) = $args;
		}
		else
		{
			$key = $this->_properties['primary_key_field'];
			$value = $args[0];
		}

		$result = $this->CI->db->select(array($key, $value))
						   ->get($this->_properties['table'])
						   ->result();

		$options = array();

		foreach ($result as $row)
		{
			$options[$row->{$key}] = $row->{$value};
		}

		return $options;
	}
}