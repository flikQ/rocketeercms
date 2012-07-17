<?php

class Migration_Create_orders extends CI_Migration {

	public function up() {
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'created_at' => array(
				'type' => 'INT'
			),
			'resource' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => FALSE
			),
			'resource_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'price' => array(
				'type' => 'FLOAT',
				'default' => 0
			),
			'currency' => array(
				'type' => 'VARCHAR',
				'constraint' => 5,
				'default' => 'USD'
			),
			'status' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'default' => 'Processing'
			)
		));
		$this->dbforge->create_table('orders', TRUE);
		
		$this->load->library('ACL');
		$this->acl->add_right('view_orders', 0);
		$this->acl->add_right('add_orders', 0);
		$this->acl->add_right('edit_orders', 0);
		$this->acl->add_right('remove_orders', 0);
		
		$this->db->insert('settings', array(
			'key' => 'currency',
			'value' => 'USD',
			'category_name' => 'orders'
		));
		$this->db->insert('settings', array(
			'key' => 'paypal_email',
			'value' => '',
			'category_name' => 'orders'
		));
	}
	
	public function down() {
		$this->dbforge->drop_table('orders');
		
		$this->load->library('ACL');
		$this->acl->remove_right('view_orders');
		$this->acl->remove_right('add_orders');
		$this->acl->remove_right('edit_orders');
		$this->acl->remove_right('remove_orders');
	}

}
