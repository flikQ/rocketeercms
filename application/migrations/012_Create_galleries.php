<?php

class Migration_Create_galleries extends CI_Migration {

	public function up() {
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'user_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => FALSE
			),
			'short_description' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'description' => array(
				'type' => 'TEXT'
			),
			'cover_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE
			),
			'url_title' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'comments_number' => array(
				'type' => 'INT',
				'default' => 0
			),
			'created_at' => array(
				'type' => 'INT'
			),
			'updated_at' => array(
				'type' => 'INT'
			)
		));
		$this->dbforge->create_table('galleries');
		
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'user_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'photo_url' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'photo_thumb_url' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'photo_thumb_path' => array(
				'type' => 'TEXT',
				'null' => FALSE
			),
			'photo_filename' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'photo_mime' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => FALSE
			),
			'photo_size' => array(
				'type' => 'INT',
				'null' => FALSE
			),
			'photo_path' => array(
				'type' => 'TEXT'
			),
			'created_at' => array(
				'type' => 'INT'
			),
			'gallery_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => FALSE
			),
			'description' => array(
				'type' => 'TEXT'
			),
			'comments_number' => array(
				'type' => 'INT',
				'default' => 0
			)
		));
		$this->dbforge->create_table('photos');
		
		$this->load->library('ACL');
		$this->acl->add_right('view_galleries', 0);
		$this->acl->add_right('add_galleries', 0);
		$this->acl->add_right('edit_galleries', 0);
		$this->acl->add_right('remove_galleries', 0);
		$this->acl->add_right('view_photos', 0);
		$this->acl->add_right('add_photos', 0);
		$this->acl->add_right('edit_photos', 0);
		$this->acl->add_right('remove_photos', 0);
	}
	
	public function down() {
		$this->dbforge->drop_table('galleries');
		$this->dbforge->drop_table('photos');
		
		$this->load->library('ACL');
		$this->acl->remove_right('view_galleries');
		$this->acl->remove_right('add_galleries');
		$this->acl->remove_right('edit_galleries');
		$this->acl->remove_right('remove_galleries');
		$this->acl->remove_right('view_photos');
		$this->acl->remove_right('add_photos');
		$this->acl->remove_right('edit_photos');
		$this->acl->remove_right('remove_photos');
	}

}
