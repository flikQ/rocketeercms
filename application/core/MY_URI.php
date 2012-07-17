<?php

class MY_URI extends CI_URI {
	
	public function __construct() {
		parent::__construct();
	}	
	
	public function segment($key = '') {
		if($key == '') {
			return FALSE;
		}
		if(isset($this->segments[$key])) {
			return $this->segments[$key];
		}
		$uri = $this->uri_to_assoc();
		return isset($uri[$key]) ? $uri[$key] : FALSE;
	}
	
}
