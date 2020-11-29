<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Marksheet_m extends CI_Model{
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





}
