<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Dashboard_m extends CI_Model{

/* for student interface*/
  // get required credit
  public function required_credit($display_id){
    $query = $this->db->get_where('msit_tb_student_info', array('std_display_id' => $display_id));
    return $query->row();
  }
  // get waiver credit
  public function  get_waiver($display_id){
    $query = $this->db->select_sum('sub_credit')->get_where('msit_tb_waiver',
              array('std_display_id' => $display_id));
    return $query->result();
  }
  // get earn credit
  public function  get_earn_credit($action,$display_id,$null){
    $query = $this->db->select_sum('sub_credit')->get_where('msit_tb_result',
              array('action' => $action,'std_display_id' => $display_id, 'gpa_point!=' => $null));
    return $query->result();
  }
  // get GPA point
  public function get_gpa_point($action,$display_id,$null){
    $query = $this->db->select('sum(`sub_credit`*`gpa_point`)AS gpa_point')->get_where('msit_tb_result',
                array('action' => $action,'std_display_id' => $display_id, 'gpa_point!=' => $null));
    return $query->result();
  }
  // get basic info
  public function get_basic_info($display_id){
    $query = $this->db->get_where('msit_tb_student_info', array('std_display_id'=>$display_id));
    return $query->row();
  }
  // get department full name
  public function get_dept_full_name($std_dept){
    $query = $this->db->get_where('msit_tb_dept_info', array('dept_sort_name'=>$std_dept));
    return $query->row();
  }
  // get last semester code by std id
  public function get_semester_code($display_id){
    $query = $this->db->limit(1)->order_by('semester_code',' DESC')->get_where('msit_tb_result', array('std_display_id'=>$display_id));
    return $query->row();
  }
  // get last semester credit by std id
  public function get_last_semester_credit($semester_code, $display_id){
    $query = $this->db->select_sum('sub_credit')->get_where('msit_tb_result', array('semester_code' => $semester_code ,'std_display_id'=>$display_id));
    return $query->row();
  }

  /* -------------- Teachers Interface ---------------*/
  public function get_teachers_basic_info($display_id){
    $query = $this->db->get_where('msit_tb_teacher_info', array('display_id'=>$display_id));
    return $query->row();
  }

  /*------------------ Authority dashboard -----------------------------*/
  public function get_authority_info($display_id){
    $query = $this->db->get_where('msit_tb_user', array('user_id'=>$display_id));
    return $query->row();
  }

  /*----------------------admin dashboard  ---------------------*/
  // count authority
  public function total_authority($accessType){
    $this->db->select('COUNT(id) AS authority');
    $query = $this->db->get_where('msit_tb_user', array('access_type' => $accessType));
    return $query->result();
  }
  // count teacher
  public function total_teacher($accessType){
    $this->db->select('COUNT(id) AS teachers');
    $query = $this->db->get_where('msit_tb_user', array('access_type' => $accessType));
    return $query->result();
  }

  // count student without graduation
  public function total_student($accessType,$complete){
    $this->db->select('COUNT(id) AS student');
    $query = $this->db->get_where('msit_tb_student_info', array('access_type' => $accessType, 'std_complete_graduation' => $complete));
    return $query->result();
  }

  // count total graduation
  public function total_graduation($accessType,$complete){
    $this->db->select('COUNT(id) AS graduation_std');
    $query = $this->db->get_where('msit_tb_student_info', array('access_type' => $accessType, 'std_complete_graduation' => $complete));
    return $query->result();
  }
}
