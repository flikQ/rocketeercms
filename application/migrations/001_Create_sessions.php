<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_sessions extends CI_Migration {

	public function up() {
		$this->dbforge->add_key('session_id', TRUE);
		$this->dbforge->add_field(array(
			'session_id' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'default' => '0',
				'null' => FALSE
			),
			'ip_address' => array(
				'type' => 'VARCHAR',
				'constraint' => 16,
				'default' => '0',
				'null' => FALSE
			),
			'user_agent' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				'null' => FALSE
			),
			'last_activity' => array(
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => TRUE,
				'default' => 0,
				'null' => FALSE
			),
			'user_data' => array(
				'type' => 'TEXT',
				'null' => FALSE,
				'default' => ''
			)
		));
		$this->dbforge->create_table('sessions', TRUE);
	}
	
	public function down() {
		$this->dbforge->drop_table('sessions');
	}

}
