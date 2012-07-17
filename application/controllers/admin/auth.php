<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('url');
	}

	public function index()
	{
		if (! user_logged_in())
		{
			redirect('admin/login', 'refresh');
			return;
		}
		redirect('admin/home/index', 'refresh');
	}
	
	public function twt_sign_in() {
		if(! $this->tweet->logged_in()) {
			$this->tweet->set_callback(base_url().'admin/auth/twt_sign_in');
			$this->tweet->login();
		} else {
			$twt_user = $this->tweet->call('get', 'account/verify_credentials');
			$result = $this->db->limit(1)->where('twt_id', $twt_user->id_str)->get('meta');
			if($result->num_rows() == 1) {
				redirect('admin/home/index');
				return;
			}
			$user = new User;
			$user->group_id = 2;
			$user->username = $twt_user->screen_name;
			$user->avatar_thumb_url = $twt_user->profile_image_url;
			$user->avatar_url = $twt_user->profile_image_url;
			$user->save();
			list($first_name, $last_name) = explode(' ', $twt_user->name);
			$this->db->insert('meta', array(
				'user_id' => $user->id,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'twt_id' => $twt_user->id_str
			));
			redirect('admin/home/index');
		}
	}
	
	public function fb_sign_in() {
		if(! $this->facebook->logged_in()) {
			$this->facebook->set_callback(base_url().'admin/auth/fb_sign_in');
			$this->facebook->login();
		} else {
			$fb_user = $this->facebook->call('get', 'me', array('metadata' => 1))->__resp->data;
			$result = $this->db->limit(1)->where('fb_id', $fb_user->id)->get('meta');
			if($result->num_rows() == 1) {
				redirect('admin/home/index');
				return;
			}
			$user = new User;
			$user->group_id = 2;
			$user->username = str_replace(' ', '_', strtolower($fb_user->name));
			$user->avatar_thumb_url = 'http://graph.facebook.com/'.$fb_user->id.'/picture';
			$user->avatar_url = 'http://graph.facebook.com/'.$fb_user->id.'/picture?type=large';
			$user->save();
			$this->db->insert('meta', array(
				'user_id' => $user->id,
				'first_name' => $fb_user->first_name,
				'last_name' => $fb_user->last_name,
				'fb_id' => $fb_user->id
			));
			redirect('admin/home/index');
		}
	}

	public function sign_in()
	{
	
		// Override layout file 
	    // Because we are accessing this from /admin/ 
	 	$this->layout->theme   = 'admin'; 
	 	$this->layout->layout  = 'login'; 
	
	
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true)
		{
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'), $remember))
			{
				 if($this->input->post('redirect')) 
					{ 
	                    // Now redirect 
		                    redirect($this->input->post('redirect'), 'refresh'); 
		                } 
		                else 
		                { 
		                    redirect('admin', 'refresh'); 
		            } 
					
			} else {
				
					$data = array(); 
							 
					if($this->input->get('redirect')) 
						{ 
							$data['redirect'] = $this->input->get('redirect'); 
						} 
						
					collect('errors',  (validation_errors()) ? explode("\n", validation_errors()) : FALSE); 
					$this->load->view('auth/sign_in', $data); 
				}
		}
		else
		{
			collect('message',  (validation_errors()) ? validation_errors() : FALSE);
			$this->load->view('auth/sign_in');
		}
	}
	
	public function logout()
	{
		$this->ion_auth->logout();
		$this->facebook->logout();
		$this->tweet->logout();
		redirect('admin/login', 'refresh');
	}

	public function change_password()
	{
		$this->form_validation->set_rules('old', 'Old password', 'required');
		$this->form_validation->set_rules('new', 'New Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', 'Confirm New Password', 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('admin/login', 'refresh');
		}
		$user = $this->ion_auth->get_user($this->session->userdata('user_id'));

		if ($this->form_validation->run() == false)
		{ //display the form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['old_password'] = array('name' => 'old',
				'id' => 'old',
				'type' => 'password',
			);
			$this->data['new_password'] = array('name' => 'new',
				'id' => 'new',
				'type' => 'password',
			);
			$this->data['new_password_confirm'] = array('name' => 'new_confirm',
				'id' => 'new_confirm',
				'type' => 'password',
			);
			$this->data['user_id'] = array('name' => 'user_id',
				'id' => 'user_id',
				'type' => 'hidden',
				'value' => $user->id,
			);

			//render
			$this->load->view('admin/auth/change_password', $this->data);
		}
		else
		{
			$identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{ //if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('admin/auth/change_password', 'refresh');
			}
		}
	}

	//forgot password
	public function forgot_password()
	{
		$this->form_validation->set_rules('email', 'Email Address', 'required');
		if ($this->form_validation->run() == false)
		{
			//setup the input
			$this->data['email'] = array('name' => 'email',
				'id' => 'email',
			);
			//set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->load->view('auth/forgot_password', $this->data);
		}
		else
		{
			//run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));

			if ($forgotten)
			{ //if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("admin/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("admin/auth/forgot_password", 'refresh');
			}
		}
	}

	//reset password - final step for forgotten password
	public function reset_password($code)
	{
		$reset = $this->ion_auth->forgotten_password_complete($code);

		if ($reset)
		{  //if the reset worked then send them to the login page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("admin/login", 'refresh');
		}
		else
		{ //if the reset didnt work then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("admin/auth/forgot_password", 'refresh');
		}
	}

	private function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	private function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
				$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}
