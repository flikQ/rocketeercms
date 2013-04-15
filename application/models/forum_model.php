<?php

class Forum extends TinyMapper {

	protected
		$belongs_to = array('forum_section'),
		$has_many = array('forum_threads', 'forum_posts'),
		$table = 'forums',
		$has_attached = array(
			'upload_path' => './uploads/icons',
			'allowed_types' => 'gif|png|jpeg|jpg',
			'max_size' => 10737418240,
			'driver' => 'files',
			'field_name' => 'icon',
			'img' => array(
				'create_thumb' => TRUE,
				'width' => 100,
				'height' => 100,
				'maintain_ratio' => TRUE
			)
		),
		$validation = array(
			array(
				'field' => 'section_id',
				'label' => 'Forum Section ID',
				'rules' => 'required|integer'
			),
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'required'
			)
		);
	
	public function __construct($id = NULL) {
		parent::__construct($id);
	}
	
	public function __pre_save() {
		$this->_properties['object']->url_name = url_title($this->_properties['object']->name);
	}	
	
	public function latest_thread() {
		$thread = new Forum_Thread;
		$threads = $thread->where('forum_id', $this->id)->limit(1)->get();
		return isset($threads[0]) ? $threads[0] : FALSE;
	}
	
}
