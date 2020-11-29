<?php

class Migration_create_transport extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'route_from' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				"null" => FALSE
			),
			'route_to' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				"null" => FALSE
			),
			'vehicle_no' => array(
				'type' => 'VARCHAR',
				'constraint' => '5',
				"null" => FALSE
			),
			'departure_time' => array(
				'type' => 'VARCHAR',
				'constraint' => '150',
				"null" => FALSE
			),
			'yearly_fare' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				"null" => FALSE
			),
			'off_day' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				"null" => FALSE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('msit_tb_transport');
	}

	public function down()
	{
		$this->dbforge->drop_table('msit_tb_transport');
	}
}