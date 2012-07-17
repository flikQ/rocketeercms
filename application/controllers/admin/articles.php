<?php

class Articles extends Admin_Controller {

	public $menu = array(
		'consists_of' => array('article_categories', 'article_sections'),
		'show' => TRUE
	);

	public function __construct() {
		parent::__construct();
	}
	
	public function index()
	{
		$article  = new Article;
		
		// If the user is a contributor we will limit to only
		// showing their articles
		if((int)current_user()->group_id === 3)
		{
			$article->where('user_id', (int)current_user()->id);
		}
		
		$base_url = '/admin/articles/index/';
		$category_id = param('category_id');
		if($category_id) {
			$base_url .= 'category_id/'.$category_id.'/';
			$article->where('category_id', $category_id);
		}
		$user_id = param('user_id');
		if($user_id) {
			$base_url .= 'user_id/'.$user_id.'/';
			$article->where('user_id', $user_id);
		}
		$section_id = param('section_id');
		if($section_id) {
			$base_url .= 'section_id/'.$section_id.'/';
			$article->where('section_id', $section_id);
		}
		$status = param('status') ? param('status') : 'published';
		$total_rows = $article->count();
		$this->load->library('pagination');
		$this->pagination->initialize(array(
			'total_rows' => $total_rows,
			'base_url' => $base_url.'page/',
			'per_page' => 20,
			'uri_segment' => 'page',
			'full_tag_open' => '<ul>',
			'full_tag_close' => '</ul>',
			'first_link' => '',
			'last_link' => '',
			'previous_link' => '&lt;',
			'next_link' => '&gt;',
			'cur_tag_open' => '<li class="active">',
			'cur_tag_close' => '</li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>'
		));
		
		$articles = $article->limit(10)->offset((int) param('page'))->order_by('created_at', 'desc')->get();
		
		$users = array();
		$sections = array();
		$categories = array();
		foreach($articles as $article) {
			$users[$article->user->id] = $article->user->full_name();
		}
		$section = new Article_Section;
		foreach($section->get() as $item) {
			$sections[$item->id] = $item->name;
		}
		$category = new Article_Category;
		foreach($category->get() as $item) {
			$categories[$item->id] = $item->name;
		}
		$this->layout->js = array('jquery-1.5.1.min', 'articles.index');
		$this->load->view('articles/index', array(
			'articles' => $articles,
			'users' => $users,
			'sections' => $sections,
			'categories' => $categories,
			'pagination' => $this->pagination->create_links()
		));
	}
	
	public function add() {
		$category = new Article_Category;
		$categories = array();
		foreach($category->get() as $item) {
			$categories[$item->id] = $item->name;
		}
		$section = new Article_Section;
		$sections = array();
		foreach($section->get() as $item) {
			$sections[$item->id] = $item->name;
		}
		$spotlight = new Spotlight;
		$this->layout->js = array('jquery-1.5.1.min', 'tiny_mce/jquery.tinymce', 'init-tinymce');
		$this->load->view('articles/add', array(
			'categories' => $categories,
			'sections' => $sections,
			'spotlights' => $spotlight->get()
		));
	}
	
	public function create() {
		$article = new Article;
		
		$article->user_id       = current_user()->id;
		$article->category_id   = $this->input->post('category_id');
		$article->section_id    = $this->input->post('section_id');
		$article->short_content = $this->input->post('short_content');
		$article->content       = $this->input->post('content', FALSE);
		$article->title         = $this->input->post('title');
		$article->status        = ($this->input->post('status')) ?: 'draft';
		
		if($article->save() == FALSE) {
			flash('errors', $article->errors);
			redirect('admin/articles/add');
			return;
		}
		$id = $this->input->post('spotlight_id');
		if($id) {
			$spotlight = new Spotlight($id);
			$spotlight->push('spotlight_items', array(
				'headline' => $article->title,
				'description' => $article->short_content,
				'url' => 'articles/'.$article->section->url_name.'/'.$article->category->url_name.'/'.$article->url_title,
				'image_thumb_url' => $article->image_thumb_url,
				'image_url' => $article->image_url
			), FALSE);
		}
		redirect('admin/articles/index');
	}
	
	public function edit()
	{
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$article = new Article($id);
		if(! $article->exists()) {
			show_404();
		}
		
		// If user is a contributor make sure this article belongs to them
		if((int)current_user()->group_id === 3 AND (int)current_user()->id !== (int)$article->user_id)
		{
			// Not allowed to view this
			$this->session->set_flashdata('error', 'Unknown article');
			redirect('admin/articles/');
		}
		
		$category = new Article_Category;
		$categories = array();
		foreach($category->get() as $item) {
			$categories[$item->id] = $item->name;
		}
		$section = new Article_Section;
		$sections = array();
		foreach($section->get() as $item) {
			$sections[$item->id] = $item->name;
		}
		$this->layout->js = array('jquery-1.5.1.min', 'tiny_mce/jquery.tinymce', 'init-tinymce', 'jquery-ui-1.8.min', 'jquery-ui-timepicker.min', 'init-datepickers');
		$this->layout->css = array('jquery-ui/ui-lightness/jquery-ui-1.8');
		$this->load->view('articles/edit', array(
			'categories' => $categories,
			'sections' => $sections,
			'article' => $article
		));
	}
	
