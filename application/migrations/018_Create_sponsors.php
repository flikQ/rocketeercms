<?php

class Migration_Create_sponsors extends CI_Migration {

	public function up() {
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'category_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => FALSE
			),
			'description' => array(
				'type' => 'TEXT',
				'null' => FALSE
			),
			'created_at' => array(
				'type' => 'INT'
			),
			'updated_at' => array(
				'type' => 'INT'
			),
			'logo_url' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'logo_filename' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'logo_mime' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => FALSE
			),
			'logo_size' => array(
				'type' => 'INT',
				'null' => FALSE
			),
			'logo_path' => array(
				'type' => 'TEXT'
			)
		));
		$this->dbforge->create_table('sponsors', TRUE);
		
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => FALSE
			)
		));
		$this->dbforge->create_table('sponsor_categories', TRUE);
		
		$this->load->library('ACL');
		$this->acl->add_right('view_sponsors', 0);
		$this->acl->add_right('add_sponsors', 0);
		$this->acl->add_right('edit_sponsors', 0);
		$this->acl->add_right('remove_sponsors', 0);
		$this->acl->add_right('view_sponsor_categories', 0);
		$this->acl->add_right('add_sponsor_categories', 0);
		$this->acl->add_right('edit_sponsor_categories', 0);
		$this->acl->add_right('remove_sponsor_categories', 0);
	}
	
	public function down() {
		$this->dbforge->drop_table('sponsors');
		$this->dbforge->drop_table('sponsor_categories');
		
		$this->load->library('ACL');
		$this->acl->remove_right('view_sponsors');
		$this->acl->remove_right('add_sponsors');
		$this->acl->remove_right('edit_sponsors');
		$this->acl->remove_right('remove_sponsors');
		$this->acl->remove_right('view_sponsor_categories');
		$this->acl->remove_right('add_sponsor_categories');
		$this->acl->remove_right('edit_sponsor_categories');
		$this->acl->remove_right('remove_sponsor_categories');
	}

}
