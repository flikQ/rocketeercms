<?php

class Spotlights extends Admin_Controller {

	public $menu = array(
		'consists_of' => array('spotlight_items'),
		'show' => TRUE
	);

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$spotlight = new Spotlight;
		$this->load->view('spotlights/index', array(
			'spotlights' => $spotlight->order_by('created_at', 'desc')->get()
		));
	}
	
	public function add() {
		$this->layout->js = array('jquery-1.4.4.min', 'spotlights.add');
		$templates = array();
		foreach(glob(FCPATH.'themes/'.setting('themes.default_theme').'/spotlights/*.php') as $item) {
			$name = str_replace('.php', '', basename($item));
			$templates[$name] = humanize($name);
		}
		$this->load->view('spotlights/add', array(
			'templates' => $templates
		));
	}
	
	public function create() {
		$spotlight = new Spotlight;
		$spotlight->name = underscore(strtolower($this->input->post('name')));
		$spotlight->template_name = $this->input->post('template_name');
		if($spotlight->save() == FALSE) {
			flash('errors', $spotlight->errors);
			redirect('admin/spotlights/add');
			return;
		}
		$items = $this->input->post('items');
		$count = count($items);
		if(is_array($items) && $count > 0) {
			// start *dirty* magic
			$c = 1;
			$ci = 0;
			$_items = $items;
			$items = array();
			for($i = 0; $i < $count; $i++) {
				$key = array_keys($_items[$i]);
				$key = $key[0];
				$value = $_items[$i][$key];
				$items[$ci][$key] = $value;
				if($c == 3) {
					$ci++;
				}
				$c++;
			}
			// end magic
			$count = count($items);
			for($i = 0; $i < $count; $i++) {
				if(isset($_FILES['items'], $_FILES['items']['name'][$i])) {
					$_FILES['image'] = array(
						'name' => $_FILES['items']['name'][$i]['image'],
						'type' => $_FILES['items']['type'][$i]['image'],
						'tmp_name' => $_FILES['items']['tmp_name'][$i]['image'],
						'error' => $_FILES['items']['error'][$i]['image'],
						'size' => $_FILES['items']['size'][$i]['image']
					);
				}
				$model = new Spotlight_Item;
				$model->headline = $items[$i]['headline'];
				$model->description = $items[$i]['description'];
				$model->url = $items[$i]['url'];
				$model->spotlight_id = $spotlight->id;
				if($model->save() == FALSE) {
					flash('errors', $model->errors);
					redirect('admin/spotlights/add');
					return;
				}
			}
		}
		redirect('admin/spotlights/index');
	}
	
	public function edit() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$spotlight = new Spotlight($id);
		if(! $spotlight->exists()) {
			show_404();
		}
		$this->layout->js = array('jquery-1.4.4.min', 'spotlights.add');
		$templates = array();
		foreach(glob(FCPATH.'themes/'.setting('themes.default_theme').'/spotlights/*.php') as $item) {
			$name = str_replace('.php', '', basename($item));
			$templates[$name] = humanize($name);
		}
		$this->load->view('spotlights/edit', array(
			'spotlight' => $spotlight,
			'templates' => $templates
		));
	}
	
	public function update() {
		$id = $this->input->post('id');
		if(! $id) {
			show_error('Unknown Spotlight ID');
		}
		$spotlight = new Spotlight($id);
		if(! $spotlight->exists()) {
			show_404();
		}
		$spotlight->name = underscore(strtolower($this->input->post('name')));
		$spotlight->template_name = $this->input->post('template_name');
		if($spotlight->save() == FALSE) {
			flash('errors', $spotlight->errors);
			redirect('admin/spotlights/edit');
			return;
		}
		$items = $this->input->post('items');
		$count = count($items);
		if(is_array($items) && $count > 0) {
			// start magic
			$c = 1;
			$ci = 0;
			$_items = $items;
			$items = array();
			for($i = 0; $i < $count; $i++) {
				$key = array_keys($_items[$i]);
				$key = $key[0];
				$value = $_items[$i][$key];
				$items[$ci][$key] = $value;
				if($c == 4) {
					$ci++;
				}
				$c++;
			}
			// end magic
			$count = count($items);
			for($i = 0; $i < $count; $i++) {
				if(isset($_FILES['items'], $_FILES['items']['name'][$i])) {
					$_FILES['image'] = array(
						'name' => $_FILES['items']['name'][$i]['image'],
						'type' => $_FILES['items']['type'][$i]['image'],
						'tmp_name' => $_FILES['items']['tmp_name'][$i]['image'],
						'error' => $_FILES['items']['error'][$i]['image'],
						'size' => $_FILES['items']['size'][$i]['image']
					);
				}
				$model = isset($items[$i]['id']) ? new Spotlight_Item($items[$i]['id']) : new Spotlight_Item;
				$model->headline = $items[$i]['headline'];
				$model->description = $items[$i]['description'];
				$model->url = $items[$i]['url'];
				$model->spotlight_id = $spotlight->id;
				if($model->save() == FALSE) {
					flash('errors', $model->errors);
					redirect('admin/spotlights/edit');
					return;
				}
			}
		}
		redirect('admin/spotlights/index');
	}
	
	public function remove() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$spotlight = new Spotlight($id);
		if(! $spotlight->exists()) {
			show_404();
		}
		$spotlight->remove();
		redirect('admin/spotlights/index');
	}

}
