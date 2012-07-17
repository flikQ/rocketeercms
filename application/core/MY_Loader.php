<?php

class MY_Loader extends CI_Loader {

	private $CI;
	public $theme = 'default';
	
	public function __construct() {
		parent::__construct();
		$this->_ci_view_path = FCPATH;
	}
	
	public function view($view, $vars = array(), $return = FALSE) {
		if(! isset($this->CI)) {
			$this->CI =& get_instance();
		}
		$theme = $this->CI->router->fetch_directory() == 'admin/' ? 'admin/' : $this->theme.'/';
		return $this->_ci_load(array('_ci_view' => 'themes/'.$theme.'views/'.$view, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
	}
	
}
