<?php

class Setting extends TinyMapper {

	protected
		$table = 'settings',
		$validation = array(
			array(
				'field' => 'key',
				'label' => 'Key',
				'rules' => 'required'
			)
		);
		
	public function __construct($id = NULL) {
		parent::__construct($id);
	}
	
}
