<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Waiver_m extends CI_Model{

// retrive stu id single info
  public function get_single_student($studentID){
    $query = $this->db->get_where('msit_tb_student_info', array('std_id' => $studentID));
  // return $query->row();
    if ($query->num_rows()==1) {
      return $query->row();
    }
    else {
      return FALSE;
    }
  }

// get waiver all data
  public function get_waiver(){
    $this->db->group_by('std_display_id');
    $query = $this->db->get('msit_tb_waiver');
    return $query->result();
  }

// delete waiver subject
  public function delete_data($id = null){
    $this->db->delete('msit_tb_waiver', array('id' => $id));
    if($this->db->affected_rows()==1){
      return TRUE;
    } else {
      return FALSE;
    }
  }

//  get subject list
  function get_subject_list($subject){
   $query = $this->db->get_where('msit_tb_subject', array('id' => $subject));
   return $query->result();
 }

 function get_single_subject_list($subject){
   $query = $this->db->get_where('msit_tb_subject', array('id' => $subject));
   return $query->row();
 }

 function get_student_subject_with_id($studentID, $subjectcode){
   $query = $this->db->get_where('msit_tb_waiver', array('std_id' => $studentID , 'sub_code' =>  $subjectcode));
   return $query->row();
 }
// get match alert
 public function get_match($sub_code,$display_id){
  $query = $this->db->get_where('msit_tb_waiver', array(
    'sub_code' => $sub_code,
    'std_id'   => $display_id
    ));
  return $query->row();

}

// insert waivers
public function insert_waiver($attr){
  $insert = $this->db->insert('msit_tb_waiver',$attr);
  if($insert){
    return TRUE;
  } else {
    return FALSE;
  }
}


/* === view waiver subject === */

// get id wase student info
public function get_data_accroding_to_id($id){
  $query = $this->db->get_where('msit_tb_waiver', array('id' => $id));
  return $query->row();
}
//  get waiver sub list accroding to std display id
public function get_sub_accroding_to_std_display_id($std_display_id){
 $query = $this->db->get_where('msit_tb_waiver', array('std_display_id' => $std_display_id));
 return $query->result();
}

public function delete_group_wais_data($std_display_id){
  $this->db->delete('msit_tb_waiver', array('std_display_id' => $std_display_id));
  if($this->db->affected_rows()==1){
    return TRUE;
  } else {
    return FALSE;
  }
}

}
