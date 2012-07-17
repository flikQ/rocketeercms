<?php

class Spotlight extends TinyMapper {

	protected
		$table = 'spotlights',
		$has_many = array('spotlight_items'),
		$as = array(
			'items' => 'spotlight_items'
		),
		$dependent = TRUE,
		$created_field = 'created_at',
		$updated_field = 'updated_at',
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
