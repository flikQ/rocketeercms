<?php

class Migration_Create_comments extends CI_Migration {

	public function up() {
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'resource_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'user_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'resource' => array(
				'type' => 'VARCHAR',
				'constraint' => 20,
				'null' => FALSE
			),
			'content' => array(
				'type' => 'TEXT',
				'null' => FALSE
			),
			'created_at' => array(
				'type' => 'INT',
				'null' => FALSE
			)
		));
		$this->dbforge->create_table('comments', TRUE);
		
		$this->load->library('ACL');
		$this->acl->add_right('view_comments', 0);
	}
	
	public function down() {
		$this->dbforge->drop_table('comments');
		$this->load->library('ACL');
		$this->acl->remove_right('view_comments');
	}
	
}
