<?php

class Search extends MY_Controller {

	public function __construct(){
			parent::__construct();
	}
	

	public function index()
	{
	    $this->load->helper('inflector');
	    
	    // Search term
	    $q      = $this->input->get('q');
	    $filter = ($this->input->get('filter')) ? $this->input->get('filter') : 'articles';
	    $page   = ($this->input->get('page')) ? $this->input->get('page') : 1;
	    
	    // Search params
	    $per_page   = 20;
	    $pagination = '';
	
	    if(strlen(trim($q)) > 0)
	    {
	        $result       = array();
	        $result_count = 0;
	        $query        = FALSE;
	        
	        if($filter == 'articles' OR !$filter)
            {
                $sql  = 'SELECT articles.id, articles.category_id, articles.section_id, articles.image_url,  articles.updated_at AS date, articles.url_title AS article_url, article_categories.url_name AS cat_url, article_sections.url_name AS section_url, articles.title, articles.short_content, articles.content, MATCH(title, short_content, content) AGAINST("'.$q.'") AS score ';
                $sql .= 'FROM articles ';
                $sql .= 'LEFT JOIN article_sections ON(articles.section_id = article_sections.id) ';
                $sql .= 'LEFT JOIN article_categories ON(articles.category_id = article_categories.id) ';
                $sql .= 'WHERE MATCH(title, short_content, content) AGAINST("'.$q.'") ';
                $sql .= 'ORDER BY score DESC ';             
                
                // Get the total number of results
                $query = $this->db->query($sql);
            }
            else if($filter == 'videos')
            {
                $sql  = 'SELECT v.id, v.title, v.url_title, v.embed_code, v.created_at, u.username, vc.name AS cat_name, vc.url_name AS cat_url_name ';
                $sql .= 'FROM videos v ';
                $sql .= 'LEFT JOIN users u ON(v.user_id = u.id) ';
                $sql .= 'LEFT JOIN video_categories vc ON(v.category_id = vc.id) ';
                $sql .= 'WHERE v.title LIKE \'%'.$q.'%\' ';
                $sql .= 'ORDER BY v.created_at DESC ';
                
                // Get the total number of results
                $query = $this->db->query($sql);
            }
            else if($filter == 'games')
            {
                $sql  = 'SELECT g.title, g.url_title, g.release, g.unsure_of_date, gg.name AS genre_name, gg.url_name AS genre_url ';
                $sql .= 'FROM games g ';
                $sql .= 'LEFT JOIN game_genres gg ON(g.genre_id = gg.id) ';
                $sql .= 'WHERE g.title LIKE \'%'.$q.'%\' ';
                $sql .= 'ORDER BY g.release DESC ';
                
                $query = $this->db->query($sql);
            }
            
            if($query AND $query->num_rows() > 0)
            {
                $result_count = $query->num_rows();
                
                // Check page num not beyond
                $max_page = ceil($result_count / $per_page);
                $page     = ($page > $max_page) ? $max_page : $page;
                
                // Page offset
                $offset = ($per_page*$page) - $per_page;
                
                // Now build correct SQL to get results
                $sql .= 'LIMIT '.$offset.', '.$per_page;
                
                $query  = $this->db->query($sql);
                $result = $query->result();
            }
	    }
	    else
	    {
	        $result       = array();
	        $result_count = 0;
	    }
	    
	    
	    if($result_count > 0)
	    {
            $this->load->library('pagination');
            
            $config['query_string_segment'] = 'page';
            $config['total_rows']           = $result_count;
            $config['per_page']             = $per_page;
            $config['page_query_string']    = true;
            $config['base_url']             = current_url().'?q='.$q;
            
            // Append filter to paging URL if its being used
            if($this->input->get('filter'))
            {
                $config['base_url'] .= '&filter='.$this->input->get('filter');
            }

            $this->pagination->initialize($config); 

            $pagination = $this->pagination->create_links();
	    }
	    
		
		$this->load->view('search/index', array(
		    'count'  => $result_count,
			'result' => $result,
			'filter' => $filter,
			'pagination' => $pagination
		));
	}
		
	}