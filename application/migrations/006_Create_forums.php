<?php

class Migration_Create_forums extends CI_Migration {

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
				'type' => 'TEXT'
			),
			'position' => array(
				'type' => 'TINYINT'
			)
		));
		$this->dbforge->create_table('forum_sections', TRUE);
		
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'section_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
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
				'type' => 'TEXT'
			),
			'icon_url' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'icon_filename' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'icon_mime' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => FALSE
			),
			'icon_size' => array(
				'type' => 'INT',
				'null' => FALSE
			),
			'icon_path' => array(
				'type' => 'TEXT'
			),
			'icon_thumb_url' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'icon_thumb_path' => array(
				'type' => 'TEXT',
				'null' => FALSE
			),
			'position' => array(
				'type' => 'TINYINT'
			),
			'forum_threads_number' => array(
				'type' => 'INT',
				'default' => 0
			)
		));
		$this->dbforge->create_table('forums', TRUE);
		
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
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
			'is_sticky' => array(
				'type' => 'BOOL'
			),
			'created_at' => array(
				'type' => 'INT',
				'null' => FALSE
			),
			'updated_at' => array(
				'type' => 'INT',
				'null' => FALSE
			),
			'user_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'forum_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'forum_posts_number' => array(
				'type' => 'INT',
				'default' => 0
			)
		));
		$this->dbforge->create_table('forum_threads', TRUE);
		
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'thread_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'user_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'created_at' => array(
				'type' => 'INT',
				'null' => FALSE
			),
			'updated_at' => array(
				'type' => 'INT'
			),
			'content' => array(
				'type' => 'TEXT',
				'null' => FALSE
			)
		));
		$this->dbforge->create_table('forum_posts', TRUE);
		
		$this->load->library('ACL');
		$this->acl->add_right('view_forums', 0);
		$this->acl->add_right('view_forum_sections', 0);
		$this->acl->add_right('add_forums', 0);
		$this->acl->add_right('edit_forums', 0);
		$this->acl->add_right('remove_forums', 0);
		$this->acl->add_right('add_forum_sections', 0);
		$this->acl->add_right('edit_forum_sections', 0);
		$this->acl->add_right('remove_forum_sections', 0);
		
	}
	
	public function down() {
		$this->dbforge->drop_table('forums');
		$this->dbforge->drop_table('forum_sections');
		$this->dbforge->drop_table('forum_threads');
		$this->dbforge->drop_table('forum_posts');
		
		$this->load->library('ACL');
		$this->acl->remove_right('view_forums');
		$this->acl->remove_right('view_forum_sections');
		$this->acl->remove_right('add_forums');
		$this->acl->remove_right('edit_forums');
		$this->acl->remove_right('remove_forums');
		$this->acl->remove_right('add_forum_sections');
		$this->acl->remove_right('edit_forum_sections');
		$this->acl->remove_right('remove_forum_sections');
	}

}
