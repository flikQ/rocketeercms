<?php
class User_Model extends MY_Model {

	public function get_recently_online()
	{
		$time = time();

		$this->db->select(array('username', 'group_id'))
			->where('(' . $time . ' - last_login) <=', 28880)
			->order_by('username', 'asc');

		return $this->get_all();
	}

	public function get_usernames_like($username, $limit = 10)
	{
		$this->db->select('username')
				 ->like('username', $username)
				 ->limit($limit);

		$data = array();
		$results = $this->get_all();

		foreach ($results as $result)
		{
			$data[] = $result->username;
		}

		return $data;
	}
}