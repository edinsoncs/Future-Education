<?php

class Migration_create_subject extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'subject_dept' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				"null" => FALSE
			),
			'subject_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				"null" => FALSE
			),
			'subject_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '150',
				"null" => FALSE
			),
			'subject_credit' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				"null" => FALSE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('msit_tb_subject');
	}

	public function down()
	{
		$this->dbforge->drop_table('msit_tb_subject');
	}
}