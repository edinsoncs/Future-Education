<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class ResultArchive_m extends CI_Model{

  //  get all student result summary
  public function get_all_result($null){
   $this->db->select('msit_tb_student_info.required_credit,msit_tb_result.std_display_id,msit_tb_result.gpa_point,msit_tb_result.id,msit_tb_result.std_id,msit_tb_result.std_name,msit_tb_result.std_dept,msit_tb_result.std_batch,sum(msit_tb_result.sub_credit)as credit,');
   $this->db->select('sum(msit_tb_result.sub_credit * msit_tb_result.gpa_point)as point');
   $this->db->join('msit_tb_student_info', 'msit_tb_result.std_display_id = msit_tb_student_info.std_display_id');
   $this->db->group_by('msit_tb_result.std_display_id');
   $query = $this->db->get_where('msit_tb_result', array('action' => 1, 'gpa_point!=' => $null));
   return $query->result();
 }
  // get waiver summary
 public function show_std_waiver(){
  $query = $this->db->select('std_display_id,sum(sub_credit)as waiver_credit')->get('msit_tb_waiver');
  return $query->result();
}
// std basic info
public function get_info(){
  $query = $this->db->get('msit_tb_student_info');
  return $query->result();
}
// public functions get_single_info($display_id){
//   $query = $this->db->get_where('msit_tb_student_info',('std_display_id'=>$display_id));
//   return $query->row();
// }


  // get last semester code
public function get_semester_code() {
  $query = $this->db->limit(1)->order_by('semester_code','DESC')->get('msit_tb_semester_code');
  return $query->row();
}
  // result publish
public function publish_result($id,$attr) {
  $this->db->affected_rows();
  $this->db->where('semester_code', $id);
  $this->db->update('msit_tb_result', $attr);
  $this->db->update('msit_tb_semester_code', $attr);
  return TRUE;
}
  // withdrow result
public function withdrow_result($id,$attr){
  $this->db->affected_rows();
  $this->db->where('semester_code', $id);
  $this->db->update('msit_tb_result', $attr);
  $this->db->update('msit_tb_semester_code', $attr);
  return TRUE;
}
/* view marksheet accroding to std*/
  // student informetion
public function std_info($display_id){
  $query = $this->db->get_where('msit_tb_student_info',array('std_display_id'=>$display_id));
  return $query->row();
}
  // get department full name
public function get_dept($std_dept){
  $query = $this->db->get_where('msit_tb_dept_info', array('dept_sort_name'=>$std_dept));
  return $query->row();
}
  // get waiver subject
public function get_waiver_sub($display_id){
  $query = $this->db->get_where('msit_tb_waiver', array('std_display_id'=>$display_id));
  return $query->result();
}
  // get waiver display ID
public function get_display_id($display_id) {
  $query = $this->db->get_where('msit_tb_waiver', array('std_display_id'=>$display_id));
  return $query->row();
}

  // get point table
public function point_table($display_id){
  $this->db->select('semester_code,sub_credit,action,sum(sub_credit)as credit');
  $this->db->select('sum(sub_credit * gpa_point)as point');
  $this->db->group_by('semester_code');
  $query = $this->db->get_where('msit_tb_result', array('std_display_id'=>$display_id));
  return $query->result();
}
  // get earn point
public function get_earn_point($display_id, $null){

  $this->db->select('semester_code,sub_credit,action,gpa_point,sum(sub_credit)as credit');
  $this->db->group_by('semester_code');
  $query = $this->db->get_where('msit_tb_result', array('std_display_id'=>$display_id, 'gpa_point!=' => $null));
  return $query->result();

}

  // all subject points
public function per_sub_point_table($display_id){
  $query = $this->db->get_where('msit_tb_result', array('std_display_id'=>$display_id));
  return $query->result();
}
// update complete graduation info
public function update_complete_info($array,$display_id){
  $this->db->where('std_display_id', $display_id);
  $this->db->update('msit_tb_student_info', $array);
  return TRUE;

}

}
