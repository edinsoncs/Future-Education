<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class SemesterArchive_m extends CI_Model{

  //get assign information
  public function get_assign_info(){
    $query = $this->db->order_by('semester_code',' DESC')->get('msit_tb_assign_teacher');
    return $query->result();
  }
  //  assign teacher details info data
  public function assign_teacher_details_info($id)
  {
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

  // get save marks
  public function get_marks($attr, $id){
    $this->db->where('id', $id);
    $this->db->update('msit_tb_result', $attr);
    return TRUE;
  }


}
