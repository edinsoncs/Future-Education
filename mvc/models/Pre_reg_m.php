<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Pre_reg_m extends CI_Model{

  // get basic info
  public function get_std_info($display_id){
    $query = $this->db->get_where('msit_tb_student_info', array('std_display_id'=>$display_id));
    return $query->row();
  }
  // get last date for PRE-REGISTRATION
  public function get_last_date_for_reg($std_dept,$std_batch,$std_section){
    $query = $this->db->limit(1)->order_by('assign_semester_code','DESC')->get_where('msit_tb_assign_semester',
              array('assign_dept'=>$std_dept,'assign_batch'=>$std_batch,'assign_section'=>$std_section));
    return $query->row();
  }

  // get subject accroding to semester for PRE-REGISTRATION
  public function get_assign_sub_for_semester($std_dept,$std_batch,$std_section,$chack_date){
    $query = $this->db->order_by('assign_semester_code','DESC')->get_where('msit_tb_assign_semester',
              array('assign_dept'=>$std_dept,'assign_batch'=>$std_batch,'assign_section'=>$std_section ,'assign_reg_start_date' => $chack_date));
    return $query->result();
  }

  // get selected subject
  public function get_subject($subject){
    $query = $this->db->get_where('msit_tb_assign_semester',array('id'=>$subject));
    return $query->row();

  }
  // get semester code
  public function get_semester_code(){
    $query = $this->db->limit(1)->order_by('semester_code',' DESC')->get('msit_tb_semester_code');
    return $query->row();
  }
  // get match
  public function get_match($semester_code,$std_dept,$std_batch,$std_section,$sub_code,$display_id){
    $query = $this->db->get_where('msit_tb_result', array(
      'semester_code' => $semester_code ,
      'std_dept'             => $std_dept,
      'std_batch'            => $std_batch,
      'std_section'          => $std_section,
      'sub_code'             => $sub_code,
      'std_display_id'       => $display_id
    ));
    return $query->row();

  }
  // insert pre-registration
  public function insert_pre_registration($setArray){
    $insert = $this->db->insert('msit_tb_result',$setArray);
    if($insert){
      return TRUE;
    } else {
      return FALSE;
    }
  }
  //get chack publish
  public function get_chack() {
    $query = $this->db->limit('1')->order_by('action','ASC')->get('msit_tb_semester_code');
    return $query->row();

  }


}
