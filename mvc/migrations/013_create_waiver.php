<?php

class Migration_create_waiver extends CI_Migration {

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
				'constraint' => '20',
				"null" => FALSE
			),
			'std_id' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
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
				'constraint' => '50',
				"null" => FALSE
			),
			'std_section' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				"null" => FALSE
			),
			'sub_code' => array(
				'type' => 'VARCHAR',
				'constraint' => '15',
				"null" => FALSE
			),
			'sub_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '150',
				"null" => FALSE
			),
			'sub_credit' => array(
				'type' => 'VARCHAR',
				'constraint' => '5',
				"null" => FALSE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('msit_tb_waiver');
	}

	public function down()
	{
		$this->dbforge->drop_table('msit_tb_waiver');
	}
}