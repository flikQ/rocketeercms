<?php

if(! function_exists('view')) {

	function view($view, $data = NULL) {
		static $CI;
		if(! $CI) {
			$CI =& get_instance();
		}
		$CI->load->view($view, $data);
	}

}

if(! function_exists('partial')) {

	function partial($partial, $data = NULL) {
		view('../partials/'.$partial, $data);
	}

}

if(! function_exists('widget')) {

	function widget($view) {
		view('../widgets/'.$view);
	}

}

if(! function_exists('sidebar')) {

	function sidebar($view) {
		view('../sidebars/'.$view);
	}

}
