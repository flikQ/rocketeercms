<?php

class User_Rights extends Admin_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$rights = $this->acl->rights_list();
		$this->load->view('user_rights/index', array(
			'rights' => $rights
		));
	}
	
	public function add() {
		$this->load->view('user_rights/add');
	}
	
	public function create() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'key',
				'label' => 'Key',
				'rules' => 'required'
			)
		));
		if($this->form_validation->run() == FALSE) {
			$errors = array();
			foreach($this->form_validation->_error_array as $field=>$error) {
				array_push($errors, $error);
			}
			flash('errors', $errors);
			redirect('admin/user_rights/add');
			return;
		}
		$key = $this->input->post('key');
		$value = $this->input->post('value');
		if(! $value) {
			$value = '0';
		}
		$this->acl->add_right($key, $value);
		redirect('admin/user_rights/index');
	}
	
	public function remove() {
		$key = param('key');
		if(! $key) {
			show_404();
		}
		$this->acl->remove_right($key);
		redirect('admin/user_rights/index');
	}

}
