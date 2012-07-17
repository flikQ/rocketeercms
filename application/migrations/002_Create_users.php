<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_users extends CI_Migration {

	public function up() {
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
				'null' => FALSE
			),
			'group_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => FALSE
			),
			'ip_address' => array(
				'type' => 'CHAR',
				'constraint' => 16,
				'null' => FALSE
			),
			'username' => array(
				'type' => 'VARCHAR',
				'constraint' => 15,
				'null' => FALSE
			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => FALSE
			),
			'salt' => array(
				'type' => 'VARCHAR',
				'constraint' => 40
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => 100,
				'null' => FALSE
			),
			'activation_code' => array(
				'type' => 'VARCHAR',
				'constraint' => 40
			),
			'forgotten_password_code' => array(
				'type' => 'VARCHAR',
				'constraint' => 40
			),
			'remember_code' => array(
				'type' => 'VARCHAR',
				'constraint' => 40
			),
			'created_on' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => FALSE
			),
			'last_login' => array(
				'type' => 'INT',
				'unsigned' => TRUE
			),
			'active' => array(
				'type' => 'TINYINT',
				'constraint' => 1
			),
			'avatar_url' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'avatar_thumb_url' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'avatar_thumb_path' => array(
				'type' => 'TEXT',
				'null' => FALSE
			),
			'avatar_filename' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'avatar_mime' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => FALSE
			),
			'avatar_size' => array(
				'type' => 'INT',
				'null' => FALSE
			),
			'avatar_path' => array(
				'type' => 'TEXT'
			),
			'timezone' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'default' => 'Europe/London'
			),
			'comments_number' => array(
				'type' => 'INT',
				'default' => 0
			),
			'forum_threads_number' => array(
				'type' => 'INT',
				'default' => 0
			),
			'forum_posts_number' => array(
				'type' => 'INT',
				'default' => 0
			)
		));
		$this->dbforge->create_table('users', TRUE);
		$this->db->insert('users', array(
			'group_id' => 1,
			'ip_address' => '127.0.0.1',
			'username' => 'admin',
			'password' => '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4',
			'salt' => '9462e8eee0',
			'email' => 'admin@admin.com',
			'activation_code' => '',
			'forgotten_password_code' => NULL,
			'created_on' => 1268889823,
			'last_login' => 1268889823,
			'active' => 1
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'auto_increment' => TRUE,
				'unsigned' => TRUE
			),
			'user_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'first_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'last_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'country' => array(
				'type' => 'VARCHAR',
				'constraint' => 40
			),
			'fb_id' => array(
				'type' => 'INT'
			),
			'twt_id' => array(
				'type' => 'INT'
			)
		));
		$this->dbforge->create_table('meta', TRUE);
		$this->db->insert('meta', array(
			'user_id' => 1,
			'first_name' => 'Admin',
			'last_name' => 'Admin',
			'country' => 'Internet'
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'auto_increment' => TRUE,
				'unsigned' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 20,
				'null' => FALSE
			),
			'description' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			)
		));
		$this->dbforge->create_table('groups', TRUE);
		$this->db->insert('groups', array(
			'name' => 'admins',
			'description' => 'Administrators'
		));
		$this->db->insert('groups', array(
			'name' => 'members',
			'description' => 'Members'
		));
		$this->db->insert('groups', array(
			'name' => 'contributors',
			'description' => 'Contributors'
		));
		$this->db->insert('groups', array(
			'name' => 'squad_members',
			'description' => 'Squad Members'
		));
		$this->db->insert('groups', array(
			'name' => 'authors',
			'description' => 'Authors'
		));
		
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'group_id' => array(
				'type' => 'INT',
				'null' => FALSE
			),
			'key' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => FALSE
			),
			'value' => array(
				'type' => 'BOOL'
			)
		));
		$this->dbforge->create_table('acl', TRUE);
		
		$this->load->library('ACL');
		$this->acl->add_right('view_admin_panel', 0);
		$this->acl->add_right('view_users', 0);
		$this->acl->add_right('view_user_groups', 0);
		$this->acl->add_right('view_user_rights', 0);
		$this->acl->add_right('add_users', 0);
		$this->acl->add_right('edit_users', 0);
		$this->acl->add_right('remove_users', 0);
		$this->acl->add_right('add_user_groups', 0);
		$this->acl->add_right('edit_user_groups', 0);
		$this->acl->add_right('remove_user_groups', 0);
		$this->acl->add_right('add_user_rights', 0);
		$this->acl->add_right('edit_user_rights', 0);
		$this->acl->add_right('remove_user_rights', 0);
		
	}

	public function down() {
		$this->dbforge->drop_table('users');
		$this->dbforge->drop_table('meta');
		$this->dbforge->drop_table('groups');
		$this->dbforge->drop_table('acl');
	}

}
