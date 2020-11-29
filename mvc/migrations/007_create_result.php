<?php

class Migration_create_result extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'assign_season' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				"null" => TRUE
			),
			'assign_year' => array(
				'type' => 'VARCHAR',
				'constraint' => '4',
				"null" => TRUE
			),
			'semester_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '5',
				"null" => TRUE
			),
			'std_display_id' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				"null" => TRUE
			),
			'std_id' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				"null" => TRUE
			),
			'std_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '150',
				"null" => TRUE
			),
			'std_dept' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				"null" => TRUE
			),
			'std_batch' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				"null" => TRUE
			),
			'std_section' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				"null" => TRUE
			),
			'sub_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				"null" => TRUE
			),
			'sub_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '150',
				"null" => TRUE
			),
			'sub_credit' => array(
				'type' => 'VARCHAR',
				'constraint' => '5',
				"null" => TRUE
			),
			'attendance' => array(
				'type' => 'VARCHAR',
				'constraint' => '3',
				"null" => TRUE
			),
			'class_test' => array(
				'type' => 'VARCHAR',
				'constraint' => '4',
				"null" => TRUE
			),
			'mid_exam' => array(
				'type' => 'VARCHAR',
				'constraint' => '4',
				"null" => TRUE
			),
			'final_exam' => array(
				'type' => 'VARCHAR',
				'constraint' => '4',
				"null" => TRUE
			),
			'total_number' => array(
				'type' => 'VARCHAR',
				'constraint' => '4',
				"null" => TRUE
			),
			'gpa_point' => array(
				'type' => 'VARCHAR',
				'constraint' => '5',
				"null" => TRUE
			),
			'grade_point' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				"null" => TRUE
			),
			'action' => array(
				'type' => 'VARCHAR',
				'constraint' => '2',
				"null" => TRUE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('msit_tb_result');
	}

	public function down()
	{
		$this->dbforge->drop_table('msit_tb_result');
	}
}