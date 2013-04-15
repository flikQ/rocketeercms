<?php

class Forum_Section extends TinyMapper {

	protected
		$has_many = array('forums'),
		$table = 'forum_sections',
		$foreign_keys = array(
			'forums' => 'section_id'
		),
		$dependent = TRUE,
		$validation = array(
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
	
}
