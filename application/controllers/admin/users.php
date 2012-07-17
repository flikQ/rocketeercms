<?php

class Users extends Admin_Controller {

	public $menu = array(
		'consists_of' => array('user_groups', 'user_rights'),
		'show' => TRUE
	);

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$user = new User;
		$base_url = '/admin/users/index/';
		$group_id = param('group_id');
		if($group_id) {
			$base_url = 'group_id/'.$group_id.'/';
			$user->where('group_id', $group_id);
		}
		$total_rows = $user->count();
		$this->load->library('pagination');
		$this->pagination->initialize(array(
			'total_rows' => $total_rows,
			'base_url' => $base_url.'page/',
			'per_page' => 20,
			'uri_segment' => 'page',
			'full_tag_open' => '<ul>',
			'full_tag_close' => '</ul>',
			'first_link' => '',
			'last_link' => '',
			'previous_link' => '',
			'next_link' => '',
			'cur_tag_open' => '<li class="active">',
			'cur_tag_close' => '</li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>'
		));
		$this->load->view('users/index', array(
			'users' => $user->select('users.*, (SELECT description FROM groups WHERE groups.id = users.group_id) AS group_descr', FALSE)->order_by('created_on', 'desc')->limit(20)->offset((int) param('page'))->get(),
			'pagination' => $this->pagination->create_links(),
			'group_id' => $group_id,
			'groups' => $this->db->from('groups')->get()->result_object()
		));
	}
	
	public function add() {
		$group = new User_Group;
		$groups = array();
		foreach($group->get() as $item) {
			$groups[$item->id] = humanize($item->name);
		}
		$this->load->view('users/add', array(
			'groups' => $groups
		));
	}
	
	public function create() {
		$data = $this->input->post('user');
		
		// print_r($data);
		
		$meta = $this->input->post('meta');
		
		// print_r($meta);
		
		if(! $this->ion_auth->register($data['username'], $data['password'], $data['email'], $meta)) {
			flash('errors', array('You should enter all data'));
			redirect('admin/users/add');
			return;
		}
		redirect('admin/users/index');
	}
	
	public function edit() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$user = new User($id);
		if(! $user->exists()) {
			show_404();
		}
		$group = new User_Group;
		$groups = array();
		foreach($group->get() as $item) {
			$groups[$item->id] = humanize($item->name);
		}
		$_meta = $this->db->where('user_id', $user->id)->limit(1)->get('meta')->result_object();
		$meta = array();
		foreach($_meta[0] as $key=>$value) {
			if(! in_array($key, array('id', 'user_id', 'fb_id', 'twt_id'))) {
				$meta[$key] = $value;
			}
		}
		$this->load->view('users/edit', array(
			'groups' => $groups,
			'user' => $user,
			'meta' => $meta
		));
	}
	
	public function update() {
		$id = $this->input->post('id');
		if(! $id) {
			show_error('User ID not found');
		}
		$user = new User($id);
		if(! $user->exists()) {
			show_404();
		}
		$salt = $user->salt;
		$user->data($this->input->post('user'));
		$user->save();
		$this->db->where('user_id', $id)->update('meta', $this->input->post('meta'));
		
		// Update password if it's filled
		$new_password = trim($this->input->post('new_password'));
		$new_password_r = trim($this->input->post('new_password_r'));
		
		if($new_password !== '' && $new_password_r !== '')
		{
			if($new_password == $new_password_r)
			{
				$password = $this->ion_auth_model->hash_password($new_password, $salt);
				
				// Change password in the database
				$this->db->update('users', array('password' => $password, 'remember_code' => ''), 'email = "' . $user->email . '"');
			}
		}
		
		redirect('admin/users/index');
	}
	
	public function remove() {
		$id = param('id');
		if(! $id) {
			show_404();
		}
		$user = new User($id);
		if(! $user->exists()) {
			show_404();
		}
		$user->remove();
		
		$this->db->where('user_id', $user->id);
		$this->db->delete('comments');
		
		redirect('admin/users/index');
	}
	
	public function columns() {
		$result = $this->db->simple_query('DESCRIBE `meta`');
		$columns = array();
		while($data = mysql_fetch_object($result)) {
			if(! in_array($data->Field, array('id', 'user_id', 'twt_id', 'fb_id'))) {
				if(strpos($data->Type, 'int') === 0) {
					$type = 'integer';
				} elseif($data->Type == 'varchar') {
					$type = 'varchar';
				} elseif($data->Type == 'char') {
					$type = 'char';
				} elseif($data->Type == 'text') {
					$type = 'text';
				} else { $type = 'unknown'; }
				$columns[] = array('column' => $data->Field, 'type' => $type);
			}
		}
		$this->layout->js = array('jquery-1.5.1.min', 'users.columns');
		$this->load->view('users/columns', array(
			'columns' => $columns
		));
	}
	
	public function create_column() {
		$column = underscore($this->input->post('column'));
		$type = $this->input->post('type');
		$this->load->dbforge();
		$data = array(
			'type' => $type
		);
		if(in_array(strtolower($type), array('varchar', 'char'))) {
			$data['constraint'] = 255;
		} 
		$this->dbforge->add_column('meta', array($column => $data));
		redirect('admin/users/columns');
	}
	
	public function remove_column() {
		$column = param('column');
		$this->load->dbforge();
		$this->dbforge->drop_column('meta', $column);
		redirect('admin/users/columns');
	}
	
	public function autocomplete() {
		$q = $this->input->get('q');
		if(! $q) {
			echo json_encode(array());
			return;
		}
		$users = $this->db->like('first_name', $q)->or_like('last_name', $q)->get('meta')->result_object();
		$result = array();
		foreach($users as $_user) {
			$user = new User($_user->user_id);
			$result[] = array('id' => $user->id, 'name' => $user->username.' - '.$user->full_name());
		}
		$user = new User;
		$users = $user->like('username', $q)->get();
		foreach($users as $user) {
			if(count($result) > 0) {
				foreach($result as $item) {
					if($item['id'] !== $user->id) {
						$result[] = array('id' => $user->id, 'name' => $user->username.' - '.$user->full_name());
					}
				}
			} else {
				$result[] = array('id' => $user->id, 'name' => $user->username.' - '.$user->full_name());
			}
		}
		echo json_encode($result);
	}

	public function search() {
	
	
		// Search term
		$q = $this->input->get('q');
		$page   = ($this->input->get('page')) ? $this->input->get('page') : 1;
		
		// Search params
		$per_page   = 40;
		$pagination = '';
		
		if(strlen(trim($q)) > 0)
		{
		
			$result = array();
			$result_count = 0;
			$query = FALSE; 
			
			
			$this->db->select('a.id, a.username, a.created_on, m.first_name, m.last_name, g.description');
			$this->db->from('users a');
			$this->db->join('meta m', 'a.id = m.user_id');
			$this->db->join('groups g', 'a.group_id = g.id');
			
			// Search article title
			$this->db->where("CONCAT_WS(' ', m.first_name, m.last_name) LIKE '%".$q."%'");
			$this->db->or_where("a.username LIKE '%".$q."%'");
			
			$this->db->order_by('a.id', 'DESC');
			$this->db->group_by('a.id');
			
			
			// Get Results
			$query = $this->db->get();
			$result = array();
			
			if($query->num_rows() > 0)
			{
				$result = $query->result();
			}
			
		} else {
		
			$result = array();
			$result_count = 0;
		
		}
		
		if($result_count > 0) {
		
			$this->load->library('pagination');
			
			$config['query_string_segment'] = 'page';
            $config['total_rows']           = $result_count;
            $config['per_page']             = $per_page;
            $config['page_query_string']    = true;
            $config['base_url']             = current_url().'?a='.$a;

            $this->pagination->initialize($config);
			
			$pagination = $this->pagination->create_links();
		
		}
		
		
		$this->load->view('users/search', array(
		    'count'      => $result_count,
			'result'     => $result,
			'pagination' => $pagination
		));
	
	
	}

}
