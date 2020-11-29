<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Transport_m extends CI_Model{

    // get basic info
	public function get_data(){
		$query = $this->db->get('msit_tb_transport');
		return $query->result();
	}
	// add data
	public function create_new($array){
		$insert = $this->db->insert('msit_tb_transport',$array);
		if($insert){
			return TRUE;
		}else {
			return FALSE;
		}
	}
	// retrive  data
	public function get_single_notice($id){
		$query = $this->db->get_where('msit_tb_transport', array('id' => $id));
      // return $query->row();
		if ($query->num_rows()==1) {
			return $query->row();
		}
		else {
			return FALSE;
		}
	}
	// update data
	public function update_data($id,$array){
		$this->db->affected_rows();
		$this->db->where('id', $id);
		$this->db->update('msit_tb_transport', $array);
		return TRUE;
	}
	// delete data
	public function delete_data($id = null){
		$this->db->delete('msit_tb_transport', array('id' => $id));
		if($this->db->affected_rows()==1){
			return TRUE;
		} else {
			return FALSE;
		}
	}
}