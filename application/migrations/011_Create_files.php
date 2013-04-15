<?php

class Migration_Create_files extends CI_Migration {

	public function up() {
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => FALSE,
				'auto_increment' => TRUE
			),
			'user_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => FALSE
			),
			'file_url' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'file_filename' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'file_mime' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => FALSE
			),
			'file_size' => array(
				'type' => 'INT',
				'null' => FALSE
			),
			'file_path' => array(
				'type' => 'TEXT'
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => FALSE
			),
			'description' => array(
				'type' => 'TEXT'
			),
			'download_counter' => array(
				'type' => 'INT',
				'default' => 0
			),
			'created_at' => array(
				'type' => 'INT'
			),
			'category_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => FALSE
			)
		));
		$this->dbforge->create_table('files', TRUE);
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
				'constraint' => 40,
				'null' => FALSE
			),
			'url_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'created_at' => array(
				'type' => 'INT'
			)
		));
		$this->dbforge->create_table('file_categories', TRUE);
		
		$this->load->library('ACL');
		$this->acl->add_right('view_files', 0);
		$this->acl->add_right('add_files', 0);
		$this->acl->add_right('edit_files', 0);
		$this->acl->add_right('remove_files', 0);
		$this->acl->add_right('view_file_categories', 0);
		$this->acl->add_right('add_file_categories', 0);
		$this->acl->add_right('edit_file_categories', 0);
		$this->acl->add_right('remove_file_categories', 0);
		
	}
	
	public function down() {
		$this->dbforge->drop_table('files');
		$this->dbforge->drop_table('file_categories');
		
		$this->load->library('ACL');
		$this->acl->remove_right('view_files');
		$this->acl->remove_right('add_files');
		$this->acl->remove_right('edit_files');
		$this->acl->remove_right('remove_files');
		$this->acl->remove_right('view_file_categories');
		$this->acl->remove_right('add_file_categories');
		$this->acl->remove_right('edit_file_categories');
		$this->acl->remove_right('remove_file_categories');
	}

}
