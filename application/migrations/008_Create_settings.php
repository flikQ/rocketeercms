<?php

class Migration_Create_settings extends CI_Migration {

	public function up() {
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'key' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => FALSE
			),
			'value' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'category_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => FALSE,
				'default' => 'general'
			)
		));
		$this->dbforge->create_table('settings', TRUE);
		
		// db:seed
		$this->db->insert('settings', array(
			'key' => 'site_title',
			'value' => 'Default Website Title',
			'category_name' => 'general'
		));
		$this->db->insert('settings', array(
			'key' => 'default_theme',
			'value' => 'default',
			'category_name' => 'themes'
		));
		$this->db->insert('settings', array(
			'key' => 'site_id',
			'value' => '',
			'category_name' => 'google_analytics'
		));
		$this->db->insert('settings', array(
			'key' => 'username',
			'value' => '',
			'category_name' => 'google_analytics'
		));
		$this->db->insert('settings', array(
			'key' => 'password',
			'value' => '',
			'category_name' => 'google_analytics'
		));
		
		$this->db->insert('settings', array(
			'key' => 'image_width',
			'value' => 150,
			'category_name' => 'articles'
		));
		$this->db->insert('settings', array(
			'key' => 'image_height',
			'value' => 150,
			'category_name' => 'articles'
		));
		$this->db->insert('settings', array(
			'key' => 'photo_width',
			'value' => 150,
			'category_name' => 'photos'
		));
		$this->db->insert('settings', array(
			'key' => 'photo_height',
			'value' => 150,
			'category_name' => 'photos'
		));
		$this->db->insert('settings', array(
			'key' => 'photo_width',
			'value' => 150,
			'category_name' => 'shop'
		));
		$this->db->insert('settings', array(
			'key' => 'photo_height',
			'value' => 150,
			'category_name' => 'shop'
		));
		$this->db->insert('settings', array(
			'key' => 'photo_width',
			'value' => 150,
			'category_name' => 'sponsors'
		));
		$this->db->insert('settings', array(
			'key' => 'photo_height',
			'value' => 150,
			'category_name' => 'sponsors'
		));
		$this->db->insert('settings', array(
			'key' => 'avatar_width',
			'value' => 150,
			'category_name' => 'users'
		));
		$this->db->insert('settings', array(
			'key' => 'avatar_height',
			'value' => 150,
			'category_name' => 'users'
		));
		
		// End Image Properties
		
		// Pagination
		$this->db->insert('settings', array(
			'key' => 'per_page',
			'value' => 10,
			'category_name' => 'articles'
		));
		$this->db->insert('settings', array(
			'key' => 'per_page',
			'value' => 10,
			'category_name' => 'files'
		));
		$this->db->insert('settings', array(
			'key' => 'threads_per_page',
			'value' => 10,
			'category_name' => 'forums'
		));
		$this->db->insert('settings', array(
			'key' => 'posts_per_page',
			'value' => 10,
			'category_name' => 'forums'
		));
		$this->db->insert('settings', array(
			'key' => 'per_page',
			'value' => 10,
			'category_name' => 'galleries'
		));
		$this->db->insert('settings', array(
			'key' => 'per_page',
			'value' => 10,
			'category_name' => 'matches'
		));
		$this->db->insert('settings', array(
			'key' => 'per_page',
			'value' => 10,
			'category_name' => 'photos'
		));
		$this->db->insert('settings', array(
			'key' => 'per_page',
			'value' => 20,
			'category_name' => 'private_messages'
		));
		$this->db->insert('settings', array(
			'key' => 'per_page',
			'value' => 10,
			'category_name' => 'shop'
		));
		$this->db->insert('settings', array(
			'key' => 'per_page',
			'value' => 10,
			'category_name' => 'videos'
		));
		
		// End Pagination
		
		$this->load->library('ACL');
		$this->acl->add_right('view_settings', 0);
		$this->acl->add_right('add_settings', 0);
		$this->acl->add_right('edit_settings', 0);
		$this->acl->add_right('remove_settings', 0);
	}
	
	public function down() {
		$this->dbforge->drop_table('settings');
		
		$this->load->library('ACL');
		$this->acl->remove_right('view_settings');
		$this->acl->remove_right('add_settings');
		$this->acl->remove_right('edit_settings');
		$this->acl->remove_right('remove_settings');
		
	}
	
}
