<?php

class Migration_Create_friends extends CI_Migration {

	public function up() {
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'status' => array(
				'type' => 'ENUM',
				'null' => FALSE,
				'constraint' => '"pending","accepted","denied"',
				'default' => 'pending'
			),
			'user_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'friend_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			)
		));
		$this->dbforge->create_table('friends', TRUE);
	}
	
	public function down() {
		$this->dbforge->drop_table('friends');
	}

}
