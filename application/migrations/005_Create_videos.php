<?php

class Migration_Create_videos extends CI_Migration {

	public function up() {
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => FALSE,
				'auto_increment' => TRUE
			),
			'embed_code' => array(
				'type' => 'TEXT',
				'null' => FALSE
			),
			'user_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => FALSE
			),
			'category_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => FALSE
			),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'url_title' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'created_at' => array(
				'type' => 'INT'
			),
			'comments_number' => array(
				'type' => 'INT',
				'default' => 0
			)
		));
		$this->dbforge->create_table('videos', TRUE);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => FALSE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => FALSE
			),
			'url_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'created_at' => array(
				'type' => 'INT'
			)
		));
		$this->dbforge->create_table('video_categories', TRUE);
		
		$this->load->library('ACL');
		$this->acl->add_right('view_videos', 0);
		$this->acl->add_right('add_videos', 0);
		$this->acl->add_right('edit_videos', 0);
		$this->acl->add_right('remove_videos', 0);
		$this->acl->add_right('view_video_categories', 0);
		$this->acl->add_right('add_video_categories', 0);
		$this->acl->add_right('edit_video_categories', 0);
		$this->acl->add_right('remove_video_categories', 0);
	}
	
	public function down() {
		$this->dbforge->drop_table('videos');
		$this->dbforge->drop_table('video_categories');
		$this->load->library('ACL');
		$this->acl->remove_right('view_videos');
		$this->acl->remove_right('add_videos');
		$this->acl->remove_right('edit_videos');
		$this->acl->remove_right('remove_videos');
		$this->acl->remove_right('view_video_categories');
		$this->acl->remove_right('add_video_categories');
		$this->acl->remove_right('edit_video_categories');
		$this->acl->remove_right('remove_video_categories');
	}

}
