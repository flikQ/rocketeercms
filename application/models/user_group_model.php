<?php

class User_Group extends TinyMapper {

	protected
		$table = 'groups',
		$has_many = array('users'),
		$validation = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'required'
			)
		);

	public function __construct($data = NULL) {
		parent::__construct($data);
	}
	
}
