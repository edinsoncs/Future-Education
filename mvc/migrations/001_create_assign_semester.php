<?php

class Migration_create_assign_semester extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'assign_semester_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				"null" => FALSE
			),
			'assign_dept' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				"null" => FALSE
			),
			'assign_batch' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				"null" => FALSE
			),
			'assign_section' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				"null" => FALSE
			),
			'assign_sub_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => FALSE
			),
			'assign_sub_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '300',
				'null' => FALSE
			),
			'assign_sub_cread' => array(
				'type' => 'VARCHAR',
				'constraint' => '11',
				'null' => FALSE
			),
			'assign_reg_start_date' => array(
				'type' => 'VARCHAR',
				'constraint' => '25',
				'null' => FALSE
			),
			'assign_reg_close_date' => array(
				'type' => 'VARCHAR',
				'constraint' => '25',
				'null' => FALSE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('msit_tb_assign_semester');
	}

	public function down()
	{
		$this->dbforge->drop_table('msit_tb_assign_semester');
	}
}