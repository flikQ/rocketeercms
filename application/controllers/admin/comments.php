<?php

class Comments extends Admin_Controller {

	public $menu = array(
		'show' => TRUE
	);

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$comment = new Comment;
		$base_url = '/admin/comments/index/';
		$resource = param('resource');
		if($resource) {
			$base_url .= 'resource/'.$resource.'/';
			$comment->where('resource', $resource);
		}
		$total_rows = $comment->count();
		$this->load->library('pagination');
		$this->pagination->initialize(array(
			'total_rows' => $total_rows,
			'base_url' => $base_url.'page/',
			'per_page' => 20,
			'uri_segment' => 'page',
			'full_tag_open' => '<ul>',
			'full_tag_close' => '</ul>',
			'first_link' => '',
			'last_link' => '',
			'previous_link' => '',
			'next_link' => '',
			'cur_tag_open' => '<li class="active">',
			'cur_tag_close' => '</li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>'
		));
		$resources = $this->db->distinct()->select('resource')->get('comments')->result_object();
		$this->load->view('comments/index', array(
			'comments' => $comment->limit(20)->offset((int) param('page'))->get(),
			'pagination' => $this->pagination->create_links(),
			'resources' => $resources
		));
	}
	
	public function remove() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$comment = new Comment($id);
		if(! $comment->exists()) {
			show_404();
		}
		$comment->remove();
		redirect('admin/comments/index');
	}
	
	public function edit() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$comment = new Comment($id);
		if(! $comment->exists()) {
			show_404();
		}
		$this->layout->js = array('jquery-1.5.1.min', 'tiny_mce/jquery.tinymce', 'init-tinymce');
		$this->load->view('comments/edit', array(
			'comment' => $comment
		));
	}
	
	public function update() {
		$id = $this->input->post('id');
		if(! $id) {
			show_error('Undefined Comment ID');
		}
		$comment = new Comment($id);
		if(! $comment->exists()) {
			show_404();
		}
		$comment->content = $this->input->post('content');
		if($comment->save() == FALSE) {
			flash('errors', $comment->errors);
			redirect('admin/comments/edit/id/'.$comment->id);
			return;
		}
		redirect('admin/comments/index');
	}

}
