<?php

class User extends TinyMapper {

	public
		$has_many = array('articles', 'files', 'videos',
				'comments', 'galleries', 'photos', 
				'forum_threads', 'forum_posts', 'activities', 'orders'),		
		$created_field = 'created_on',
		$has_attached = array(
			'upload_path' => './uploads/user_avatars',
			'allowed_types' => 'png|gif|jpeg|jpg',
			'max_size' => 10737418240,
			'driver' => 'files',
			'field_name' => 'avatar',
			'img' => array(
				'create_thumb' => TRUE,
				'width' => 150,
				'height' => 150,
				'maintain_ratio' => TRUE,
				'method' => 'resize'
			)
		);
	private $_loaded_meta = array();

	public function __construct($id = NULL) {
		parent::__construct($id);
	}
	
	public function __post_load($object) {
		$meta = $this->CI->db->get_where('meta', array('user_id' => $object->id), 1)->result_object();
		if(isset($meta[0])) {
			foreach($meta[0] as $key=>$value) {
				if($key !== 'id') {
					$this->_loaded_meta[] = $key;
					$this->$key = $value;
				}
			}
		}
	}
	
	public function __pre_save() {
		$this->has_attached['img']['width'] = setting('users.avatar_width', FALSE, 150);
		$this->has_attached['img']['height'] = setting('users.avatar_height', FALSE, 150);
		foreach($this->_loaded_meta as $prop) {
			unset($this->_properties['object']->$prop);
		}
	}
	
	public function __pre_remove($object) {
		$this->CI->db->where('user_id', $object->id)->delete('meta');
	}	
	
	public function full_name() {
		if($this->first_name || $this->last_name) {
			return $this->first_name.' '.$this->last_name;
		}
		return $this->username;
	}
	
	public function friend_exists(User $user) {
		return (bool) $this->CI->db->where('status', 'accepted')->where('user_id', $user->id)->where('friend_id', $this->id)->or_where('user_id', $this->id)->where('friend_id', $user->id)->where('status', 'accepted')->limit(1)->count_all_results('friends');
	}
	
	public function is_friend_requested(User $user) {
		return (bool) $this->CI->db->where('status', 'pending')->where('user_id', $user->id)->where('friend_id', $this->id)->or_where('user_id', $this->id)->where('friend_id', $user->id)->where('status', 'pending')->limit(1)->count_all_results('friends');
	}
	
	public function add_friend(User $user, $accepted = FALSE) {
		if($this->friend_exists($user)) {
			return FALSE;
		}
		$this->CI->db->insert('friends', array(
			'user_id' => $this->id,
			'friend_id' => $user->id,
			'sender_id' => $this->id,
			'status' => ($accepted == TRUE ? 'accepted' : 'pending')
		));
		return TRUE;
	}
	
	public function delete_friend(User $user) {
		$this->CI->db->where('friend_id', $this->id)->where('user_id', $user->id)->or_where('user_id', $this->id)->where('friend_id', $user->id)->limit(1)->delete('friends');
	}
	
	public function accept_friend(User $user) {
		$this->CI->db->where('friend_id', $this->id)->where('sender_id', $user->id)->set(array('status' => 'accepted'))->update('friends');
		$this->push('activities', array(
			'content' => 'is now friends with '.link_to($user->username, dynamic_url('users', $user->id))
		));
	}
	
	public function deny_friend(User $user) {
		$this->CI->db->where('friend_id', $this->id)->where('sender_id', $user->id)->set(array('status' => 'denied'))->update('friends');
	}
	
	public function get_friends($page = 0, $limit = 20) {
		$users = array();
		$result = $this->CI->db->where('status', 'accepted')->where('friend_id', $this->id)->or_where('user_id', $this->id)->where('status', 'accepted')->limit($limit)->offset($page)->get('friends');
		if(! $result) {
			return array();
		}
		$result = $result->result_object();
		foreach($result as $user) {
			$users[] = new User($user->friend_id == $this->id ? $user->user_id : $user->friend_id);
		}
		return $users;
	}
	
	public function get_pending_friends() {
		$result = $this->CI->db->where('friend_id', $this->id)->where('status', 'pending')->where('sender_id !=', $this->id)->get('friends');
		if(! $result) {
			return array();
		}
		$result = $result->result_object();
		$users = array();
		foreach($result as $user) {
			$users[] = new User($user->sender_id);
		}
		return $users;
	}
	
	public function get_all_friends() {
		return $this->get_friends(FALSE, FALSE);
	}
	
	public function total_friends($status = 'accepted') {
		return $this->CI->db->where('user_id', $this->id)->where('status', $status)->count_all_results('friends');
	}
	
	public function avatar($size = 'small') {
		if($size == 'small') {
			return $this->avatar_thumb_url ? $this->avatar_thumb_url : '/themes/'.setting('themes.default_theme').'/assets/images/no-pic.jpg';
		} else {
			return $this->avatar_url ? $this->avatar_url : '/themes/'.setting('themes.default_theme').'/assets/images/no-pic.jpg';
		}
	}
	
	public function unread_messages() {
		static $number;
		if(! $number) {
			$number = $this->CI->db->where('receiver_id', $this->id)->where('is_read', '0')->where('folder', 'incoming')->count_all_results('private_messages');
		}
		return $number;
	}
	
	public function pending_friends() {
		static $number;
		if(! $number) {
			$number = $this->CI->db->where('friend_id', $this->id)->where('status', 'pending')->count_all_results('friends');
		}
		return $number;
	}
	
	public function join(Squad $squad) {
		$squad->push('squad_members', array(
			'squad_id' => $squad->id,
			'user_id' => $this->id
		));
		$group = new User_Group;
		$group = $group->find_by_name('squad_members');
		$this->group_id = $group->id;
		$this->save();
	}
	
	public function resource_url() {
		return profile_url($this->username);
	}
	
	public function total_orders() {
		$total_orders = $this->CI->db->where('user_id', $this->id)->count_all_results('orders');
		
		return (int) $total_orders;
	}
	
	public function my_orders() {
		$my_orders = $this->CI->db->where('user_id', $this->id)->get('orders')->result_object();
		
		return $my_orders;
	}
	
}
