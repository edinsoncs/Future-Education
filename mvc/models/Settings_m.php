<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Settings_m extends CI_Model{

  // for update settings informetion
  function update_settings_data($attr){

    $this->db->update('msit_tb_settings', $attr);

    return TRUE;
  }

  function maxUser() {
    $query = $this->db->select_max('user_id')->get('msit_tb_user');
    return $query->row()->user_id+1;
  }


}