	public function update()
	{
		$id = $this->input->post('id');
		if(! $id) {
			show_error('Undefined Article ID');
		}
		$article = new Article($id);
		if(! $article->exists()) {
			show_404();
		}
		
		// If user is a contributor make sure this article belongs to them
		if((int)current_user()->group_id === 3 AND (int)current_user()->id !== (int)$article->user_id)
		{
			// Not allowed to view this
			$this->session->set_flashdata('error', 'Unknown article');
			redirect('admin/articles/');
		}
		
		$article->category_id = $this->input->post('category_id');
		$article->section_id = $this->input->post('section_id');
		$article->short_content = $this->input->post('short_content');
		$article->content = $this->input->post('content');
		$article->title = $this->input->post('title');
		$article->status = ($this->input->post('status')) ?: 'draft';
		$created_at = $this->input->post('created_at');
		if($created_at) {
			/*preg_match_all('/^([A-Za-z]+)\s+([a-z0-9]+)\s+([A-Za-z]+)\s+([0-9]+)\s+\-\s+(.+)/', $created_at, $matches);
			$hours = date('H', strtotime(str_replace(array('pm', 'am'), array(' pm', ' am'), $matches[5][0])));
			$minutes = date('i', strtotime(str_replace(array('pm', 'am'), array(' pm', 'am'), $matches[5][0])));
			$month = date('n', strtotime($matches[3][0]));
			$date = str_replace(array('th', 'rd', 'nd'), '', $matches[2][0]);
			$year = $matches[4][0];
			$article->created_at = mktime($hours, $minutes, 0, $month, $date, $year);
			*/
			$article->created_at = strtotime($created_at);
			$article->updated_at = strtotime($created_at);
		}
		if($article->save() == FALSE) {
			flash('errors', $article->errors);
			redirect('admin/articles/edit/id/'.$article->id);
		}
		redirect('admin/articles/index');
	}
	
	public function remove()
	{
		// Article ID to remove
		if(!$id = param('id'))
		{
			show_404();
		}
		
		// Get article model instance
		$article = new Article($id);
		
		// Make sure it exists
		if(! $article->exists())
		{
			show_404();
		}
		
		// Check article belongs to logged in user if they are a contributor
		if((int)current_user()->group_id === 3 AND (int)$article->user_id !== (int)current_user()->id)
		{
			$this->session->set_flashdata('error', 'Unknown article');
			redirect('admin/articles');
		}
		
		// Remove article
		$article->remove();
		
		$this->db->where('resource_id', $article->id);
		$this->db->where('resource', 'articles');
		$this->db->delete('comments');
		
		redirect('admin/articles/index');
	}
	
	public function search() {
	
	
		// Search term
		$q = $this->input->get('q');
		$page   = ($this->input->get('page')) ? $this->input->get('page') : 1;
		
		// Search params
		$per_page   = 40;
		$pagination = '';
		
		if(strlen(trim($q)) > 0)
		{
		
			$result = array();
			$result_count = 0;
			$query = FALSE; 
			
			
			$this->db->select('a.id, a.title, a.short_content, a.content, a.created_at, a.user_id, b.name as section_name, c.name as category_name, c.id as category_id, d.username');
			$this->db->from('articles a');
			$this->db->join('article_sections b', 'a.section_id = b.id');
			$this->db->join('article_categories c', 'a.category_id = c.id');
			$this->db->join('users d', 'a.user_id = d.id');
			
			// Search article title
			$this->db->where("CONCAT_WS('a.title', a.short_content, a.content) LIKE '%".$q."%'");
			
			// If the user is a contributor we will limit to only
			// showing their articles
			if((int)current_user()->group_id === 3)
			{
				$this->db->where('a.user_id', (int)current_user()->id);
			}
			
			$this->db->order_by('a.id', 'DESC');
			$this->db->group_by('a.id');
			
			
			// Get Results
			$query = $this->db->get();
			$result = array();
			
			if($query->num_rows() > 0)
			{
				$result = $query->result();
			}
			
		} else {
		
			$result = array();
			$result_count = 0;
		
		}
		
		if($result_count > 0) {
		
			$this->load->library('pagination');
			
			$config['query_string_segment'] = 'page';
            $config['total_rows']           = $result_count;
            $config['per_page']             = $per_page;
            $config['page_query_string']    = true;
            $config['base_url']             = current_url().'?a='.$a;

            $this->pagination->initialize($config);
			
			$pagination = $this->pagination->create_links();
		
		}
		
		
		$this->load->view('articles/search', array(
		    'count'      => $result_count,
			'result'     => $result,
			'pagination' => $pagination
		));
	
	
	}

}
