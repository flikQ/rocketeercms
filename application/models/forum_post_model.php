<?php

class Forum_Post extends TinyMapper {

	protected
		$belongs_to = array('forum_thread', 'user'),
		$table = 'forum_posts',
		$number_field_on = array('forum_thread', 'user'),
		$created_field = 'created_at',
		$updated_field = 'updated_at',
		$as = array(
			'thread' => 'forum_thread'
		),
		$foreign_keys = array(
			'forum_thread' => 'thread_id'
		),
		$validation = array(
			array(
				'field' => 'content',
				'label' => 'Content',
				'rules' => 'required'
			),
			array(
				'field' => 'thread_id',
				'label' => 'Forum thread ID',
				'rules' => 'required|integer'
			),
			array(
				'field' => 'user_id',
				'label' => 'User ID',
				'rules' => 'required|integer'
			)
		);
	
	public function __construct($id = NULL) {
		parent::__construct($id);
	}	
	
	public function __post_save() {
		current_user()->push('activities', array(
			'content' => 'created a forum post in '.link_to($this->thread->title, dynamic_url('forum_threads', $this->thread_id))
		));
	}
	
}
