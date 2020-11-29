<?php

class Migration_create_notification extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'user_id' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				"null" => FALSE
			),
			'notice_no' => array(
				'type' => 'VARCHAR',
				'constraint' => '5',
				"null" => FALSE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('msit_tb_notification');
	}

	public function down()
	{
		$this->dbforge->drop_table('msit_tb_notification');
	}
}