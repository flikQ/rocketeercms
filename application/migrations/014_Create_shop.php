<?php

class Migration_Create_shop extends CI_Migration {

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
			'url_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'description' => array(
				'type' => 'TEXT',
				'null' => FALSE
			),
			'created_at' => array(
				'type' => 'INT'
			)
		));
		$this->dbforge->create_table('shop_categories', TRUE);
		
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'category_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => FALSE
			),
			'description' => array(
				'type' => 'TEXT',
				'null' => FALSE
			),
			'price' => array(
				'type' => 'FLOAT',
				'null' => FALSE,
				'default' => 0
			),
			'currency' => array(
				'type' => 'VARCHAR',
				'constraint' => 5,
				'default' => 'USD'
			),
			'created_at' => array(
				'type' => 'INT'
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
			'updated_at' => array(
				'type' => 'INT'
			),
			'url_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			)
		));
		$this->dbforge->create_table('shop_items', TRUE);
		
		$this->load->library('ACL');
		
		$this->acl->add_right('view_shop_categories', 0);
		$this->acl->add_right('add_shop_categories', 0);
		$this->acl->add_right('edit_shop_categories', 0);
		$this->acl->add_right('remove_shop_categories', 0);
		$this->acl->add_right('view_shop_items', 0);
		$this->acl->add_right('add_shop_items', 0);
		$this->acl->add_right('edit_shop_items', 0);
		$this->acl->add_right('remove_shop_items', 0);
	}
	
	public function down() {
		$this->dbforge->drop_table('shop_categories');
		$this->dbforge->drop_table('shop_items');
		
		$this->load->library('ACL');
		$this->acl->remove_right('view_shop_categories');
		$this->acl->remove_right('add_shop_categories');
		$this->acl->remove_right('edit_shop_categories');
		$this->acl->remove_right('remove_shop_categories');
		$this->acl->remove_right('view_shop_items');
		$this->acl->remove_right('add_shop_items');
		$this->acl->remove_right('edit_shop_items');
		$this->acl->remove_right('remove_shop_items');
	}

}
