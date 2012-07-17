<?php

class MY_Controller extends CI_Controller {

	public $layout;
	
	public function __construct() {
		parent::__construct();
		$this->load->library('TinyMapper');
		foreach(glob(APPPATH.'models/*_model.php') as $model) {
			if(! strpos($model, 'ion_auth')) {
				require FCPATH.$model;
			}
		}
		$this->load->library('facebook');
		$this->load->library('tweet');
		$this->load->library('ion_auth');
		$this->db->cache_off();
		$user = current_user();
		$timezone = $user && $user->timezone ? $user->timezone : 'Europe/London';
		$this->db->cache_on();
		date_default_timezone_set($timezone);
		unset($user, $timezone);
		$this->load->theme = setting('themes.default_theme');
		require(APPPATH.'libraries/Layout.php');
		$this->layout = new Layout();
	}
	
}

class Admin_Controller extends CI_Controller {

	public $layout;

	public function __construct() {
		parent::__construct();
		$this->db->cache_off();
		$this->load->library('TinyMapper');
		foreach(glob(APPPATH.'models/*_model.php') as $model) {
			if(! strpos($model, 'ion_auth')) {
				require FCPATH.$model;
			}
		}
		$this->load->library('facebook');
		$this->load->library('tweet');
		$this->load->library('ion_auth');
		
		// Only allow users in the admin group, even if they have permissions set
		if(user_logged_in() AND (int)current_user()->group_id === 2)
		{
			redirect('');
		}
		
		if(! in_array($this->router->fetch_class(), array('auth')) && ! user_logged_in()) {
			if(uri_string() === 'admin') 
	 	            { 
	 	                redirect('admin/login'); 
	 	            } 
					else 
	 	            { 
	 	                redirect('admin/login?redirect='.uri_string()); 
	 	            } 
			return;
		}
		$this->load->library('ACL');
		if(! can('view_admin_panel')) {
			redirect('/');
			return;
		}
		$method = str_replace(array('index', 'create', 'update', 'show'), array('view', 'add', 'edit', 'view'), $this->router->fetch_method());
		$rule = $method.'_'.plural($this->router->fetch_class());
		// die($rule);
		
		$allowed = can('edit_galleries') ? array('set_as_cover', 'autocomplete') : array();
		$allowed = can('edit_settings') ? array_merge($allowed, array('multi_update')) : $allowed;
		$allowed = can('edit_users') ? array_merge($allowed, array('columns', 'create_column', 'remove_column')) : $allowed;
		$allowed = can('edit_orders') ? array_merge($allowed, array('reports', 'offers')) : $allowed;
		if($this->router->fetch_class() !== 'home' && ! in_array($this->router->fetch_method(), $allowed) && ! can($rule)) {
			redirect('admin');
			return;
		}
		require APPPATH.'libraries/Layout.php';
		$this->load->theme = 'admin';
		$this->layout = new Layout;
		$user = current_user();
		$timezone = $user && $user->timezone ? $user->timezone : 'Europe/London';
		date_default_timezone_set($timezone);
		unset($user, $timezone);
	}
	
	public function is_ajax()
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
    }
	
}

/**
 * Plain controller - does nothing at all.
 * The idea being AJAX needs responses in plain text, so
 * we don't want any layout stuff loading automatically.
 */
class Plain_Controller extends CI_Controller {

	/**
	 * For some reason if you don't exit at the end of a controller method,
	 * it will 404 no matter what. No doubt this is a side affect of the 
	 * horendous core hack that is the custom routing, but it's there so
	 * we gotta learn to live and love it.
	 *
	 * I'll probably never remember to exit; in controller methods, so I've
	 * made this little hack instead which will call the method with all
	 * options passed as an array in the first (and only) method parameter.
	 * After calling the requested method, it exists here so we don't have to.
	 *
	 * Example URL:
	 *   http://localhost/hello/world/test
	 *
	 * Calls method like this:
	 *   $this->hello(array(
	 *   	'world',
	 *   	'test'
	 *   ));
	 * 
	 * Magic! No more 404s :D
	 */
	public function __construct()
	{
		parent::__construct();

		$segments = $this->uri->segment_array();
		$controller = array_shift($segments);
		$method = count($segments) > 0 ? array_shift($segments) : $controller;

		eval('$this->' . $method . '($segments);');
		exit;
	}
}