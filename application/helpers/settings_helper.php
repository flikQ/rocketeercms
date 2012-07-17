<?php

if(! function_exists('setting')) {

	function setting($key, $return_model = FALSE, $default = FALSE) {
		static $settings = array();
		if(isset($settings[$key])) {
			return $settings[$key];
		}
		list($category, $key) = explode('.', $key);
		$setting = new Setting;
		$setting->sandbox_on();
		$result = $setting->where('category_name', $category)->where('key', $key)->limit(1)->get();
		$setting->sandbox_off();
		if($result) {
			$settings[$category.'.'.$key] = $result[0]->value;
			return $return_model ? $result[0] : $result[0]->value;
		}
		return $default;
	}

}
