<?php

class Migration_Create_articles extends CI_Migration {

	public function up() {
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'auto_increment' => TRUE,
				'unsigned' => TRUE
			),
			'section_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'category_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
			),
			'content' => array(
				'type' => 'TEXT',
				'null' => FALSE
			),
			'short_content' => array(
				'type' => 'VARCHAR',
				'constraint' => 140
			),
			'created_at' => array(
				'type' => 'INT'
			),
			'updated_at' => array(
				'type' => 'INT'
			),
			'user_id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'is_approved' => array(
				'type' => 'BOOL'
			),
			'url_title' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE
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
			),
			'comments_number' => array(
				'type' => 'INT',
				'default' => 0
			)
		));
		$this->dbforge->create_table('articles', TRUE);
		
		$schema = array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'auto_increment' => TRUE,
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
			'created_at' => array(
				'type' => 'INT'
			)
		);
		
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field($schema);
		$this->dbforge->create_table('article_categories', TRUE);
		
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field($schema);
		$this->dbforge->create_table('article_sections', TRUE);
		
		$this->load->library('ACL');
		$this->acl->add_right('view_articles', 0);
		$this->acl->add_right('add_articles', 0);
		$this->acl->add_right('edit_articles', 0);
		$this->acl->add_right('remove_articles', 0);
		$this->acl->add_right('approve_articles', 0);
		$this->acl->add_right('view_article_categories', 0);
		$this->acl->add_right('add_article_categories', 0);
		$this->acl->add_right('edit_article_categories', 0);
		$this->acl->add_right('remove_article_categories', 0);
		$this->acl->add_right('view_article_sections', 0);
		$this->acl->add_right('add_article_sections', 0);
		$this->acl->add_right('edit_article_sections', 0);
		$this->acl->add_right('remove_article_sections', 0);
	}
	
	public function down() {
		$this->dbforge->drop_table('articles');
		$this->dbforge->drop_table('article_categories');
		$this->dbforge->drop_table('article_sections');
		$this->load->library('ACL');
		$this->acl->remove_right('view_articles');
		$this->acl->remove_right('add_articles');
		$this->acl->remove_right('edit_articles');
		$this->acl->remove_right('remove_articles');
		$this->acl->remove_right('approve_articles');
		$this->acl->remove_right('view_article_categories');
		$this->acl->remove_right('add_article_categories');
		$this->acl->remove_right('edit_article_categories');
		$this->acl->remove_right('remove_article_categories');
		$this->acl->remove_right('view_article_sections');
		$this->acl->remove_right('add_article_sections');
		$this->acl->remove_right('edit_article_sections');
		$this->acl->remove_right('remove_article_sections');
	}
	
}
