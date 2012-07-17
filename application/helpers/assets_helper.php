<?php

if(! function_exists('css')) {

	function css($filename, $cache = TRUE) {
		static $theme;
		if(! $theme) {
			$CI =& get_instance();
			$theme = $CI->layout->name;
			unset($CI);
		}
		$cache = $cache ? '?'.time() : '';
		return '<link rel="stylesheet" type="text/css" href="'.config_item('base_url').'themes/'.$theme.'/assets/css/'.$filename.'.css'.$cache.'">';
	}

}

if(! function_exists('js')) {

	function js($filename, $cache = TRUE) {
		static $theme;
		if(! $theme) {
			$CI =& get_instance();
			$theme = $CI->layout->name;
			unset($CI);
		}
		$cache = $cache ? '?'.time() : '';
		return '<script type="text/javascript" src="'.config_item('base_url').'themes/'.$theme.'/assets/js/'.$filename.'.js'.$cache.'"></script>';
	}	
	
}
