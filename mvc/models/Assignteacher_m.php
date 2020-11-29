<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Assignteacher_m extends CI_Model{

    //get assign information
    public function get_assign_info(){
      $query = $this->db->order_by('semester_code','DESC')->get('msit_tb_assign_teacher');
      return $query->result();
    }
    //get semester code
    public function get_semester_code(){
      $query = $this->db->limit(1)->order_by('semester_code','DESC')->get('msit_tb_semester_code');
      return $query->result();
    }
    //get teacher list
    public function get_teacher_list(){
      $query = $this->db->get('msit_tb_teacher_info');
      return $query->result();
    }
    //get Batch
    public function get_batch_code($attr){
      $query = $this->db->group_by('assign_batch')->order_by('assign_batch','DESC')->get_where('msit_tb_assign_semester', array('assign_semester_code' => $attr));
      return $query->result();
    }
    //get section
    public function get_section($attr,$semeCode){
      $query = $this->db->group_by('assign_section')->get_where('msit_tb_assign_semester', array('assign_batch' => $attr, 'assign_semester_code' => $semeCode));
      return $query->result();
    }
    //get sub_code && sub_name
    public function get_sub_code_sub_name($semeCode,$stdBatch,$attr){
      $query = $this->db->get_where('msit_tb_assign_semester', array('assign_semester_code' => $semeCode,'assign_batch' => $stdBatch, 'assign_section' =>$attr));
      return $query->result();
    }
    // get subject code
    public function get_subject_code($sub_name){
       $query = $this->db->get_where('msit_tb_assign_semester', array('assign_sub_name' => $sub_name));
        return $query->row();
    }
    // get teacher name
    public function get_teacher_name($teachers_display_id){
       $query = $this->db->get_where('msit_tb_teacher_info', array('display_id' => $teachers_display_id));
        return $query->row();
    }
    // get chack from DB
    public function get_chack($semester_code,$std_batch,$subjectcode){
       $query = $this->db->get_where('msit_tb_assign_teacher', array('semester_code' => $semester_code , 'std_batch' => $std_batch ,'sub_code' => $subjectcode));
        return $query->row();
    }
    // insert assign teachers
    public function insert_assign_teacher($attr){
      $insert = $this->db->insert('msit_tb_assign_teacher',$attr);
      if($insert){
        return TRUE;
      }else {
        return FALSE;
      }
    }
    // delete delete_data
    public function delete_data($id = null){
      $this->db->delete('msit_tb_assign_teacher', array('id' => $id));
      if($this->db->affected_rows()==1){
        return TRUE;
      } else {
        return FALSE;
      }
    }


}
