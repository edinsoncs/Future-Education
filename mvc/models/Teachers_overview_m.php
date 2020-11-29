<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Teachers_overview_m extends CI_Model{

  // get assign subject for teachers
  public function get_assign_subject_for_teachers($display_ID){
      $query = $this->db->order_by('semester_code',' DESC')->get_where('msit_tb_assign_teacher', array('display_code' => $display_ID));
      return $query->result();
    }
    //  assign teacher details info data
    public function assign_teacher_details_info($id) {
      $query = $this->db->get_where('msit_tb_assign_teacher', array('id' => $id));
      return $query->row();
    }
    // get student mark list
    public function get_student_list($semester_code,$sub_code,$std_batch){
      $query = $this->db->get_where('msit_tb_result',
        array(
          'semester_code'=>$semester_code,
          'sub_code'=>$sub_code,
          'std_batch'=>$std_batch
        )
      );
      return $query->result();
    }
    // get submit button chack
    public function get_button_chack(){
      $query = $this->db->limit(1)->order_by('semester_code',' DESC')->get('msit_tb_result');
      return $query->row();
    }
    // get save marks
    public function get_marks($attr, $id){
      $this->db->where('id', $id);
      $this->db->update('msit_tb_result', $attr);
      return TRUE;
    }

}
