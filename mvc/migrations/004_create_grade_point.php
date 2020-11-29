<?php

class Migration_create_grade_point extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'gread' => array(
				'type' => 'VARCHAR',
				'constraint' => '5',
				"null" => FALSE
			),
			'gread_point' => array(
				'type' => 'VARCHAR',
				'constraint' => '5',
				"null" => FALSE
			),
			'form_mark' => array(
				'type' => 'VARCHAR',
				'constraint' => '5',
				"null" => FALSE
			),
			'to_mark' => array(
				'type' => 'VARCHAR',
				'constraint' => '5',
				"null" => FALSE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('msit_tb_grade_point');
	}

	public function down()
	{
		$this->dbforge->drop_table('msit_tb_grade_point');
	}
}