<?php

if(! function_exists('fetch_controller')) {

	function fetch_controller() {
		global $RTR;
		return $RTR->fetch_class();
	}
	
}

if(! function_exists('fetch_class')) {

	function fetch_class() { return fetch_controller(); }

}

if(! function_exists('fetch_method')) {

	function fetch_method() {
		global $RTR;
		return $RTR->fetch_method();
	}

}

if(! function_exists('fetch_action')) {

	function fetch_action() { return fetch_method(); }

}
