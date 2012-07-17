<?php

class Layout {

	private
		$properties = array(
			'name' => 'default',
			'title' => ''
		),
		$title_suffix = '';
		
	// Set these to override the theme and layout file
	public $theme;
	public $layout;
	
	public function __construct()
	{
		$CI =& get_instance();
		$CI->load->helper('inflector');
		
		if($CI->router->fetch_class() == 'shop') { 
		
			$this->title_suffix = setting('general.site_title');
		
		} elseif($CI->router->fetch_class() == 'auth') { 
		
			$this->title_suffix = "Account - ".setting('general.site_title');
		
		} elseif($CI->router->fetch_class() == 'home') { 
		
			$this->title_suffix = setting('general.site_title');
		
		} else {
		
			$this->title_suffix = humanize($CI->router->fetch_class()).' - '.setting('general.site_title');
			
		}
		
		$CI->config->load('layout', TRUE);
		$this->properties = array_merge($this->properties, $CI->config->item('layout'));
		if($this->properties['match_theme'] == TRUE) {
			$this->properties['name'] = $CI->load->theme;
		}
		unset($this->properties['match_theme']);
		
	}
	
	public function __set($key, $value) {
		if($key == 'title') {
			$this->properties['title'] = $value.' - '.$this->title_suffix;
			return;
		}
		$this->properties[$key] = $value;
	}
	
	public function __get($key) {
		return isset($this->properties[$key]) ? $this->properties[$key] : FALSE;
	}
	
	public function get() { // get properties(excluding config items)
		if($this->properties['title'] == '') {
			$this->properties['title'] = $this->title_suffix;
		}
		return $this->properties;
	}

}
