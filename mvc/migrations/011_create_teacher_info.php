<?php

class Migration_create_teacher_info extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'display_id' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				"null" => FALSE
			),
			'teacher_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '150',
				"null" => FALSE
			),
			'teacher_designation' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				"null" => FALSE
			),
			'teacher_department' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				"null" => FALSE
			),
			'date_of_join' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				"null" => FALSE
			),
			'teacher_gender' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				"null" => FALSE
			),
			'teacher_religion' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				"null" => FALSE
			),
			'email_address' => array(
				'type' => 'VARCHAR',
				'constraint' => '150',
				"null" => FALSE
			),
			'contact_no' => array(
				'type' => 'VARCHAR',
				'constraint' => '15',
				"null" => FALSE
			),
			'user_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				"null" => FALSE
			),
			'access_type' => array(
				'type' => 'VARCHAR',
				'constraint' => '5',
				"null" => FALSE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('msit_tb_teacher_info');
	}

	public function down()
	{
		$this->dbforge->drop_table('msit_tb_teacher_info');
	}
}