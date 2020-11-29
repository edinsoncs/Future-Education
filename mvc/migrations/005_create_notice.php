<?php

class Migration_create_notice extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'note_no' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				"null" => FALSE
			),
			'publish_date' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				"null" => FALSE
			),
			'note_subject' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				"null" => FALSE
			),
			'note_message' => array(
				'type' => 'VARCHAR',
				'constraint' => '1000',
				"null" => FALSE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('msit_tb_notice');
	}

	public function down()
	{
		$this->dbforge->drop_table('msit_tb_notice');
	}
}