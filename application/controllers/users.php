<?php

class Users extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		
		$user = new User();
		$base_url = players_url();
		$total_rows = $user->count();
		$per_page = setting('users.per_page', FALSE, 50);
		$user->offset((int) param('page'))->limit($per_page);
		$users = $user->get();
		$this->load->library('pagination');
		$this->pagination->initialize(array(
			'base_url' => $base_url.'page/',
			'total_rows' => $total_rows,
			'per_page' => $per_page,
			'uri_segment' => 'page'
		));
		$this->load->view('users/index', array(
			'users' => $users,
			'pagination' => $this->pagination->create_links()
		));
	}
	
	public function show() {
		
		$username = param('username');
		if($username) {
			$user = new User;
			$_user = $user->find_by_username($username);
			$user = $_user ? $_user : current_user();
		} else {
			$user = current_user();
		}
		if(! $user) {
			show_404();
		}
		$_meta = $this->db->where('user_id', $user->id)->limit(1)->get('meta')->result_object();
		$meta = array();
		foreach($_meta[0] as $key=>$value) {
			if(! in_array($key, array('id', 'user_id', 'twt_id', 'fb_id', 'first_name', 'last_name'))) {
				$meta[$key] = $value;
			}
		}
		
		$this->load->view('users/show', array(
				'user' => $user,
				'meta' => $meta
		));
		
	}
		
	public function edit() {
		
		// Load country helper
		$this->load->helper('country');
		
		if(!user_logged_in())
		{
			// User not logged in redirect
			redirect('login?redirect=profile/edit', 'refresh');
		}
		
		$user = current_user();
		$_meta = $this->db->where('user_id', $user->id)->limit(1)->get('meta')->result_object();
		$meta = array();
		foreach($_meta[0] as $key=>$value) {
			if(! in_array($key, array('id', 'user_id', 'twt_id', 'fb_id', 'first_name', 'last_name'))) {
				$meta[$key] = $value;
			}
		}
		$this->load->view('users/edit', array(
			'user' => $user,
			'meta' => $meta
		));
	}
	
	public function update() {
		$user = current_user();
		$data = $this->input->post('user');
		
		// Remove email from here or things get painful
		if(isset($data['email']))
		{
			unset($data['email']);
		}
		
		if($data['password']) {
			$data['password'] = $this->ion_auth_model->hash_password($data['password'], $user->salt);
			$data['remember_code'] = '';
		} else {
			unset($data['password']);
		}
		if($user->username !== $data['username'] && username_check($data['username'])) {
			flash('errors', array($data['username'].' is already taken'));
			redirect(edit_profile_url());
			return;
		}
		$user->data($data);
		if(! $user->save()) {
			flash('errors', $user->errors);
			redirect(edit_profile_url());
			return;
		}
		
		$meta = $this->input->post('meta');
		
		if($meta && count($meta) > 0) {
		
			// Filter meta data, strip out html tags
			$filtered_meta = array();
			
			foreach($meta as $key => $value)
			{
				$filtered_meta[$key] = strip_tags($value);
			}
		
			$this->db->where('user_id', $user->id)->update('meta', $meta);
		}
		
		// Redirect user to their profile
		redirect(profile_url());
	}

	public function del_avatar()
	{
		if (!user_logged_in())
		{
			redirect('login?redirect=profile/edit', 'refresh');
		}

		$this->user_model->update($this->session->userdata('user_id'), array(
			'avatar_url' => '',
			'avatar_thumb_url' => '',
			'avatar_thumb_path' => '',
			'avatar_filename' => '',
			'avatar_mime' => '',
			'avatar_size' => '',
			'avatar_path' => ''
		), TRUE);
		
		redirect('profile/edit');
	}
}
