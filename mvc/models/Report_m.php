<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Report_m extends CI_Model{

// get department list
  public function get_dept_list(){
    $query = $this->db->get('msit_tb_dept_info');
    return $query->result();
  }
//get teacher list
  public function get_teacher_list(){
    $query = $this->db->get('msit_tb_teacher_info');
    return $query->result();
  }
//get BATCH list
  public function get_batch(){
    $query = $this->db->order_by('std_id','DESC')->group_by('std_batch')->get('msit_tb_student_info');
    return $query->result();
  }
//get SECTION list
  public function get_section(){
    $query = $this->db->group_by('std_section','DESC')->get('msit_tb_student_info');
    return $query->result();
  }
//get std list
  public function std_list(){
    $query = $this->db->order_by('std_id','DESC')->get('msit_tb_student_info');
    return $query->result();
  }
// get shorted std list 
  // public function get_shorted_std_list($dept_info,$batch_info,$section){
  //   $query = $this->db->get_where('msit_tb_student_info', array('std_dept' =>$dept_info, 'std_batch' => $batch_info, 'std_section' => $section));
  //   return $query->result();
  // }
// get semester code
  public function seme_code($action){
    $query = $this->db->order_by('semester_code','DECS')->group_by('semester_code')->get_where('msit_tb_result', array('action' => $action));
    return $query->result();
  }
// get teacher list accro to dept
  public function get_teacher_list_accro_dept($dept_info){
    $query = $this->db->get_where('msit_tb_teacher_info', array('teacher_department'=>$dept_info));
    return $query->result();
  }
// get department full name
  public function get_dept_full_name($dept_name){
    $query = $this->db->get_where('msit_tb_dept_info', array('dept_sort_name' =>$dept_name));
    return $query->row();
  }
// get single teacher info
  public function get_single_teachers_info($teacher_code){
    $query = $this->db->get_where('msit_tb_teacher_info', array('display_id' => $teacher_code));
    return $query->row();
  }
// get batch information
  public function get_batch_info($batch_info){
    $query = $this->db->limit(1)->get_where('msit_tb_student_info',array('std_batch' =>$batch_info));
    return $query->row();
  }
// student list accroding to batch
  public function std_list_accro_batch($accrobatchInfo){
    $query = $this->db->get_where('msit_tb_student_info',array('std_batch' =>$accrobatchInfo));
    return $query->result();
  }
// get section information
  public function get_section_info($section_info){
    $query = $this->db->limit(1)->get_where('msit_tb_student_info',array('std_section' =>$section_info));
    return $query->row();
  }
// student list accroding to section
  public function std_list_accro_section($accroSectionInfo){
    $query = $this->db->get_where('msit_tb_student_info',array('std_section' =>$accroSectionInfo));
    return $query->result();
  }
// student list accroding to dept
  public function std_list_accro_dept($dept_name){
    $query = $this->db->get_where('msit_tb_student_info',array('std_dept' =>$dept_name));
    return $query->result();
  }
// student list accroding to dept or batch
  public function std_list_accro_deptORbatch($dept_name,$batch_info){
    $query = $this->db->get_where('msit_tb_student_info',array('std_dept' =>$dept_name,'std_batch' =>$batch_info));
    return $query->result();
  }
// student list accroding to dept or section
  public function std_list_accro_deptORsection($dept_name,$section_info){
    $query = $this->db->get_where('msit_tb_student_info',array('std_dept' =>$dept_name,'	std_section' =>$section_info));
    return $query->result();
  }
// student list accroding to batch or section
  public function std_list_accro_batchORsection($batch_info,$section_info){
    $query = $this->db->get_where('msit_tb_student_info',array('std_batch' =>$batch_info,'	std_section' =>$section_info));
    return $query->result();
  }
// student list accroding to batch or section
  public function std_list_accro_deptORbatchORsection($dept_name,$batch_info,$section_info){
    $query = $this->db->get_where('msit_tb_student_info',array('std_dept' =>$dept_name, 'std_batch' =>$batch_info,'	std_section' =>$section_info));
    return $query->result();
  }

// student single info
  public function std_single_info($std_ID){
    $query = $this->db->get_where('msit_tb_student_info', array('std_id' => $std_ID));
    return $query->row();
  }
// get student ids for semester wise result
  public function get_std_ids($seme_code,$dept_info){
    $this->db->order_by('std_batch','DESC')->group_by('std_id');
    $query = $this->db->get_where('msit_tb_result', array('semester_code' => $seme_code, 'std_dept' => $dept_info));
    return $query->result();
  }
// get semester full name
  public function get_seme_full_name($seme_code){
    $query = $this->db->get_where('msit_tb_semester_code', array('semester_code' => $seme_code));
    return $query->row();
  }
// get student result
  public function get_std_result($seme_code,$dept_info){
    $query = $this->db->get_where('msit_tb_result', array('semester_code' => $seme_code, 'std_dept' => $dept_info));
    return $query->result();
  }
// get point table
  public function point_table($seme_code,$dept_info){
    $this->db->select('std_id,sub_credit,action,sum(sub_credit)as credit');
    $this->db->select('sum(sub_credit * gpa_point)as point');
    $this->db->group_by('std_id');
    $query = $this->db->get_where('msit_tb_result', array('semester_code'=>$seme_code, 'std_dept' =>$dept_info));
    return $query->result();
  }
// get earn point
  public function get_earn_point($seme_code,$dept_info,$null){
    $this->db->select('std_id,sub_credit,action,gpa_point,sum(sub_credit)as credit');
    $this->db->group_by('std_id');
    $query = $this->db->get_where('msit_tb_result', array('semester_code'=>$seme_code, 'std_dept' =>$dept_info, 'gpa_point!=' => $null));
    return $query->result();
  }
// get student ids accro to batch
  public function get_std_ids_accro_batch($seme_code,$dept_info,$batch_info){
    $this->db->order_by('std_batch','DESC')->group_by('std_id');
    $query = $this->db->get_where('msit_tb_result', array('semester_code' => $seme_code, 'std_dept' => $dept_info, 'std_batch' => $batch_info));
    return $query->result();

  }
// get student ids accro to section
  public function get_std_ids_accro_section($seme_code,$dept_info,$section_info){
    $this->db->order_by('std_batch','DESC')->group_by('std_id');
    $query = $this->db->get_where('msit_tb_result', array('semester_code' => $seme_code, 'std_dept' => $dept_info, 'std_section' => $section_info));
    return $query->result();
  }
//  get student ids accro to batch && section
  public function get_std_ids_accro_BatchSection($seme_code,$dept_info,$batch_info,$section_info){
    $this->db->order_by('std_batch','DESC')->group_by('std_id');
    $query = $this->db->get_where('msit_tb_result', array('semester_code' => $seme_code, 'std_dept' => $dept_info, 'std_batch' => $batch_info, 'std_section' => $section_info));
    return $query->result();
  }
}
