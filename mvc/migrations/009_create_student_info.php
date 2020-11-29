<?php

class Migration_create_student_info extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'std_display_id' => array(
				'type' => 'VARCHAR',
				'constraint' => '15',
				"null" => FALSE
			),
			'std_id' => array(
				'type' => 'VARCHAR',
				'constraint' => '15',
				"null" => FALSE
			),
			'std_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '150',
				"null" => FALSE
			),
			'std_dept' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				"null" => FALSE
			),
			'std_batch' => array(
				'type' => 'VARCHAR',
				'constraint' => '30',
				"null" => FALSE
			),
			'std_section' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				"null" => FALSE
			),
			'required_credit' => array(
				'type' => 'VARCHAR',
				'constraint' => '3',
				"null" => FALSE
			),
			'std_status' => array(
				'type' => 'VARCHAR',
				'constraint' => '10',
				"null" => FALSE
			),
			'std_gender' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				"null" => FALSE
			),
			'std_religion' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				"null" => FALSE
			),
			'std_email_address' => array(
				'type' => 'VARCHAR',
				'constraint' => '150',
				"null" => FALSE
			),
			'std_contact_no' => array(
				'type' => 'VARCHAR',
				'constraint' => '16',
				"null" => FALSE
			),
			'access_type' => array(
				'type' => 'VARCHAR',
				'constraint' => '2',
				"null" => FALSE
			),
			'std_complete_graduation' => array(
				'type' => 'VARCHAR',
				'constraint' => '2',
				"null" => TRUE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('msit_tb_student_info');
	}

	public function down()
	{
		$this->dbforge->drop_table('msit_tb_student_info');
	}
}