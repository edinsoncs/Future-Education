<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Student_m extends CI_Model{

  // get data table
  public function get_info(){
    $query = $this->db->order_by('std_display_id','DESC')->get('msit_tb_student_info');
    return $query->result();
  }
  // get student info accrodign to std_display_id
  public function get_stdID_info($std_display_id){
   $query = $this->db->get_where('msit_tb_student_info', array('std_display_id' => $std_display_id));
   if ($query->num_rows()==1) {
     return $query->result();
   }
   else {
     return FALSE;
   }
 }

  // get department data
 public function get_department(){
  $query = $this->db->get('msit_tb_dept_info');
  return $query->result();
}

  // chack email address
public function chackStdEmail($chackEamil) {
  $query = $this->db->get_where('msit_tb_student_info', array('std_email_address' => $chackEamil));
  return $query->row();
}
  // chack contact no
public function chackStdContact($chackContact) {
  $query = $this->db->get_where('msit_tb_student_info', array('std_contact_no' => $chackContact));
  return $query->row();
}
  // chack student ID
public function chackStdID($chackID) {
  $query = $this->db->get_where('msit_tb_student_info', array('std_id' => $chackID));
  return $query->row();
}
  // insert new student or login data
public function add_student_info($array,$std_user_info){
  $this->db->insert('msit_tb_student_info',$array);
  $this->db->insert('msit_tb_user',$std_user_info);
  return TRUE;
}

    //  chack std ID , email address , contact no.... brfor update
public function get_single_student($displayID){
  $query = $this->db->get_where('msit_tb_student_info', array('std_display_id' => $displayID));
  return $query->row();
}

    // for std ID
public function get_student($studentID, $id){
  $query = $this->db->get_where('msit_tb_student_info', array('std_id' => $studentID, 'id !=' => $id));
  return $query->row();
}

    // for email chaking
public function get_student_email($email_address, $id){
 $query = $this->db->get_where('msit_tb_student_info', array('std_email_address' => $email_address, 'id !=' => $id));
 return $query->row();
}
    // for contact chaking
public function get_student_contact($contactNO, $id){
 $query = $this->db->get_where('msit_tb_student_info', array('std_contact_no' => $contactNO, 'id !=' => $id));
 return $query->row();
}


    // update  info
public function update_student_info($array,$std_user_info,$std_display_id){
  $this->db->where('std_display_id', $std_display_id);
  $this->db->update('msit_tb_student_info', $array);
  $this->db->where('user_id', $std_display_id);
  $this->db->update('msit_tb_user', $std_user_info);
  return TRUE;

}

    // update activate info
public function update_activate_info($array,$display_id){
  $this->db->where('std_display_id', $display_id);
  $this->db->update('msit_tb_student_info', $array);
  $this->db->where('user_id', $display_id);
  $this->db->update('msit_tb_user', $array);
  return TRUE;

}

    // update complete graduation info
public function update_complete_info($array,$display_id){
  $this->db->where('std_display_id', $display_id);
  $this->db->update('msit_tb_student_info', $array);
  return TRUE;

}

}
