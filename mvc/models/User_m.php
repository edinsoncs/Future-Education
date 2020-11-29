<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User_m extends CI_Model{

  function  get_user() {
      $query = $this->db->get('msit_tb_user');
      return $query->row();
  }

  function get_order_by_user($username, $password) {
    $username = htmlentities($username);
    $password= htmlentities($password);
    $query = $this->db->get_where('msit_tb_user', array('user_name' => $username, 'user_pass' => md5($password)));
      return $query->row();
  }

  function get_order_by_email($email_address) {
    $username = htmlentities($email_address);
    $query = $this->db->get_where('msit_tb_user', array('email_address' => $email_address));
     return $query->row();
  }
 // set secrict code
 public function get_code_update($email,$data){
    if($this->db->where('email_address', $email)->update('msit_tb_user',$data)) {
    return true;
    } else {
    return false;
    //$this->db->update('msit_tb_user', $data, "email_address ='$email'");
    }
   //eturn TRUE;
 }
 // chack get all forgot password code
 public function chack_all_forgot_code($code){
$query = $this->db->get_where('msit_tb_user', array('forgot_password' => $code));
 //$query = $this->db->get_where('msit_tb_user', array('forgot_password'=> $code));
  // $query =$this->db->get('msit_tb_user');
   return $query->row() ;
 }
 // chack forgot password code
 public function chack_password_code($code){
   $this->db->get_where('msit_tb_user', array('forgot_password'=> $code));
   return TRUE ;
 }
 // user forgot password update
 public function update_user_password($code,$attr){
   $this->db->where('forgot_password', $code)->update('msit_tb_user',$attr);
   return TRUE;
 }


}
