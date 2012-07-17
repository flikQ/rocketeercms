<?php

class Page extends TinyMapper {
	
	protected
		$has_one = array('page'),
		$as = array(
			'parent' => 'page'
		),
		$created_field = 'created_at',
		$updated_field = 'updated_at',
		$validation = array(
			array(
				'field' => 'title',
				'label' => 'Title',
				'rules' => 'required'
			),
			array(
				'field' => 'content',
				'label' => 'Content',
				'rules' => 'required'
			)
		);
	
	public function __construct($id = NULL) {
		parent::__construct($id);
	}
	
	public function __pre_save() {
		$this->_properties['object']->url_title = isset($this->_properties['object']->url_title) && $this->_properties['object']->url_title !== '' ? url_title($this->_properties['object']->url_title) : url_title($this->_properties['object']->title);
	}
	
}
