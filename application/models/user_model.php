<?php

class User extends TinyMapper {

	public
		$has_many = array('articles', 'comments'),		
		$created_field = 'created_on',
		$has_attached = array(
			'upload_path' => './uploads/user_avatars',
			'allowed_types' => 'png|gif|jpeg|jpg',
			'max_size' => 10737418240,
			'driver' => 'files',
			'field_name' => 'avatar',
			'img' => array(
				'create_thumb' => TRUE,
				'width' => 150,
				'height' => 150,
				'maintain_ratio' => TRUE,
				'method' => 'resize'
			)
		);
	private $_loaded_meta = array();

	public function __construct($id = NULL) {
		parent::__construct($id);
	}
	
	public function __post_load($object) {
		$meta = $this->CI->db->get_where('meta', array('user_id' => $object->id), 1)->result_object();
		if(isset($meta[0])) {
			foreach($meta[0] as $key=>$value) {
				if($key !== 'id') {
					$this->_loaded_meta[] = $key;
					$this->$key = $value;
				}
			}
		}
	}
	
	public function __pre_save() {
		$this->has_attached['img']['width'] = setting('users.avatar_width', FALSE, 150);
		$this->has_attached['img']['height'] = setting('users.avatar_height', FALSE, 150);
		foreach($this->_loaded_meta as $prop) {
			unset($this->_properties['object']->$prop);
		}
	}
	
	public function __pre_remove($object) {
		$this->CI->db->where('user_id', $object->id)->delete('meta');
	}	
	
	public function full_name() {
		if($this->first_name || $this->last_name) {
			return $this->first_name.' '.$this->last_name;
		}
		return $this->username;
	}
	
	
	public function avatar($size = 'small')
	{
		return Gravatar_helper::from_user($this->properties(), null, $size);
	}

	
	public function resource_url() {
		return profile_url($this->username);
	}
	
	
}
