<?php

if(! function_exists('is_friend')) {

	function is_friend($friend) {
		static $user;
		if(! $user) {
			$user = current_user();
		}
		return $user->friend_exists($friend);
	}

}
