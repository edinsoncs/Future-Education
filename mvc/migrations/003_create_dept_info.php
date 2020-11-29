<?php

class Migration_create_dept_info extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'dept_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				"null" => FALSE
			),
			'dept_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				"null" => FALSE
			),
			'dept_sort_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '10',
				"null" => FALSE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('msit_tb_dept_info');
	}

	public function down()
	{
		$this->dbforge->drop_table('msit_tb_dept_info');
	}
}