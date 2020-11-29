<?php

class Migration_create_semester_code extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'season_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				"null" => FALSE
			),
			'year_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				"null" => FALSE
			),
			'semester_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				"null" => FALSE
			),
			'action' => array(
				'type' => 'VARCHAR',
				'constraint' => '1',
				"null" => FALSE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('msit_tb_semester_code');
	}

	public function down()
	{
		$this->dbforge->drop_table('msit_tb_semester_code');
	}
}