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
			redirect(login_url(), 'refresh');
			return;
		}
		redirect('', 'refresh');
	}
	
	public function captcha()
	{
		$width  = 60;
		$height = 20;
		
		$im = @imagecreate($width, $height) or die('There was a problem creating the image');
		imagecolorallocate($im, 228, 228, 228); // background colour
		
		 //$noise_color = imagecolorallocate($im, 221, 221, 221);
		
		 //for($i = 0; $i < ($width * $height) / 3; $i++)
		 //{
		 //	imagefilledellipse($im, mt_rand(0, $width), mt_rand(0, $height), 1, 1, $noise_color);
		 //}
		
		 //for($i = 0; $i < ($width * $height) / 120; $i++)
		 //{
		 //	imageline($im, mt_rand(0, $width), mt_rand(0, $height), mt_rand(0, $width), mt_rand(0, $height), $noise_color);
		 //}
		
		$text_color = imagecolorallocate($im, 80, 80, 80);
		
		
		// $action = array('+', '*', '-');
		$action = array('+');
		shuffle($action);
		
		if($action[0] === '+')
		{
			$a = rand(1, 9);
			$b = rand(1, 9);
			
			$this->session->set_userdata('captcha_code', $a + $b);
		}
		elseif($action[0] === '*')
		{
			$a = rand(1, 9);
			$b = rand(1, 9);
			
			$this->session->set_userdata('captcha_code', $a * $b);
		}
		else
		{
			$a = rand(1, 9);
			$b = rand(1, 9);
			
			$this->session->set_userdata('captcha_code', $a - $b);
		}
		
		$text = $a.$action[0].$b;
		
		for($j = 0; $j < strlen($text); $j++)
		{
			// $angle = rand(-20, 20);
			$angle = 0;
			// imagettftext($im, 12, $angle, 29+($j*23), (18+(($height-18)/2)), $text_color,
			imagettftext($im, 10, $angle, 1+($j*23), (15+(($height-18)/2)), $text_color, FCPATH.'themes/'.setting('themes.default_theme').'/assets/fonts/museosans_500-webfont.ttf', $text[$j]);
		}
		
		header("Content-type: image/png");
		
		imagepng($im);
		imagedestroy($im);
		
		exit;
	}
	
	public function twt_sign_in() {
		if(! $this->tweet->logged_in()) {
			$this->tweet->set_callback(base_url().'auth/twt_sign_in');
			$this->tweet->login();
		} else {
			$twt_user = $this->tweet->call('get', 'account/verify_credentials');
			$result = $this->db->limit(1)->where('twt_id', $twt_user->id_str)->get('meta');
			if($result->num_rows() == 1) {
				redirect(profile_url());
				return;
			}
			$user = new User;
			$user->group_id = 2;
			$user->username = $twt_user->screen_name;
			$user->avatar_thumb_url = $twt_user->profile_image_url;
			$user->avatar_url = $twt_user->profile_image_url;
			$user->save(FALSE);
			list($first_name, $last_name) = explode(' ', $twt_user->name);
			$this->db->insert('meta', array(
				'user_id' => $user->id,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'twt_id' => $twt_user->id_str
			));
			redirect('');
		}
	}
	
	public function fb_sign_in() {
		if(! $this->facebook->logged_in()) {
			$this->facebook->set_callback(base_url().'auth/fb_sign_in');
			$this->facebook->login();
		} else {
			$fb_user = $this->facebook->call('get', 'me', array('metadata' => 1))->__resp->data;
			$result = $this->db->limit(1)->where('fb_id', $fb_user->id)->get('meta');
			if($result->num_rows() == 1) {
				redirect(profile_url());
				return;
			}
			$user = new User;
			$user->group_id = 2;
			$user->username = str_replace(' ', '_', strtolower($fb_user->name));
			$user->avatar_thumb_url = 'http://graph.facebook.com/'.$fb_user->id.'/picture?type=large';
			$user->avatar_url = 'http://graph.facebook.com/'.$fb_user->id.'/picture?type=large';
			$user->save(FALSE);
			$this->db->insert('meta', array(
				'user_id' => $user->id,
				'first_name' => $fb_user->first_name,
				'last_name' => $fb_user->last_name,
				'fb_id' => $fb_user->id
			));
			redirect('');
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
				redirect("login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("forgotten", 'refresh');
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
			redirect("login", 'refresh');
		}
		else
		{ //if the reset didnt work then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("forgotten", 'refresh');
		}
	}

	public function sign_in()
	{	
		// No point visiting page if your already logged in
		if(user_logged_in())
		{
			redirect('');
		}
		
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
					redirect('/', 'refresh');
				}
				
			} else {
				collect('message', $this->ion_auth->errors());
				$this->load->view('auth/sign_in'); 
			}
		}
		else
		{
			$data = array();
			
			if($this->input->get('redirect'))
			{
				$data['redirect'] = $this->input->get('redirect');
			}
			
			collect('errors',  (validation_errors()) ? explode("\n", validation_errors()) : FALSE);
			$this->load->view('auth/sign_in', $data);
		}
	}
	
	public function logout()
	{
		$this->ion_auth->logout();
		$this->facebook->logout();
		$this->tweet->logout();
		redirect(login_url(), 'refresh');
	}
	
	
	
	public function sign_up()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required|matches[password_confirm]');
		$this->form_validation->set_rules('country', 'Country', 'required');
		
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$country = $this->input->post('country');
		$password = $this->input->post('password');
		if ($this->form_validation->run() == true && ! username_check($username))
		{
		// Check captcha
		//if(!$this->session->userdata('captcha_code') OR 
		//   ($this->session->userdata('captcha_code') != $this->input->post('captcha')))
		//{
		//		collect('errors', array('<p>The captcha answer was incorrect</p>'));
		//	}
		//	else
		//	{
		if($this->ion_auth->register($username, $password, $email, $country, array()) == TRUE) {
					redirect(activate_url(), 'refresh');
					} else {
						collect('errors', validation_errors() ? explode("\n", validation_errors()) : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
						}
						
		} else {
			collect('errors', explode("\n", validation_errors()));
		}
		
		$this->load->view('auth/sign_up', array(
			'username' => ($this->input->post('username')) ?: '',
			'email'    => ($this->input->post('email')) ?: '',
			'country' => ($this->input->post('country')) ?: ''
		));
	}
	
	public function activation() {
		$this->load->view('auth/activation');
	}
	
	public function activate() {
		$user_id = $this->uri->segment(3);
		$code = $this->uri->segment(4);
		if($this->ion_auth->activate($user_id, $code)) {
			redirect(login_url());
			return;
		} else {
			// @TODO
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
