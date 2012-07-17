<?php

class Migration_Create_pages extends CI_Migration {

	public function up() {
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'url_title' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'content' => array(
				'type' => 'TEXT',
				'null' => FALSE
			),
			'created_at' => array(
				'type' => 'INT'
			),
			'updated_at' => array(
				'type' => 'INT'
			),
			'parent_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'template_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => 'default'
			)
		));
		$this->dbforge->create_table('pages', TRUE);
		
		$this->load->library('ACL');
		$this->acl->add_right('view_pages', 0);
		$this->acl->add_right('add_pages', 0);
		$this->acl->add_right('edit_pages', 0);
		$this->acl->add_right('remove_pages', 0);
		
	}
	
	public function down() {
		$this->dbforge->drop_table('pages');
		
		$this->load->library('ACL');
		$this->acl->remove_right('view_pages');
		$this->acl->remove_right('add_pages');
		$this->acl->remove_right('edit_pages');
		$this->acl->remove_right('remove_pages');
	}

}
