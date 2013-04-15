<?php

if(! function_exists('fetch')) {

	function fetch($resource, $options = NULL, $callback = NULL) {
		$model_name = str_replace(' ', '_', humanize(singular($resource)));
		$model = new $model_name;
		if(is_string($options)) {
			$_options = explode('&', $options);
			$options = array();
			foreach($_options as $param) {
				list($key, $value) = explode('=', $param);
				$options[$key] = $value;
			}
			if(isset($options['limit'])) {
				$model->limit((int) $options['limit']);
				unset($options['limit']);
			}
			if(isset($options['offset'])) {
				$model->offset((int) $options['offset']);
				unset($options['offset']);
			}
			if(isset($options['section'])) {
				$section_name = ucfirst(singular($resource)).'_Section';
				$section_model = new $section_name;
				$section = $options['section'];
				$section_model = $section_model->url_title ? $section_model->find_by_url_title($options['section']) : $section_model->find_by_url_name($options['section']);
				if($section_model) {
					$model->where('section_id', $section_model->id);
				}
				unset($options['section']);
			}
			if(isset($options['category'])) {
				$category_name = ucfirst(singular($resource)).'_Category';
				$category_model = new $category_name;
				$category_model = $category_model->url_title ? $category_model->find_by_url_title($options['category']) : $category_model->find_by_url_name($options['category']);
				if($category_model) {
					$model->where('category_id', $category_model->id);
				}
				unset($options['category']);
			}
			if(isset($options['per_page'])) {
				$page = get_instance()->uri->segment('page');
				$page = $page ? $page : 0;
				$limit = $options['per_page'];
				$offset = $page;
				$model->limit($limit)->offset($offset);
				unset($options['per_page']);
			}
			if(isset($options['order_by_asc'])) {
				$model->order_by($options['order_by_asc'], 'asc');
				unset($options['order_by_asc']);
			}
			if(isset($options['order_by_desc'])) {
				$model->order_by($options['order_by_desc'], 'desc');
				unset($options['order_by_desc']);
			}
			foreach($options as $key=>$value) {
				$model->where($key, $value);
			}
		}
		if($callback) {
			return $callback($model);
		} else {
			
			$result = $model->get();
			
			if($resource == 'shop_items')
			{
				//@Todo: Do this properly
				foreach($result as $item)
				{
					$CI =& get_instance();
					$query = $CI->db->select("name,price")
							 ->from('shop_variations')
							 ->where('item_id', $item->id)
							 ->order_by('price', 'asc')
							 ->get();
							 
					$query_meta = $CI->db->select("subscription_info, download_info, additional_info")
									->from('shop_meta')
									->where('item_id', $item->id)
									->get();
					
					if($query->num_rows() > 0)
					{
						$item->variations = $query->result();
					}
					
					if($query_meta->num_rows() > 0)
					{
						$item->meta = $query_meta->result();
					}
				}
			}
			
			
			return $result;
		}
	}

}

if(! function_exists('fetch_one')) {
	
	function fetch_one($resource, $options = NULL) {
		if(! $options) {
			$options = 'limit=1';
		} else {
			$options .= '&limit=1';
		}
		$result = fetch(plural($resource), $options);
		return isset($result[0]) ? $result[0] : NULL;
	}
	
}

if(! function_exists('fetch_count')) {
	
	function fetch_count($resource, $options = NULL) {
		return fetch($resource, $options, function($model) {
			return (int) $model->count();
		});
	}
	
}

