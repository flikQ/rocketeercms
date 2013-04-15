<?php

class Forums extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->load->model("newmod/user_model");
		$forum = new Forum_Section(); 

		$recently_online = $this->user_model->get_recently_online();

		$threads = $forum->order_by('order', 'asc')->get();
		$this->load->view('forums/index', array(
			'sections' => $threads,
			'recently_online' => $recently_online
		));

	}
	
	public function new_thread() {
		$this->layout->js = array('jquery-1.5.1.min', 'tiny_mce/jquery.tinymce', 'init-tinymce', 'jquery-ui-1.8.min', 'jquery-ui-timepicker.min', 'init-datepickers', 'jquery.tokeninput.min', 'init-games-tokeninputs', 'gallery.edit', 'gallery.progress');
		
		$this->load->view('forums/new_thread');
	}
	
	public function create_thread() {
		$current_user = current_user();
		$thread = new Forum_Thread();
		$forum = new Forum;
		$forum = $forum->find_by_url_name(param('name'));
		if(! $forum) {
			show_404();
		}
		$thread->forum_id = $forum->id;
		unset($forum);
		$thread->user_id = $current_user->id;
		$thread->title = $this->input->post('title');
		$thread->sticky = $this->input->post('sticky');
		
		if($thread->save() == TRUE) {
			$post = new Forum_Post();
			$post->thread_id = $thread->id;
			$post->content = $this->input->post('content');
			
			$post->user_id = $current_user->id;
			if($post->save() == FALSE) {
				flash('errors', $post->errors);
				redirect(new_forum_thread_url(param('name')));
				return;
			}
			redirect(forum_thread_url(param('name'), $thread->url_title));
			return;
		}
		flash('errors', $thread->errors);
		$thread->remove();
		redirect(new_forum_thread_url(param('name')));
	}
	
	public function show_thread() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$thread = new Forum_Thread($id);
		if(! $thread->exists()) {
			show_404();
		}
		if( ($thread->forum->section_id == 15) && (current_user()->group_id == 2 or !user_logged_in()) )  {
			show_404();
		}

		$post = new Forum_Post();
		$total_rows = $post->where('thread_id', $thread->id)->count();
		$offset = (int) param('page');
		$per_page = setting('forums.posts_per_page', FALSE, 20);
		$this->load->library('pagination');
		$this->pagination->initialize(array(
			'base_url' => forum_thread_url(param('name'), $id, param('title'), ''),
			'per_page' => $per_page,
			'uri_segment' => 'page',
			'total_rows' => $total_rows
		));
		$post->limit($per_page)->offset($offset)->order_by('created_at', 'asc');
		$posts = $post->get();
		$this->layout->js = array('jquery-1.5.1.min', 'tiny_mce/jquery.tinymce', 'init-tinymce', 'jquery-ui-1.8.min', 'jquery-ui-timepicker.min', 'init-datepickers', 'jquery.tokeninput.min', 'init-games-tokeninputs', 'gallery.edit', 'gallery.progress');
		
		$this->load->view('forums/show_thread', array(
			'thread' => $thread,
			'posts' => $posts,
			'pagination' => $this->pagination->create_links()
		));

		//Update viewcount - avoids TinyMapper (yay)

		$thread = new Forum_Thread($id);

		$current_views = $thread->view_count; 

		$this->db->where('id', $id)->update('forum_threads', array('view_count' => $current_views + 1)); 
	}
	
	public function edit_thread() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$thread = new Forum_Thread($id);
		if(! $thread->exists()) {
			show_404();
		}
		$forum = new Forum;
		$forums = array();
		foreach($forum->get() as $item) {
			if($item->id !== $id) {
				$forums[$item->id] = $item->name;
			}
		}
		$post = new Forum_Post;
		$posts = $post->where('thread_id', $thread->id)->order_by('created_at', 'asc')->limit(1)->get();
		$this->layout->js = array('jquery-1.5.1.min', 'tiny_mce/jquery.tinymce', 'init-tinymce', 'jquery-ui-1.8.min', 'jquery-ui-timepicker.min', 'init-datepickers', 'jquery.tokeninput.min', 'init-games-tokeninputs', 'gallery.edit', 'gallery.progress');
		
		$this->load->view('forums/edit_thread', array(
			'thread' => $thread,
			'post' => $posts[0],
			'forum' => $forum,
			'forums' => $forums
		));
	}
	
	public function update_thread() {
		$id = $this->input->post('id');
		if(! $id) {
			show_404();
		}
		$thread = new Forum_Thread($id);
		if(! $thread->exists()) {
			show_404();
		}
		$thread->closed = $this->input->post('closed');
		$thread->sticky = $this->input->post('sticky');
		$thread->title = $this->input->post('title');
		$thread->forum_id = $this->input->post('forum_id');
		if($thread->save() == FALSE) {
			flash('errors', $thread->errors);
			redirect(edit_forum_thread_url(param('name'), param('id'), param('title')));
			return;
		}
		
		$post_id = $this->input->post('post_id');
		if($post_id) {
			$post = new Forum_Post($post_id);
			if($post->exists()) {
				$post->content = $this->input->post('content');
				if($post->save() == FALSE) {
					flash('errors', $post->errors);
					redirect(edit_forum_thread_url(param('name'), param('id'), param('title')));
					return;
				}
			}
		}
		redirect(forum_thread_url(param('name'), param('id'), param('title')));
	}
	
	public function new_post() {
		$this->load->view('forums/new_post');
	}
	
	public function create_post() {
		$post = new Forum_Post();
		$post->user_id = current_user()->id;
		$thread = new Forum_Thread(param('id'));
		if(! $thread->exists()) {
			show_404();
		}
		$post->thread_id = $thread->id;
		$post->content = $this->input->post('content');
		if($post->save() == FALSE) {
			flash('errors', $post->errors);
			redirect(new_forum_post_url(param('name'), param('id'), param('title')));
			return;
		}
		
		redirect(forum_thread_url(param('name'), param('id'), param('title')));
	}
	
	public function edit_post() {
		$id = param('post_id');
		if(! $id) {
			show_404();
		}
		$post = new Forum_Post($id);
		if( (current_user()->group_id != 1 ) && (current_user()->group_id != 6 )) {
			if( (! $post->exists()) || ($post->user_id != current_user()->id)) {
				show_404();
			}
		}
		$this->layout->js = array('jquery-1.5.1.min', 'tiny_mce/jquery.tinymce', 'init-tinymce', 'jquery-ui-1.8.min', 'jquery-ui-timepicker.min', 'init-datepickers', 'jquery.tokeninput.min', 'init-games-tokeninputs', 'gallery.edit', 'gallery.progress');
		
		$this->load->view('forums/edit_post', array(
			'post' => $post
		));
	}
	
	public function update_post() {
		$id = param('post_id');
		if(! $id) {
			show_404();
		}
		$post = new Forum_Post($id);
		if( (current_user()->group_id != 1 ) && (current_user()->group_id != 6 )) {
			if( (! $post->exists()) || ($post->user_id != current_user()->id)) {
				show_404();
			}
		}
		$post->content = $this->input->post('content');
		if($post->save() == FALSE) {
			flash('errors', $post->errors);
			redirect(edit_forum_post_url(param('name'), param('title'), param('id'), param('post_id')));
			return;
		}
		redirect(forum_thread_url(param('name'), param('id'), param('title')));
	}
	
	public function show_threads() {
		$name = param('name');
		if(! $name) {
			show_404();
		}
		$forum = new Forum;
		$forum = $forum->find_by_url_name($name);
		if(! $forum) {
			show_404();
		}
		if(($forum->section_id == 15) && (current_user()->group_id == 2 or !user_logged_in()) ) {
			show_404();
		}
		$thread = new Forum_Thread();
		$total_rows = $thread->where('forum_id', $forum->id)->count();
		$per_page = setting('forums.threads_per_page', FALSE, 50);
		$this->load->library('pagination');
		$this->pagination->initialize(array(
			'uri_segment' => 'page',
			'total_rows' => $total_rows,
			'per_page' => $per_page,
			'base_url' => forum_threads_url(param('name'), '')
		));
		$offset = (int) param('page');
		$threads = $thread->limit($per_page)->offset($offset)->order_by('updated_at', 'desc')->get();
		$this->load->view('forums/show_threads', array(
			'forum' => $forum,
			'threads' => $threads,
			'pagination' => $this->pagination->create_links()
		));




		
		
		
	}
	
}
