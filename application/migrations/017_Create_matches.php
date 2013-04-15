<?php

class Migration_Create_matches extends CI_Migration {

	public function up() {
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'squad_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'score' => array(
				'type' => 'INT',
				'null' => FALSE,
				'default' => 0
			),
			'opponent_score' => array(
				'type' => 'INT',
				'null' => FALSE,
				'default' => 0
			),
			'opponent' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => FALSE
			),
			'tournament' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'description' => array(
				'type' => 'TEXT'
			),
			'starts_at' => array(
				'type' => 'INT'
			),
			'is_finished' => array(
				'type' => 'BOOL'
			)
		));
		$this->dbforge->create_table('matches', TRUE);
		
		$this->load->library('ACL');
		$this->acl->add_right('view_matches', 0);
		$this->acl->add_right('add_matches', 0);
		$this->acl->add_right('edit_matches', 0);
		$this->acl->add_right('remove_matches', 0);
	}
	
	public function down() {
		$this->dbforge->drop_table('matches');
		
		$this->load->library('ACL');
		$this->acl->remove_right('view_matches');
		$this->acl->remove_right('add_matches');
		$this->acl->remove_right('edit_matches');
		$this->acl->remove_right('remove_matches');
	}

}
