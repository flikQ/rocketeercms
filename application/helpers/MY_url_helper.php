<?php

if(! function_exists('param')) {

	function param($key) {
		static $params;
		if(! $params) {
			$CI =& get_instance();
			$params = $CI->uri->ruri_to_assoc();
		}
		return ($key && isset($params[$key])) ? $params[$key] : NULL; 
	}

}

if(! function_exists('link_to')) {
	
	function link_to($text, $url, $additional = FALSE) {
		$confirm = (bool) $additional;
		$add = '';
		if(strpos($additional, '#') === 0) {
			list($empty, $id) = explode('#', $additional);
			$add = 'id="'.$id.'"';
			$confirm = FALSE;
		}
		if(strpos($additional, '.') === 0) {
			list($empty, $class) = explode('.', $additional);
			$add = 'class="'.$class.'"';
			$confirm = FALSE;
		}
		$url = strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0 ? $url : str_replace('http:/', 'http://', str_replace('//', '/', base_url().$url));
		return $confirm ? '<a onclick=\'if(!confirm("'.$confirm.'")){return false;}\' href="'.$url.'">'.$text.'</a>' : '<a href="'.$url.'" '.$add.'>'.$text.'</a>';
	}	
	
}

// EXPERIMENTAL

/*
if(! function_exists('url_for')) {
	
	function url_for($param, $primary_key = 'id') {
		if(! is_object($param) && ! is_array($param) && ! is_string($param)) {
			return '';
		}
		static $CI;
		if(! $CI) {
			$CI =& get_instance();
		}
		static $base_url;
		if(! $base_url) {
			$base_url = $CI->router->fetch_directory() == '' ? base_url() : base_url().'admin/';
		}
		$url = '';
		if(is_object($param)) {
			$model_name = get_class($param);
			$controller = plural($model_name);
			$url .= $controller.'/';
			if($param->action() == 'new') {
				$url .= 'add/';
				$method = 'add';
			} else {
				$props = $param->properties();
				$url .= 'show/'.$primary_key.'/'.$props->id.'/';
				$method = 'show';
			}
		} elseif(is_array($param)) {
			$controller = isset($param['controller']) ? $param['controller'] : $CI->router->fetch_class();
			$method = isset($param['method']) ? $param['method'] : 'index';
			$url .= $controller.'/'.$method.'/';
			if(isset($param['params']) && is_array($param['params'])) {
				foreach($param['params'] as $key=>$value) {
					$url .= $key.'/'.$value.'/';
				}
			}
		} elseif(is_string($param)) {
			$url_parts = explode('/', $param);
			$controller = isset($url_parts[0]) ? $url_parts[0] : $CI->router->fetch_class();
			$method = isset($url_parts[1]) ? $url_parts[1] : 'index';
			unset($url_parts);
			$url .= $param;
		} else {
			return $base_url;
		}
		
		$_url = explode('/', str_replace($controller.'/'.$method.'/', '', $url));
		if(end($_url) == '') {
			array_pop($_url);
		}
		$count = count($_url);
		if($count > 0) {
			$params = array();
			for($i = 0; $i < $count; $i++) {
				if(($i+1) % 2 == 0) {
					$params[] = $_url[$i];
				}
			}
		}
		
		static $_routes;
		if(! $_routes) {
			$routes = $CI->router->routes;
			foreach($routes as $route=>$to) {
				if(strpos($to, $controller) === 0) {
					if(preg_match('/(\:any|\:num)/', $route)) {
						$new_url = $base_url.$route;
						foreach($params as $key=>$value) {
							if(preg_match('/\:any/', $new_url)) {
								$new_url = preg_replace('/\:any/', $value, $new_url);
							} elseif(preg_match('/\:num/', $new_url)) {
								$new_url = preg_replace('/\:num/', $value, $new_url);
							}
						}
						return $new_url;
					} else {
						return $base_url.$route;
					}
				}
			}
		}
		return $url;
	}
	
} */


/*
if(! function_exists('url_for')) {

	function url_for($resource, $resource_id) {
		static $routes;
		static $CI;
		if(! $routes && ! $CI) {
			$CI =& get_instance();
			$routes = $CI->router->routes;
		}
		$replace = array();
		$model_name = str_replace(' ', '_', humanize(singular($resource)));
		$model = new $model_name($resource_id);
		$resource_id = $model->id; // force TinyMapper to load model's data by accessing it
		if(isset($model->section_id)) {
			array_push($replace, $model->section->url_name);
		}
		if(isset($model->category_id)) {
			array_push($replace, $model->category->url_name);
		}
		array_push($replace, isset($model->url_name) ? $model->url_name : $model->url_title);
		$count = count($replace);
		foreach($routes as $route=>$to) {
			if(strpos($to, $resource) === 0 && strpos($to, '$') > 0 && ! strpos($to, 'page')) {
				$url = $route;
				if(strpos($route, ':num') > 0) {
					$url = str_replace(':num', $model->id, $url);
				}
				for($i = 0; $i < $count; $i++) {
					$url = preg_replace('/\:any/', $replace[$i], $url, 1);
				}
				return $url;
			}
		}
		return '/'.$resource.'/'.$resource_id.'/';
	}

}

*/

function url_for($model, $params = NULL, $alias = '') {
	static $routes;
	if(! $routes) {
		require APPPATH.'config/routes.php';
		$routes = $route;
	}
	if(is_object($model)) {
		$model_name = get_class($model);
		$resource = plural($model_name);
		$props = $model->properties();
		foreach($routes as $route=>$to) {
			if(! strpos($route, 'new') && ! strpos($route, 'edit') && ! strpos($route, 'update') && ! strpos($route, 'create') && ! strpos($route, 'page') && strpos($route, ':') && (strpos($route, $resource) === 0 || ($alias && strpos($route, $alias) === 0))) {
				$url = $route;
				preg_match_all('/\:[a-z-_]+/', $route, $matches);
				$not_found = FALSE;
				foreach($matches[0] as $segment) {
					$field = str_replace(':', '', $segment);
					if($model->has_relation($field, 'one')) {
						$remote_props = $model->$field;
						if($remote_props) {
							$remote_props = $remote_props->properties();
							if(isset($remote_props->url_name)) {
								$url = str_replace(':'.$field, $remote_props->url_name, $url);
							}
							if(isset($remote_props->url_title)) {
								$url = str_replace(':'.$field, $remote_props->url_title, $url);
							}
						}
					} elseif(isset($props->$field)) {
						$url = str_replace(':'.$field, url_title($props->$field), $url);
					} elseif(isset($props->{'url_'.$field})) {
						$url = str_replace(':'.$field, url_title($props->{'url_'.$field}), $url);
					} elseif(isset($props->{$field.'_id'})) {
						$url = str_replace(':'.$field, url_title($props->{$field.'_id'}), $url);
					} else {
						$not_found = TRUE;
						break;
					}
				}
				if(! $not_found) {
					if($params) {
						$url .= '/'.str_replace(array('=', '&'), '/', $params);
					}
					return $url;
				}
			}
		}
		return '';
	}
	if(is_string($model)) {
		$url = base_url().plural($model).'/';
		if($params) {
			$url .= str_replace(array('=', '&'), '/', $params);
		}
		return $url;
	}
	return '';
}
