<?php

class Forum_Threads extends Admin_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$thread = new Forum_Thread;
		$base_url = '/admin/forum_threads/index/';
		$total_rows = $thread->count();
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
		$this->load->view('forum_threads/index', array(
			'threads' => $thread->limit(20)->offset((int) param('page'))->get(),
			'pagination' => $this->pagination->create_links()
		));
	}
	
	public function remove() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$thread = new Forum_Thread($id);
		if(! $thread->exists()) {
			show_404();
		}
		$thread->remove();
		
		$this->db->where('thread_id', $thread->id);
		$this->db->delete('forum_posts');
		
		redirect('admin/forum_threads/index');
	}
	
	public function edit() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$thread = new Forum_Thread($id);
		if(! $thread->exists()) {
			show_404();
		}
		
		$post = new Forum_Post();
		$post->where('thread_id', $thread->id)->order_by('created_at', 'asc');
		$posts = $post->get();
		
		$this->layout->js = array('jquery-1.5.1.min', 'tiny_mce/jquery.tinymce', 'init-tinymce');
		$this->load->view('forum_threads/edit', array(
			'thread' => $thread,
			'posts' => $posts
		));
	}
	
	public function update() {
		$id = $this->input->post('id');
		if(! $id) {
			show_error('Undefined Thread ID');
		}
		$thread = new Forum_Thread($id);
		if(! $thread->exists()) {
			show_404();
		}
		
		$thread->title = $this->input->post('title');
		
		if($thread->save() == FALSE) {
			flash('errors', $thread->errors);
			redirect('admin/forum_threads/edit/id/'.$thread->id);
			return;
		}
		redirect('admin/forum_threads/index');
	}

}
