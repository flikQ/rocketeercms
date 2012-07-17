<?php

class Articles extends MY_Controller {

	public function __construct(){
		parent::__construct();

	}
	
	public function index() {
		
		if(strpos($_SERVER['REQUEST_URI'], 'feed') !== FALSE)
		{
			$section_name = trim(str_replace('/articles/feed/', '', $_SERVER['REQUEST_URI']));
		
			return $this->feed($section_name);
		}
	
		$article = new Article();
		$base_url = articles_url();
		$section = param('section');
		if($section) {
			$base_url .= $section.'/';
			$_section = new Article_Section;
			$section = $_section->find_by_url_name($section);
			if(! $section) {
				show_404();
			}
			$article->where('section_id', $section->id);
		}
		$category = param('category');
		if($category) {
			$base_url .= $category.'/';
			$_category = new Article_Category;
			$category = $_category->find_by_url_name($category);
			if(! $category) {
				show_404();
			}
			$article->where('category_id', $category->id);
		}
		$article->where('status', 'published');
		$total_rows = $article->count();
		$per_page = setting('articles.per_page', FALSE, 10);
		$article->offset((int) param('page'))->limit($per_page);
		$articles = $article->get();
		$this->load->library('pagination');
		$this->pagination->initialize(array(
			'base_url' => $base_url.'page/',
			'total_rows' => $total_rows,
			'per_page' => $per_page,
			'uri_segment' => 'page'
		));
		$this->load->view('articles/index', array(
			'articles' => $articles,
			'pagination' => $this->pagination->create_links()
		));
	}
	
	public function show() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$article = new Article($id);
		if(! $article->exists()) {
			show_404();
		}
		$this->layout->title = $article->title;
		
		$comment = new Comment();
		$total_rows = $comment->where('resource_id', $article->id)->count();
		$offset = (int) param('page');
		$per_page = setting('comments.posts_per_page', FALSE, 20);
		$this->load->library('pagination');
		$this->pagination->initialize(array(
			'base_url' => article_url(param('section'), param('category'), $id, param('title'), ''),
			'per_page' => $per_page,
			'uri_segment' => 'page',
			'total_rows' => $total_rows
		));
		$comment->limit($per_page)->offset($offset)->order_by('created_at', 'asc');
		$comments = $comment->get();
		
		$this->load->view('articles/show', array(
			'article' => $article,
			'comments' => $comments,
			'pagination' => $this->pagination->create_links()
		));
	}
	
}
