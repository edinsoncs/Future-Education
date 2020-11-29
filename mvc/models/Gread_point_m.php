<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Gread_point_m extends CI_Model{

// insert grae point
  	public function insert_gread_point($attr){

    $insert = $this->db->insert('msit_tb_grade_point',$attr);
    if($insert){
      return TRUE;
    }
      else {
        return FALSE;
      }
    }


// get gread point table
  public function get_gread_point(){
    $query = $this->db->order_by('gread_point', 'DESC')->get('msit_tb_grade_point');
    return $query->result();
  }


  // delete gread point a row
  public function delete_gread_point($id = null){
    $this->db->delete('msit_tb_grade_point', array('id' => $id));
    if($this->db->affected_rows()==1){
      return TRUE ;
    }
    else {
      return FALSE;
    }
  }

  // update gread point a row
  public function update_grade_point($array, $id){
   $this->db->where('id', $id);
   $this->db->update('msit_tb_grade_point', $array);
   return TRUE;
  }

  }
