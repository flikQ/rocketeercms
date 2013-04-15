<?php

class Migration_Create_spotlights extends CI_Migration {

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
				'constraint' => 255,
				'null' => FALSE
			),
			'template_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'default' => 'default'
			),
			'created_at' => array(
				'type' => 'INT'
			),
			'updated_at' => array(
				'type' => 'INT'
			)
		));
		$this->dbforge->create_table('spotlights', TRUE);
		
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'spotlight_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'headline' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'url' => array(
				'type' => 'TEXT',
				'null' => FALSE
			),
			'description' => array(
				'type' => 'TEXT'
			),
			'image_url' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'image_thumb_url' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'image_thumb_path' => array(
				'type' => 'TEXT',
				'null' => FALSE
			),
			'image_filename' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'image_mime' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => FALSE
			),
			'image_size' => array(
				'type' => 'INT',
				'null' => FALSE
			),
			'image_path' => array(
				'type' => 'TEXT'
			)
		));
		$this->dbforge->create_table('spotlight_items', TRUE);
		
		$this->load->library('ACL');
		$this->acl->add_right('view_spotlights', 0);
		$this->acl->add_right('add_spotlights', 0);
		$this->acl->add_right('edit_spotlights', 0);
		$this->acl->add_right('remove_spotlights', 0);
		$this->acl->add_right('view_spotlight_items', 0);
		$this->acl->add_right('add_spotlight_items', 0);
		$this->acl->add_right('edit_spotlight_items', 0);
		$this->acl->add_right('remove_spotlight_items', 0);
	}
	
	public function down() {
		$this->dbforge->drop_table('spotlights');
		$this->dbforge->drop_table('spotlight_items');
		
		$this->load->library('ACL');
		$this->acl->remove_right('view_spotlights');
		$this->acl->remove_right('add_spotlights');
		$this->acl->remove_right('edit_spotlights');
		$this->acl->remove_right('remove_spotlights');
		$this->acl->remove_right('view_spotlight_items');
		$this->acl->remove_right('add_spotlight_items');
		$this->acl->remove_right('edit_spotlight_items');
		$this->acl->remove_right('remove_spotlight_items');
	}
	
}
