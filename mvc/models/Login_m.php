<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login_m extends CI_Model{

	public function com_name()
	{
		$query= $this->db->get('msit_tb_settings');
		if( $query -> num_rows() ==1){

    return $query -> result();
    }
	}


	public function user_logged_in(){
		return $this->session->userdata('current_user_id') != FALSE;
	}
}
