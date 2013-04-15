<?php

class Forum_Sections extends Admin_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index()
	{
		// Handle saving a new order
		if($this->input->is_ajax_request())
		{
			$order     = $this->input->post('order');
			$order     = explode('&', $order);
			$new_order = array();
			
			foreach($order as $item)
			{
				$item        = explode('=', $item);
				$new_order[] = (int)$item[1];
			}
			
			// Now update the forum table
			foreach($new_order as $order => $id)
			{
				$this->db->where('id', $id);
				$this->db->update('forum_sections', array(
					'order' => ($order+1)
				));
			}
			
			// Output JSON
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');
			echo json_encode(array('success' => true));
			// echo json_encode(array('error' => 'There was a problem saving the order'));
			exit;
		}
		
		// Forum sections
		$section = new Forum_Section;
		
		// Load assets
		$this->layout->js = array('jquery-ui-1.8.min');
		
		// Load view
		$this->load->view('forum_sections/index', array(
			'sections' => $section->order_by('order', 'asc')->get()
		));
	}
	
	public function add() {
		$section = new Forum_Section;
		$sections = array();
		foreach($section->get() as $item) {
			$sections[$item->id] = $item->name;
		}
		$this->layout->js = array('jquery-1.5.1.min', 'tiny_mce/jquery.tinymce', 'init-tinymce');
		$this->load->view('forum_sections/add', array(
			'sections' => $sections
		));
	}
	
	public function create() {
		$section = new Forum_Section;
		$section->name = $this->input->post('name');
		$section->description = $this->input->post('description');
		$section->private = $this->input->post('private');
		if($section->save() == FALSE) {
			flash('errors', $section->errors);
			redirect('admin/forum_sections/add');
			return;
		}
		redirect('admin/forum_sections/index');
	}
	
	public function edit() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$section = new Forum_Section($id);
		if(! $section->exists()) {
			show_404();
		}
		$this->layout->js = array('jquery-1.5.1.min', 'tiny_mce/jquery.tinymce', 'init-tinymce');
		$this->load->view('forum_sections/edit', array(
			'section' => $section,
		));
	}
	
	public function update() {
		$id = $this->input->post('id');
		if(! $id) {
			show_error('Unknown Forum_Section Section ID');
		}
		$section = new Forum_Section($id);
		if(! $section->exists()) {
			show_404();
		}
		$section->name = $this->input->post('name');
		$section->description = $this->input->post('description');
		$section->private = $this->input->post('private');
		if($section->save() == FALSE) {
			flash('errors', $section->errors);
		}
		redirect('admin/forum_sections/index');
	}
	
	public function remove() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$section = new Forum_Section($id);
		if(! $section->exists()) {
			show_404();
		}
		$section->remove();
		redirect('admin/forum_sections/index');
	}

}
