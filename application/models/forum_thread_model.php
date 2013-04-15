<?php

class Forum_Thread extends TinyMapper {

	protected
		$has_many = array('forum_posts'),
		$belongs_to = array('forum', 'user'),
		$number_field_on = array('forum', 'user'),
		$table = 'forum_threads',
		$dependent = TRUE,
		$updated_field = 'updated_at',
		$created_field = 'created_at',
		$as = array(
			'posts' => 'forum_posts'
		),
		$foreign_keys = array(
			'posts' => 'thread_id'
		),
		$validation = array(
			array(
				'field' => 'title',
				'label' => 'Title',
				'rules' => 'required'
			),
			array(
				'field' => 'forum_id',
				'label' => 'Forum ID',
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
	
	public function toogle_sticky() {
		$this->is_sticky = $this->is_sticky ? FALSE : TRUE;
		$this->save();
	}
	
	public function __pre_save() {
		$this->_properties['object']->url_title = url_title($this->_properties['object']->title);
	}
	
	public function __post_create() {
		current_user()->push('activities', array(
			'content' => 'created a forum thread '.link_to($this->title, dynamic_url('forum_threads', $this->id))
		));
	}
	
	public function resource_url() {
		return forum_thread_url($this->forum->url_name, $this->id, $this->url_title);
	}
	
}
