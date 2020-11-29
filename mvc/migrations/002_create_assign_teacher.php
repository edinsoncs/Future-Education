<?php

class Migration_create_assign_teacher extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'semester_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				"null" => FALSE
			),
			'std_batch' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				"null" => FALSE
			),
			'std_section' => array(
				'type' => 'VARCHAR',
				'constraint' => '15',
				"null" => FALSE
			),
			'sub_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '12',
				"null" => FALSE
			),
			'sub_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '150',
				'null' => FALSE
			),
			'sub_credit' => array(
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => FALSE
			),
			'assign_teacher' => array(
				'type' => 'VARCHAR',
				'constraint' => '150',
				'null' => FALSE
			),
			'display_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => FALSE
			),
			'alternative_teacher' => array(
				'type' => 'VARCHAR',
				'constraint' => '150',
				'null' => TRUE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('msit_tb_assign_teacher');
	}

	public function down()
	{
		$this->dbforge->drop_table('msit_tb_assign_teacher');
	}
}