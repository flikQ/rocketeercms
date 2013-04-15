<?php

class Migration_Create_private_messages extends CI_Migration {

	public function up() {
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'sender_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'receiver_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'folder' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => FALSE,
				'default' => 'incoming'
			),
			'subject' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'content' => array(
				'type' => 'TEXT',
				'null' => FALSE
			),
			'created_at' => array(
				'type' => 'INT'
			),
			'is_read' => array(
				'type' => 'BOOL'
			)
		));
		$this->dbforge->create_table('private_messages', TRUE);
	}
	
	public function down() {
		$this->dbforge->drop_table('private_messages');
	}

}
