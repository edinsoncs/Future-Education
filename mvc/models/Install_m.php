<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Install_m extends CI_Model{

	function __construct() {
		parent::__construct();
		$this->sql_path		= APPPATH.'models/dd.sql';
		$this->load->helper('file');
		$this->load->helper('url');		
		$this->load->database();	
		$this->load->library('session');
	}

	public function insert_setting($data) {
		$this->db->insert('msit_tb_settings', $data);
		return TRUE;
	}

	public function select_setting() {
		$this->db->select('*');
		$query = $this->db->get('msit_tb_settings');
		return $query->result();
	}

	public function update_setting($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('msit_tb_settings', $data);
		return TRUE;

	}

	public function hash($string) {
		return md5($string);
	}

	public function use_sql_string() {
		$sql = read_file($this->sql_path);
		$sql = trim($sql);
		$link = @mysqli_connect($this->db->hostname, $this->db->username, $this->db->password, $this->db->database);
		mysqli_multi_query($link, $sql);
	}

	// public function checkall() {
	// 	return $this->sql_path;
	// }
}
?>
