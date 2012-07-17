<?php

class Article_Sections extends Admin_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$section = new Article_Section;
		$this->load->view('article_sections/index', array(
			'sections' => $section->order_by('created_at', 'desc')->get()
		));
	}
	
	public function add() {
		$this->load->view('article_sections/add');
	}
	
	public function create() {
		$section = new Article_Section;
		$section->name = $this->input->post('name');
		if($section->save() == FALSE) {
			collect('errors', $section->errors);
			$this->add();
			return;
		}
		redirect('admin/article_sections/index');
	}
	
	public function edit() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$section = new Article_Section($id);
		if(! $section->exists()) {
			show_404();
		}
		$this->load->view('article_sections/edit', array(
			'section' => $section
		));
	}
	
	public function update() {
		$id = $this->input->post('id');
		if(! $id) {
			show_error('Unknown Article Section ID');
		}
		$section = new Article_Section($id);
		if(! $section->exists()) {
			show_404();
		}
		$section->name = $this->input->post('name');
		if($section->save() == FALSE) {
			flash('errors', $section->errors);
		}
		redirect('admin/article_sections/index');
	}
	
	public function remove() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$section = new Article_Section($id);
		if(! $section->exists()) {
			show_404();
		}
		$section->remove();
		redirect('admin/article_sections/index');
	}

}
