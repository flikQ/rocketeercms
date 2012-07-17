<?php

if(! function_exists('current_user')) {

	class emptyClass {

		function __get($key) { return NULL; }

	}

	

	function current_user() {

		static $CI;

		if(! $CI) {

			$CI =& get_instance();

		}

		static $user = NULL;

		if(! $user && class_exists('User') && user_logged_in()) {

			if($CI->ion_auth->logged_in()) {

				$user = new User;

				$user = $user->find_by_email($CI->session->userdata('email'));

				return $user;

			}
			
			if($CI->tweet->logged_in()) {
				
				$twt_user = $CI->tweet->call('get', 'account/verify_credentials');
				
				$meta = $CI->db->select('user_id')->where('twt_id', $twt_user->id_str)->limit(1)->get('meta')->result_object();
				
				//print_r($meta);
				
				if(count($meta) == 0 && $CI->uri->segment(2) == 'twt_sign_in')
				{
					$profile_image_url = $twt_user->profile_image_url;
					$profile_image_url = str_replace('_normal', '', $profile_image_url);
					
					$user                   = new User;
					$user->group_id         = 2;
					$user->username         = $twt_user->screen_name;
					$user->avatar_thumb_url = $twt_user->profile_image_url;
					$user->avatar_url       = $profile_image_url;
					$user->save(FALSE);
					
					list($first_name, $last_name) = explode(' ', $twt_user->name);
					
					$CI->db->insert('meta', array(
						'user_id' => $user->id,
						'first_name' => $first_name,
						'last_name' => $last_name,
						'twt_id' => $twt_user->id_str
					));
					
					//redirect();
					
					return $user;
				}
				
				$user = new User($meta[0]->user_id);

				return $user;

			}

			if($CI->facebook->logged_in()) {

				$fb_user = $CI->facebook->call('get', 'me', array('metadata' => 1))->__resp->data;

				$meta = $CI->db->select('user_id')->where('fb_id', $fb_user->id)->limit(1)->get('meta')->result_object();
				
				if(count($meta) == 0 && $CI->uri->segment(2) == 'fb_sign_in')
				{
					$user = new User;
					$user->group_id = 2;
					$user->username = str_replace(' ', '_', strtolower($fb_user->name));
					$user->avatar_thumb_url = 'http://graph.facebook.com/'.$fb_user->id.'/picture';
					$user->avatar_url = 'http://graph.facebook.com/'.$fb_user->id.'/picture?type=large';
					$user->save(FALSE);
					$CI->db->insert('meta', array(
						'user_id' => $user->id,
						'first_name' => $fb_user->first_name,
						'last_name' => $fb_user->last_name,
						'fb_id' => $fb_user->id
					));
					
					return $user;
				}
				
				$user = new User($meta[0]->user_id);

				return $user;

			}

		}

		return $user;

	}	

	

}

