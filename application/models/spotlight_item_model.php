<?php

class Spotlight_Item extends TinyMapper {

	protected
		$table = 'spotlight_items',
		$belongs_to = array('spotlight'),
		$has_attached = array(
			'upload_path' => './uploads/spotlight_images',
			'allowed_types' => 'png|gif|jpeg|jpg',
			'max_size' => 10737418240,
			'driver' => 'files',
			'field_name' => 'image',
			'img' => array(
				'create_thumb' => TRUE,
				'width' => 150,
				'height' => 150,
				'maintain_ratio' => TRUE,
				'method' => 'resize'
			),
			'required' => TRUE
		),
		$validation = array(
			array(
				'field' => 'spotlight_id',
				'label' => 'Spotlight ID',
				'rules' => 'required|integer'
			),
			array(
				'field' => 'headline',
				'label' => 'Headline',
				'rules' => 'required'
			),
			array(
				'field' => 'url',
				'label' => 'URL',
				'rules' => 'required'
			),
			array(
				'field' => 'description',
				'label' => 'Description',
				'rules' => 'required'
			)
		);

	public function __construct($data = NULL) {
		parent::__construct($data);
	}
	
	public function __pre_save() {
		$this->has_attached['img']['width'] = setting('spotlights.image_width', FALSE, 300);
		$this->has_attached['img']['height'] = setting('spotlights.image_height', FALSE, 150);
	}

}
