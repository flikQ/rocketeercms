<?php

class Migration_Create_squads extends CI_Migration {

	public function up() {
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
			),
			'description' => array(
				'type' => 'TEXT'
			)
		));
		$this->dbforge->create_table('squads', TRUE);
		
		$this->dbforge->add_field(array(
			'squad_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'user_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			)
		));
		$this->dbforge->create_table('squad_members', TRUE);
		
		$this->load->library('ACL');
		$this->acl->add_right('view_squads', 0);
		$this->acl->add_right('add_squads', 0);
		$this->acl->add_right('edit_squads', 0);
		$this->acl->add_right('remove_squads', 0);
		$this->acl->add_right('view_squad_members', 0);
		$this->acl->add_right('add_squad_members', 0);
		$this->acl->add_right('edit_squad_members', 0);
		$this->acl->add_right('remove_squad_members', 0);
		
		$this->db->insert('settings', array(
			'key' => 'team_name',
			'value' => 'Team Dignitas',
			'category_name' => 'squads'
		));
		
	}
	
	public function down() {
		$this->dbforge->drop_table('squads');
		
		$this->load->library('ACL');
		$this->acl->remove_right('view_squads');
		$this->acl->remove_right('add_squads');
		$this->acl->remove_right('edit_squads');
		$this->acl->remove_right('remove_squads');
		$this->acl->remove_right('view_squad_members');
		$this->acl->remove_right('add_squad_members');
		$this->acl->remove_right('edit_squad_members');
		$this->acl->remove_right('remove_squad_members');
	}

}
