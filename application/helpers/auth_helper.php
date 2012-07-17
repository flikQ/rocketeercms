<?php

if(! function_exists('user_logged_in')) {

	function user_logged_in() {
		static $CI;
		if(! $CI) {
			$CI =& get_instance();
		}
		$ion = $CI->ion_auth->logged_in();
		$fb = $CI->facebook->logged_in();
		$twt = $CI->tweet->logged_in();
		return $ion || $fb || $twt;
	}

}

if(! function_exists('username_check')) {

	function username_check($username) {
		static $model;
		if(! $model) {
			$model = new User;
		}
		return (bool) $model->find_by_username($username);
	}

}

if (!function_exists('force_ssl'))
{
    function force_ssl()
    {
        $CI =& get_instance();
        $CI->config->config['base_url'] =
                 str_replace('http://', 'https://',
                 $CI->config->config['base_url']);
        if ($_SERVER['SERVER_PORT'] != 443)
        {
            redirect($CI->uri->uri_string());
        }
    }
}
