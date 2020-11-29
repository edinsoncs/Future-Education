<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Department_m extends CI_Model{


  // get department data
    public function get_data(){
      $query = $this->db->order_by('id', 'DESC')->get('msit_tb_dept_info');
      return $query->result();
    }

  // insert new department
    public function add_new_dept($array){
      $insert = $this->db->insert('msit_tb_dept_info',$array);
      if($insert){
        return TRUE;
      }else{
          return FALSE;
      }
    }
    // delete department
    public function delete_data($id = null){
      $this->db->delete('msit_tb_dept_info', array('id' => $id));
      if($this->db->affected_rows()==1){
        return TRUE;
      } else {
        return FALSE;
      }
    }
    // callback
      public function checkDuplicateCode($dept_code){
        $this->db->select('dept_code');
        $this->db->where('dept_code',$dept_code);
        $query = $this ->db->get('msit_tb_dept_info');
        if ($query->num_rows() > 0)
            return FALSE;
        else
            return TRUE;
        }
      public function checkDuplicateName($dept_name){
        $this->db->select('dept_name');
        $this->db->where('dept_name',$dept_name);
        $query = $this ->db->get('msit_tb_dept_info');
        if ($query->num_rows() > 0)
            return FALSE;
        else
            return TRUE;
        }
      public function checkDuplicateRoll($dept_sort_name){
        $this->db->select('dept_sort_name');
        $this->db->where('dept_sort_name',$dept_sort_name);
        $query = $this ->db->get('msit_tb_dept_info');
        if ($query->num_rows() > 0)
            return FALSE;
        else
            return TRUE;
        }

        // retrive  data
        public function get_single_department($id){
          $query = $this->db->get_where('msit_tb_dept_info', array('id' => $id));
          // return $query->row();
          if ($query->num_rows()==1) {
            return $query->row();
          }
          else {
            return FALSE;
          }
        }

        // update data
        public function update_dept($array,$id){
          $this->db->affected_rows();
          $this->db->where('id', $id);
          $this->db->update('msit_tb_dept_info', $array);
          return TRUE;
        }

}
