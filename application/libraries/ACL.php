<?php

class ACL {

	private
		$CI = NULL,
		$list = array(),
		$group_id = 0;

	public function load(User_Group $group = NULL) {
		$this->CI =& get_instance();
		$group_id = $group && isset($group->id) ? $group->id : current_user()->group_id;
		if(! $group_id) {
			return FALSE;
		}
		$result = $this->CI->db->where('group_id', $group_id)->get('acl');
		if($result->num_rows() > 0) {
			foreach($result->result_array() as $acl) {
				$this->list[$group_id][$acl['key']] = (bool) $acl['value'];
			}
		}
		$this->group_id = $group_id;
	}
	
	public function can($key, User_Group $group = NULL) {
		$this->load($group);
		$group_id = $group ? $group->id : $this->group_id;
		return isset($this->list[$group_id][$key]) ? $this->list[$group_id][$key] : FALSE;
	}
	
	public function rights_list(User_Group $group = NULL) {
		$this->load($group);
		$rights = array();
		$group_id = $group ? $group->id : $this->group_id;
		foreach($this->list[$group_id] as $key=>$value) {
			$rights[] = $key;
		}
		return $rights;
	}
	
	public function add_right($key, $value, User_Group $group = NULL) {
		if(! isset($this->CI)) {
			$this->CI =& get_instance();
		}
		if($group) {
			$this->CI->db->insert('acl', array(
				'group_id' => $group->id,
				'key' => $key,
				'value' => $value
			));
			$this->list[$group->id][$key] = $value;
		} else {
			$groups = $this->CI->db->get('groups')->result_object();
			foreach($groups as $group) {
				$_value = $group->id == 1 ? 1 : (int) $value;
				$this->CI->db->insert('acl', array(
					'group_id' => $group->id,
					'key' => $key,
					'value' => $_value
				));
				$this->list[$group->id][$key] = $value;
			}
		}
	}
	
	public function remove_right($key) {
		if(! isset($this->CI)) {
			$this->CI =& get_instance();
		}
		
		$this->CI->db->where('key', $key)->delete('acl');
	}
	
	public function allow($key, User_Group $group = NULL) {
		if(! isset($this->CI)) {
			$this->CI =& get_instance();
		}
		
		$group_id = $group ? $group->id : $this->group_id;	
		
		$this->CI->db->where('group_id', $group_id)->set('value', '1')->update('acl');
	}
	
	public function disallow($key, User_Group $group = NULL) {
		if(! isset($this->CI)) {
			$this->CI =& get_instance();
		}
		
		$group_id = $group ? $group->id : $this->group_id;
		
		$this->CI->db->where('group_id', $group_id)->set('value', '0')->update('acl');
	}


}
