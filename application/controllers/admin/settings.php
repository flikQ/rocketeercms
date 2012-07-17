<?php

class Settings extends Admin_Controller {

	public $menu = array(
		'show' => TRUE
	);

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$setting = new Setting;
		$category = param('category');
		if($category) {
			$setting->where('category_name', $category);
		}
		$_settings = $setting->get();
		$result = $this->db->distinct()->select('category_name')->get('settings')->result_object();
		$categories = array();
		foreach($result as $item) {
			$categories[$item->category_name] = $item->category_name;
		}
		$settings = array();
		foreach($_settings as $setting) {
			$settings[$setting->category_name][] = $setting;
		}
		
        $settings = array_reverse($settings);
		
		$this->load->view('settings/index', array(
			'settings' => $settings,
			'categories' => $categories
		));
	}
	
	public function add() {
		$result = $this->db->distinct()->select('category_name')->get('settings')->result_object();
		$categories = array();
		foreach($result as $item) {
			$categories[$item->category_name] = $item->category_name;
		}
		$this->load->view('settings/add', array(
			'categories' => $categories
		));
	}
	
	public function create() {
		$setting = new Setting;
		$setting->key = $this->input->post('key');
		$setting->value = $this->input->post('value');
		$setting->category_name = $this->input->post('category_name');
		if($setting->save() == FALSE) {
			flash('errors', $setting->errors);
			redirect('admin/settings/add');
			return;
		}
		redirect('admin/settings/index');
	}
	
	public function edit() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$setting = new Setting($id);
		if(! $setting->exists()) {
			show_404();
		}
		$result = $this->db->distinct()->select('category_name')->get('settings')->result_object();
		$categories = array();
		foreach($result as $item) {
			$categories[$item->category_name] = $item->category_name;
		}
		$this->load->view('settings/edit', array(
			'setting' => $setting,
			'categories' => $categories
		));
	}
	
	public function update() {
		$id = $this->input->post('id');
		if(! $id) {
			show_error('Unknown Setting ID');
		}
		$setting = new Setting($id);
		if(! $setting->exists()) {
			show_404();
		}
		$setting->key = $this->input->post('key');
		$setting->value = $this->input->post('value');
		$setting->category_name = $this->input->post('category_name');
		if($setting->save() == FALSE) {
			flash('errors', $setting->errors);
		}
		redirect('admin/settings/index');
	}
	
	public function multi_update() {
		$settings = $this->input->post('settings');
		if(is_array($settings) && count($settings) > 0) {
			foreach($settings as $key=>$value) {
				$setting = new Setting;
				$setting = $setting->find_by_key($key);
				if($setting->exists()) {
					$setting->value = $value;
					$setting->save();
				}
			}
		}
		
		// Background change feature
		$config['upload_path'] = './uploads/backgrounds/';
		$config['allowed_types'] = 'jpg';
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);
		$this->upload->do_upload('background');
		@chmod(FCPATH . 'uploads/backgrounds/takeover.jpg', 0777);
		
		redirect('admin/settings/index');
	}
	
	/**
	* Delete takeover background
	*
	* @access	public
	* @return	void
	*/
	public function delete_takeover()
	{
		$file_path = FCPATH . 'uploads/backgrounds/takeover.jpg';
	
		if(file_exists($file_path))
		{
			@unlink($file_path);
		}
	
		redirect('/admin/settings/index');
	}
	
	public function remove() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$setting = new Setting($id);
		if(! $setting->exists()) {
			show_404();
		}
		$setting->remove();
		redirect('admin/settings/index');
	}

}
