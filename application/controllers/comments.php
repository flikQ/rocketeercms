<?php

class Comments extends MY_Controller {

	public function __construct() {
		parent::__construct();
		if(! user_logged_in()) {
			redirect(login_url());
			return;
		}
	}
	
	public function create()
	{
		$comment              = new Comment;
		$comment->user_id     = current_user()->id;
		$comment->resource    = $this->input->post('resource');
		$comment->resource_id = $this->input->post('resource_id');
		$comment->content     = $this->input->post('comment');
		
		$comment->save();
		
		flash('errors', $comment->errors);
		$this->load->library('user_agent');
		
		if($this->input->post('redirect'))
		{
			redirect($this->input->post('redirect'));
		}
		else
		{
			redirect($comment->resource_model()->resource_url());
		}
	}
	
	
	public function edit() {
		$id = param('comment_id');
		if(! $id) {
			show_404();
		}
		$comment = new Comment($id);
		if(! $comment->exists() || $comment->user_id !== current_user()->id) {
			show_404();
		}
		$this->load->view('comments/edit', array(
			'comment' => $comment
		));
	}
	
	public function update() {
		$id = param('comment_id');
		if(! $id) {
			show_404();
		}
		$comment = new Comment($id);
		if(! $comment->exists() || $comment->user_id !== current_user()->id) {
			show_404();
		}
		$comment->content = $this->input->post('content');
		if($comment->save() == FALSE) {
			flash('errors', $comment->errors);
			redirect(edit_comment_url(param('comment_id')));
			return;
		}
		redirect($comment->resource_model()->resource_url());
	}
	
}
