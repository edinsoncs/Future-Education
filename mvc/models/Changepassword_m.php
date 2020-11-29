<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Changepassword_m extends CI_Model{

// get chack password accroding to user id
public function chackpassword($id){
  $query = $this->db->get_where('msit_tb_user', array('user_id'=> $id));
  return $query->row();
}
// update or change password
public function updatePassword($attr,$user_id){
  $this->db->where('user_id', $user_id);
  $this->db->update('msit_tb_user', $attr);
  return TRUE;
}

}
