<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Assignsemester_m extends CI_Model{

  // get_all_assign_semester
  public function get_all_assign_semester(){
    $this->db->group_by('assign_semester_code','desc');
    $this->db->group_by('assign_batch');
    $query = $this->db->get('msit_tb_assign_semester');
    return $query->result();
  }

  // get semester code
    public function get_semester_code(){
      $query = $this->db->limit(1)->order_by('semester_code','DESC')->get('msit_tb_semester_code');
      return $query->row();
    }

// chacking semester code
  public function chacking_semester_code($semester_code){
     $query = $this->db->get_where('msit_tb_semester_code', array('semester_code' => $semester_code));
      return $query->row();
  }
// insert semester code
  public function create_semester_code($array){
    $insert = $this->db->insert('msit_tb_semester_code',$array);
    if($insert){
      return TRUE;
    }else {
      return FALSE;
    }
  }

// get department , batch , section from std_info table
  public function get_dept(){
    $query = $this->db->get('msit_tb_dept_info');
    return $query->result();
  }
  public function get_batch(){
    $query = $this->db->order_by('std_batch','DESC')->group_by('std_batch')->get('msit_tb_student_info');
    return $query->result();
  }
  public function get_section(){
    $query = $this->db->group_by('std_section')->get('msit_tb_student_info');
    return $query->result();
  }
// get single subject list
  function get_single_subject_list($subject){
     $query = $this->db->get_where('msit_tb_subject', array('id' => $subject));
      return $query->row();
  }

// get match data
  function get_match($semester_code, $std_dept, $std_batch, $std_section, $sub_code){
     $query = $this->db->get_where('msit_tb_assign_semester', array(
       'assign_semester_code' => $semester_code ,
       'assign_dept'          =>  $std_dept,
       'assign_batch'         => $std_batch,
       'assign_section'       => $std_section,
       'assign_sub_code'      => $sub_code
     ));
      return $query->row();
  }

//  insert assign semester
  public function insert_assign_semester($setArray){
    // dd($setArray);
    $insert = $this->db->insert('msit_tb_assign_semester',$setArray);
    if($insert){
      return TRUE;
    } else {
      return FALSE;
    }
  }


    public function get_data_accroding_to_semester($id){
      $query = $this->db->get_where('msit_tb_assign_semester', array('id' => $id));
     return $query->row();
    }

  // delete semester assign all subject
    public function delete_group_wais_data($semesterCode,$dept,$batch,$section){
        $this->db->delete('msit_tb_assign_semester', array('assign_semester_code' => $semesterCode,'assign_dept' => $dept,'assign_batch' => $batch,'assign_section' => $section));
        if($this->db->affected_rows()==1){
          return TRUE;
        } else {
          return FALSE;
        }
      }
  // delete single  data
    public function delete_data($id = null){
      $this->db->delete('msit_tb_assign_semester', array('id' => $id));
      if($this->db->affected_rows()==1){
        return TRUE;
      } else {
        return FALSE;
      }
    }
    //  get sub list accroding to semester
    public function get_sub_accroding_to_semester($semesterCode,$dept,$batch,$section){
     $query = $this->db->get_where('msit_tb_assign_semester', array('assign_semester_code' => $semesterCode,'assign_dept' => $dept,'assign_batch' => $batch,'assign_section' => $section));
      return $query->result();
    }

    // registration date update
    public function update_DATE($attr,$semesterCode,$dept,$batch,$section){
      $this->db->affected_rows();
      $this->db->where(array('assign_semester_code' => $semesterCode, 'assign_dept' => $dept,'assign_batch' => $batch,'assign_section' => $section));
      $this->db->update('msit_tb_assign_semester', $attr);
       return TRUE;
    }


}
