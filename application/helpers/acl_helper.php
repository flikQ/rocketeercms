<?php

if(! function_exists('can')) {

	function can($key, $group = NULL) {
		static $acl;
		if(! $acl) {
			$CI =& get_instance();
			$acl = $CI->acl;
			unset($CI);
		}
		return $acl->can($key, $group);
	}

}
