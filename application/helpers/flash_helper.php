<?php

if(! function_exists('flash')) {
	
	function flash($key, $data = '') {
		static $CI;
		if(! $CI) {
			$CI =& get_instance();
		}
		if($key && $data == '') {
			return json_decode($CI->session->flashdata($key));
		}
		$CI->session->set_flashdata($key, json_encode($data));
	}	
	
}

if(! function_exists('collect')) {

	function collect($key, $value = '') {
		static $data = array();
		if($key && $value == '') {
			return isset($data[$key]) ? $data[$key] : FALSE;
		}
		$data[$key] = $value;
	}

}
