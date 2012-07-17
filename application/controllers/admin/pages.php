<?php

class Pages extends Admin_Controller {

	public $menu = array(
		'show' => TRUE
	);

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$page = new Page;
		$this->load->view('pages/index', array(
			'pages' => $page->order_by('created_at', 'desc')->get()
		));
	}
	
	public function add() {
		$templates = array();
		foreach(glob(FCPATH.'themes/'.setting('themes.default_theme').'/page_templates/*.php') as $file) {
			$name = str_replace('.php', '', basename($file));
			$templates[$name] = humanize($name);
		}
		$page = new Page;
		$pages = array('' => 'No parent page');
		foreach($page->get() as $item) {
			$pages[$item->id] = $item->title;
		}
		$this->layout->js = array('jquery-1.5.1.min', 'tiny_mce/jquery.tinymce', 'init-tinymce', 'pages.add');
		$this->load->view('pages/add', array(
			'templates' => $templates,
			'pages' => $pages
		));
	}
	
	public function create() {
		$page = new Page;
		$page->title = $this->input->post('title');
		$page->template_name = $this->input->post('template_name');
		$page->parent_id = $this->input->post('parent_id');
		$page->content = $this->input->post('content', FALSE);
		$page->url_title = $this->input->post('url_title');
		if($page->save() == FALSE) {
			flash('errors', $page->errors);
			redirect('admin/pages/add');
			return;
		}
		redirect('admin/pages/index');
	}
	
	public function edit() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$templates = array();
		foreach(glob(FCPATH.'themes/'.setting('themes.default_theme').'/page_templates/*.php') as $file) {
			$name = str_replace('.php', '', basename($file));
			$templates[$name] = humanize($name);
		}
		$page = new Page;
		$pages = array('' => 'No parent page');
		foreach($page->get() as $item) {
			if($item->id !== $id) {
				$pages[$item->id] = $item->title;
			}
		}
		$page = new Page($id);
		if(! $page->exists()) {
			show_404();
		}
		$this->layout->js = array('jquery-1.5.1.min', 'tiny_mce/jquery.tinymce', 'init-tinymce');
		$this->load->view('pages/edit', array(
			'page' => $page,
			'templates' => $templates,
			'pages' => $pages
		));
	}
	
	public function update() {
		$id = $this->input->post('id');
		if(! $id) {
			show_error('Unknown Page ID');
		}
		$page = new Page($id);
		if(! $page->exists()) {
			show_404();
		}
		$page->title = $this->input->post('title');
		$page->template_name = $this->input->post('template_name');
		$page->parent_id = $this->input->post('parent_id');
		$page->content = $this->input->post('content', FALSE);
		$page->url_title = $this->input->post('url_title');
		if($page->save() == FALSE) {
			flash('errors', $page->errors);
		}
		redirect('admin/pages/index');
	}
	
	public function remove() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$page = new Page($id);
		if(! $page->exists()) {
			show_404();
		}
		$page->remove();
		redirect('admin/pages/index');
	}

}
