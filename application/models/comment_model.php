<?php

class Comment extends TinyMapper {

	protected
		$belongs_to = array('user'),
		$number_field_on = array('user'),
		$validation = array(
			array(
				'field' => 'content',
				'label' => 'Content',
				'rules' => 'required'
			),
			array(
				'field' => 'user_id',
				'label' => 'User ID',
				'rules' => 'required|integer'
			),
			array(
				'field' => 'resource',
				'label' => 'Resource',
				'rules' => 'required'
			),
			array(
				'field' => 'resource_id',
				'label' => 'Resource ID',
				'rules' => 'required|integer'
			)
			
		),
		$created_field = 'created_at';
		

	public function __construct($id = NULL) {
		parent::__construct($id);
	}
	
	public function __pre_save() {
		$this->number_field_on[] = singular($this->_properties['object']->resource);
	}
	
	public function __post_create() {
		
	}
	
	public function resource() { 
		$model_name = str_replace(' ', '_', humanize(singular($this->resource)));
		$model = new $model_name($this->resource_id);
		$model->properties();
		return isset($model->name) ? $model->name : $model->title;
	}
	
	public function resource_model() {
		$model_name = str_replace(' ', '_', humanize(singular($this->resource)));
		return new $model_name($this->resource_id);
	}

}
