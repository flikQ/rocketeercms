<?php

class Spotlight_Items extends Admin_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$item = new Spotlight_Item;
		$this->load->view('spotlight_items/index', array(
			'items' => $item->get()
		));
	}
	
	public function add() {
		$spotlight = new Spotlight;
		$spotlights = array();
		foreach($spotlight->get() as $item) {
			$spotlights[$item->id] = humanize($item->name);
		}
		$this->layout->js = array('jquery-1.5.1.min', 'tiny_mce/jquery.tinymce', 'init-tinymce');
		$this->load->view('spotlight_items/add', array(
			'spotlights' => $spotlights
		));
	}
	
	public function create() {
		$item = new Spotlight_Item;
		$item->headline = $this->input->post('headline');
		$item->description = $this->input->post('description');
		$item->spotlight_id = $this->input->post('spotlight_id');
		$item->url = $this->input->post('url');
		if($item->save() == FALSE) {
			flash('errors', $item->errors);
			redirect('admin/spotlight_items/add');
			return;
		}
		redirect('admin/spotlight_items/index');
	}
	
	public function edit() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$spotlight = new Spotlight;
		$spotlights = array();
		foreach($spotlight->get() as $item) {
			$spotlights[$item->id] = humanize($item->name);
		}
		$item = new Spotlight_Item($id);
		if(! $item->exists()) {
			show_404();
		}
		$this->layout->js = array('jquery-1.5.1.min', 'tiny_mce/jquery.tinymce', 'init-tinymce');
		$this->load->view('spotlight_items/edit', array(
			'item' => $item,
			'spotlights' => $spotlights
		));
	}
	
	public function update() {
		$id = $this->input->post('id');
		if(! $id) {
			show_error('Unknown Spotlight Item ID');
		}
		$item = new Spotlight_Item($id);
		if(! $item->exists()) {
			show_404();
		}
		$item->headline = $this->input->post('headline');
		$item->description = $this->input->post('description');
		$item->spotlight_id = $this->input->post('spotlight_id');
		$item->url = $this->input->post('url');
		if($item->save() == FALSE) {
			flash('errors', $item->errors);
		}
		redirect('admin/spotlight_items/index');
	}
	
	public function remove() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$item = new Spotlight_Item($id);
		if(! $item->exists()) {
			show_404();
		}
		$item->remove();
		redirect('admin/spotlight_items/index');
	}

}
