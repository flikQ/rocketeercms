<?php
class Autocomplete extends Plain_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function autocomplete ()
	{
		$this->load->model('newmod/user_model');

		$username = $this->input->post('username');//count($options) > 0 ? $options[0] : NULL;

		echo json_encode(empty($username) ? array() : $this->user_model->get_usernames_like($username));
	}
}