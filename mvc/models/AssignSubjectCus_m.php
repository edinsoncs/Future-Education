<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class AssignSubjectCus_m extends CI_Model{

      // get assign subject all data
      public function get_assign_sub_all(){
        $this->db->group_by('semester_code', 'DESC');
        $this->db->group_by('std_id');
        $this->db->having('semester_code!=', 123);
        $query = $this->db->get('msit_tb_result');
        return $query->result();
      }
      // get select ID wase data
      public function get_data_accroding_to_semester($id){
        $query = $this->db->get_where('msit_tb_result', array('id' => $id));
        return $query->row();

      }
    //  delete semester assign all subject
    public function delete_group_wais_data($semesterCode,$stdID){
        $this->db->delete('msit_tb_result', array('semester_code' => $semesterCode,'std_id' => $stdID));
        if($this->db->affected_rows()==1){
          return TRUE;
        } else {
          return FALSE;
        }
      }

    //  get sub list accroding to semester
    public function get_sub_accroding_to_semester($semesterCode,$stdID){
     $query = $this->db->get_where('msit_tb_result', array('semester_code' => $semesterCode,'std_id' => $stdID));
      return $query->result();
    }


    // delete ASSIGN subject
    public function delete_data($id = null){
      $this->db->delete('msit_tb_result', array('id' => $id));
      if($this->db->affected_rows()==1){
        return TRUE;
      } else {
        return FALSE;
      }
    }


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
    // get semester code
      public function get_semester_code($action){
        $query = $this->db->limit(1)->order_by('semester_code',' DESC')->get_where('msit_tb_semester_code',array('action' => $action));
        return $query->row();
      }
    // get subject list
    function get_single_subject_list($subject){
       $query = $this->db->get_where('msit_tb_subject', array('id' => $subject));
        return $query->row();
    }

    // get chack duplicat data
    function get_student_subject_with_id($studentID, $subjectcode, $semester_code){
       $query = $this->db->get_where('msit_tb_result', array('std_id' => $studentID , 'sub_code' =>  $subjectcode, 'semester_code' => $semester_code));
        return $query->row();
    }

    // insert cust. subject
    public function insert_cust_subject($attr){
      $insert = $this->db->insert('msit_tb_result',$attr);
      if($insert){
        return TRUE;
      } else {
        return FALSE;
      }
    }

}
