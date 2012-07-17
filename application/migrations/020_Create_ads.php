<?php

class Migration_Create_ads extends CI_Migration {

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
			'views_count' => array(
				'type' => 'INT',
				'default' => 0
			),
			'views_limit' => array(
				'type' => 'INT',
				'default' => 0
			),
			'slot_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'embed_code' => array(
				'type' => 'TEXT'
			),
			'url' => array(
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
		$this->dbforge->create_table('ads', TRUE);
		
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
			'image_width' => array(
				'type' => 'INT',
				'unsigned' => TRUE
			),
			'image_height' => array(
				'type' => 'INT',
				'unsigned' => TRUE
			)
		));
		$this->dbforge->create_table('ad_slots', TRUE);
		
		$this->load->library('ACL');
		$this->acl->add_right('view_ads', 0);
		$this->acl->add_right('add_ads', 0);
		$this->acl->add_right('edit_ads', 0);
		$this->acl->add_right('remove_ads', 0);
		$this->acl->add_right('view_ad_slots', 0);
		$this->acl->add_right('add_ad_slots', 0);
		$this->acl->add_right('edit_ad_slots', 0);
		$this->acl->add_right('remove_ad_slots', 0);
	}

	public function down() {
		$this->dbforge->drop_table('ads');
		$this->dbforge->drop_table('ad_slots');
		
		$this->load->library('ACL');
		$this->acl->remove_right('view_ads');
		$this->acl->remove_right('add_ads');
		$this->acl->remove_right('edit_ads');
		$this->acl->remove_right('remove_ads');
		$this->acl->remove_right('view_ad_slots');
		$this->acl->remove_right('add_ad_slots');
		$this->acl->remove_right('edit_ad_slots');
		$this->acl->remove_right('remove_ad_slots');
	}

}
