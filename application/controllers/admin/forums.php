<?php

class Forums extends Admin_Controller {

	public $menu = array(
		'consists_of' => array('forum_sections'),
		'show' => TRUE
	);

	public function __construct() {
		parent::__construct();
	}
	
	public function index()
	{
		// Handle saving a new order
		if($this->input->is_ajax_request())
		{
			$section_id = $this->input->post('section_id');
			$section_id = explode('-', $section_id);
			$section_id = (int)$section_id[1];
			
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
				$this->db->update('forums', array(
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
		$this->load->view('forums/index', array(
			'sections' => $section->order_by('order', 'asc')->get()
		));
	}
	
	public function add() {
		$section = new Forum_Section;
		$sections = array();
		foreach($section->get() as $item) {
			$sections[$item->id] = $item->name;
		}
		$forum = new Forum;
		$forums = array('' => 'No parent forum');
		foreach($forum->get() as $item) {
			$forums[$item->id] = $item->name;
		}
		$this->layout->js = array('jquery-1.5.1.min', 'tiny_mce/jquery.tinymce', 'init-tinymce');
		$this->load->view('forums/add', array(
			'sections' => $sections,
			'forums' => $forums
		));
	}
	
	public function create() {
		$forum = new Forum;
		$forum->name = $this->input->post('name');
		$forum->description = $this->input->post('description');
		$forum->section_id = $this->input->post('section_id');
		$forum->parent_id = $this->input->post('parent_id');
		if($forum->save() == FALSE) {
			flash('errors', $forum->errors);
			redirect('admin/forums/add');
			return;
		}
		redirect('admin/forums/index');
	}
	
	public function edit() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$forum = new Forum;
		$forums = array('' => 'No parent forum');
		foreach($forum->get() as $item) {
			if($item->id !== $id) {
				$forums[$item->id] = $item->name;
			}
		}

		$forum = new Forum($id);
		if(! $forum->exists()) {
			show_404();
		}
		$section = new Forum_Section;
		$sections = array();
		foreach($section->get() as $item) {
			$sections[$item->id] = $item->name;
		}
				$this->layout->js = array('jquery-1.5.1.min', 'tiny_mce/jquery.tinymce', 'init-tinymce');
		$this->load->view('forums/edit', array(
			'forum' => $forum,
			'forums' => $forums,
			'sections' => $sections
		));
	}
	
	public function update() {
		$id = $this->input->post('id');
		if(! $id) {
			show_error('Unknown Forum ID');
		}
		$forum = new Forum($id);
		if(! $forum->exists()) {
			show_404();
		}
		$forum->name = $this->input->post('name');
		$forum->description = $this->input->post('description');
		$forum->section_id = $this->input->post('section_id');
		$forum->parent_id = $this->input->post('parent_id');
		if($forum->save() == FALSE) {
			flash('errors', $forum->errors);
			redirect('admin/forums/edit/id/'.$forum->id);
			return;
		}
		redirect('admin/forums/index');
	}
	
	public function remove() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$forum = new Forum($id);
		if(! $forum->exists()) {
			show_404();
		}
		$forum->remove();
		redirect('admin/forums/index');
	}

}
