<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Subject_m extends CI_Model{

  // get department data
    public function get_department(){
      $query = $this->db->get('msit_tb_dept_info');
      return $query->result();
    }

    // get all subject
      public function get_data(){
        $query = $this->db->get('msit_tb_subject');
        return $query->result();
      }

    // insert new subject
    public function add_new_sub($array){
          $insert = $this->db->insert('msit_tb_subject',$array);
          if($insert){
            return TRUE;
          }else{
              return FALSE;
          }
      }

    // delete department
    public function delete_data($id = null){
      $this->db->delete('msit_tb_subject', array('id' => $id));
      if($this->db->affected_rows()==1){
        return TRUE;
      } else {
        return FALSE;
      }
    }
    // retrive  data for update
    public function get_single_subject($id){
      $query = $this->db->get_where('msit_tb_subject', array('id' => $id));
      // return $query->row();
      if ($query->num_rows()==1) {
        return $query->row();
      }
      else {
        return FALSE;
      }
    }

    // update data
      public function update_subject($array, $id){
      $this->db->affected_rows();
      $this->db->where('id', $id);
      $this->db->update('msit_tb_subject', $array);
      return TRUE;
    }



}