if(! function_exists('pagination')) {


	function pagination($resource, $options = NULL) {
		static $CI;
		if(! $CI) {
			$CI =& get_instance();
		}
		$per_page = 10;
		if($options) parse_str($options);
		$pagination['uri_segment'] = 'page';
		$pagination['base_url'] = $_SERVER['REQUEST_URI'];
		if(strpos($pagination['base_url'], 'page') > 0) {
			$pagination['base_url'] = preg_replace('/page\/.+/', 'page', $pagination['base_url']);
		} else {
			$pagination['base_url'] .= $pagination['base_url'][strlen($pagination['base_url'])-1] == '/' ? 'page/' : '/page/';
		}
		$pagination['per_page'] = $per_page;
		$pagination['total_rows'] = fetch($resource, $options, function($model) use($CI) {
			$CI->db->ar_limit = FALSE;
			$CI->db->ar_offset = FALSE;
			return (int) $model->count();
		});
		$CI->load->library('pagination');
		$lib = $CI->pagination;
		$lib->initialize($pagination);
		return $lib->create_links();
	}

}

if(! function_exists('fetch_posts')) {
	
	function fetch_posts($forum_id) {

		$CI =& get_instance();
					
		$CI->db->select('fp.* ,ft.title, ft.url_title, ft.forum_id, ft.id as thread_id, ft.forum_posts_number');
		$CI->db->from('forum_threads ft');
		$CI->db->join('forum_posts fp', 'fp.thread_id = ft.id');
		$CI->db->where('ft.forum_id', $forum_id);
		$CI->db->where('ft.closed', 0);
		$CI->db->order_by('updated_at', 'desc');
		//$CI->db->limit(5);
		
		$query = $CI->db->get();

		$posts = array();

		if($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $i) {
				$post = $i;

				$post['trim'] = $i['title'];

				//finfout where it is
				$post['page']= floor($post['forum_posts_number'] / 20) * 20;

				//Add first to array
				if(count($posts) == 0){
					$posts[] = $post;
				}

				//is it unique
				$unique = true;

				foreach($posts as $p) {
					
					if($p['title'] == $i['title']){
						$unique = false;
					}
				}

				if($unique){
					$posts[] = $post;
				}

				
			} 
		}

		$posts = array_slice($posts, 0, 5);

		return $posts;
		
		
		
	}
	
}

if(! function_exists('fetch_post')) {
	
	function fetch_post($forum_id) {

		$CI =& get_instance();
					
		$CI->db->select('fp.* ,ft.title, ft.url_title, ft.forum_id, ft.id as thread_id, ft.forum_posts_number, u.username as username, u.avatar_thumb_url as thumb');
		$CI->db->from('forum_threads ft');
		$CI->db->join('forum_posts fp', 'fp.thread_id = ft.id');
		$CI->db->join('users u', 'fp.user_id = u.id');
		$CI->db->where('ft.forum_id', $forum_id);
		$CI->db->where('ft.closed', 0);
		$CI->db->order_by('updated_at', 'desc');
		//$CI->db->limit(5);
		
		$query = $CI->db->get();

		$posts = array();

		if($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $i) {
				$post = $i;

				$post['trim'] = $i['title'];
				$post['date'] = $i['created_at'];
				$post['user'] = $i['username'];
				$post['thumb'] = $i['thumb'];

				//finfout where it is
				$post['page']= floor($post['forum_posts_number'] / 20) * 20;

				//Add first to array
				if(count($posts) == 0){
					$posts[] = $post;
				}

				//is it unique
				$unique = true;

				foreach($posts as $p) {
					
					if($p['title'] == $i['title']){
						$unique = false;
					}
				}

				if($unique){
					$posts[] = $post;
				}

				
			} 
		}

		$posts = array_slice($posts, 0, 1);

		return $posts;
		
		
		
	}
	
}

function multi_unique($array) {
    foreach ($array as $k=>$na)
        $new[$k] = serialize($na);
    $uniq = array_unique($new);
    foreach($uniq as $k=>$ser)
        $new1[$k] = unserialize($ser);
    return ($new1);
}

function add_ellipsis($string, $length, $end='?')
{
  if (strlen($string) > $length)
  {
    $length -=  strlen($end);  // $length =  $length ? strlen($end);
    $string  = substr($string, 0, $length);
    $string .= $end;  //  $string =  $string . $end;
  }
  return $string;
}



