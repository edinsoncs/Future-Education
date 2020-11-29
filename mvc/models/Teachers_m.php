<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Teachers_m extends CI_Model{

  // get data table
  public function get_info(){
      $query = $this->db->get('msit_tb_teacher_info');
      return $query->result();
    }
  // get department
  public function get_dept(){
    $query = $this->db->get('msit_tb_dept_info');
    return $query->result();
  }
  // chack user ID
  public function chackUserID($chackID) {
    $query = $this->db->get_where('msit_tb_teacher_info', array('user_name' => $chackID));
    return $query->row();
  }
  // chack email address
  public function chackTecEmail($chackEamil) {
    $query = $this->db->get_where('msit_tb_teacher_info', array('email_address' => $chackEamil));
    return $query->row();
  }
  // chack contact no
  public function chackTecContact($chackContact) {
    $query = $this->db->get_where('msit_tb_teacher_info', array('contact_no' => $chackContact));
    return $query->row();
  }

  // insert teachers info
  public function add_teacher_info($attr){
    $insert = $this->db->insert('msit_tb_teacher_info',$attr);
    if($insert){
      return TRUE;
    }
    else{
        return FALSE;
    }
  }
  // insert new teacher login data
  public function add_teacher_user_info($attr){
      $insert = $this->db->insert('msit_tb_user',$attr);
      if($insert){
        return TRUE;
      }
      else{
          return FALSE;
      }
    }
  // delete teacher user a row
  public function delete_teachers_user($display_id){
      $this->db->delete('msit_tb_teacher_info', array('display_id' => $display_id));
      $this->db->delete('msit_tb_user', array('user_id' => $display_id));
      if($this->db->affected_rows()==1){
        return TRUE ;
      }
      else {
        return FALSE;
      }
    }
  // retrive  user data
  public function user_retrive_info($display_id){
      $query = $this->db->get_where('msit_tb_teacher_info', array('display_id' => $display_id));
      // return $query->row();
      if ($query->num_rows()==1) {
        return $query->result();
      }
      else {
        return FALSE;
      }
    }

  // chack data befor update
  public function get_single_teacher($displayID){
    $query = $this->db->get_where('msit_tb_teacher_info', array('display_id' => $displayID));
    return $query->row();
  }
 // for usermane chacking
  public function get_teacher($username, $id){
     $query = $this->db->get_where('msit_tb_teacher_info', array('user_name' => $username, 'id !=' => $id));
     return $query->row();
  }
  // for email chaking
  public function get_teacher_email($email_address, $id){
     $query = $this->db->get_where('msit_tb_teacher_info', array('email_address' => $email_address, 'id !=' => $id));
     return $query->row();
  }
  // for contact chaking
  public function get_teacher_contact($contactNO, $id){
     $query = $this->db->get_where('msit_tb_teacher_info', array('contact_no' => $contactNO, 'id !=' => $id));
     return $query->row();
  }


  // update  info
  public function update_teacher_user($array,$display_id){
      $this->db->where('user_id', $display_id);
      $this->db->update('msit_tb_user', $array);
      return TRUE;
    }
  public function update_teacher_info($array,$display_id){
      $this->db->where('display_id', $display_id);
      $this->db->update('msit_tb_teacher_info', $array);
      return TRUE;
    }







}
