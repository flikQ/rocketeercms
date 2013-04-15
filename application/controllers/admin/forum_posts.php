<?php

class Forum_Posts extends Admin_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$post = new Forum_Post;
		$base_url = '/admin/forum_posts/index/';
		$total_rows = $post->count();
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
		$this->load->view('forum_posts/index', array(
			'posts' => $post->limit(20)->offset((int) param('page'))->get(),
			'pagination' => $this->pagination->create_links()
		));
	}
	
	public function remove() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$post = new Forum_Post($id);
		if(! $post->exists()) {
			show_404();
		}
		$post->remove();
		redirect('admin/forum_posts/index');
	}
	
	public function edit() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$post = new Forum_Post($id);
		if(! $post->exists()) {
			show_404();
		}
		$this->layout->js = array('jquery-1.5.1.min', 'tiny_mce/jquery.tinymce', 'init-tinymce');
		$this->load->view('forum_posts/edit', array(
			'post' => $post
		));
	}
	
	public function update() {
		$id = $this->input->post('id');
		if(! $id) {
			show_error('Undefined Post ID');
		}
		$post = new Forum_Post($id);
		if(! $post->exists()) {
			show_404();
		}
		$post->content = $this->input->post('content');
		if($post->save() == FALSE) {
			flash('errors', $post->errors);
			redirect('admin/forum_posts/edit/id/'.$post->id);
			return;
		}
		redirect('admin/forum_posts/index');
	}

}
