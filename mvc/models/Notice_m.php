<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Notice_m extends CI_Model{


  // get department data
  public function get_data(){
    $query = $this->db->order_by('id', 'DESC')->get('msit_tb_notice');
    return $query->result();
  }
  //get notification
  public function get_notification($attr){
    $query = $this->db->get_where('msit_tb_notification', $attr);
    return $query->result();
  }

  // insert notification no.....
  public function countNotificationNO($attr){

    $insert = $this->db->insert('msit_tb_notification',$attr);
    if($insert){
      return TRUE;
    }else{
      return FALSE;
    }
    
  }


  // create new notice
  public function create_notice($attr){
    $insert = $this->db->insert('msit_tb_notice',$attr);
    if($insert){
      return TRUE;
    }else{
      return FALSE;
    }
  }
    // delete data
  public function delete_data($id = null){
    $this->db->delete('msit_tb_notice', array('id' => $id));
    if($this->db->affected_rows()==1){
      return TRUE;
    } else {
      return FALSE;
    }
  }

    // retrive  data
  public function get_single_notice($id){

    $query = $this->db->get_where('msit_tb_notice', array('id' => $id));
      // return $query->row();
    if ($query->num_rows()==1) {
      return $query->row();
    }
    else {
      return FALSE;
    }
  }

    // update data
  public function update_notice($attr, $id){
    $this->db->affected_rows();
    $this->db->where('id', $id);
    $this->db->update('msit_tb_notice', $attr);
    return TRUE;
  }

}
