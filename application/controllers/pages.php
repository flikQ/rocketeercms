<?php

class Pages extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function show() {
		$title = param('title');
		if(! $title) {
			show_404();
		}
		$page = new Page;
		$page = $page->find_by_url_title($title);
		if(! $page) {
			show_404();
		}
		$this->load->view('../page_templates/'.$page->template_name, array(
			'page' => $page
		));
	}

}
