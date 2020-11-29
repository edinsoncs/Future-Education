<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Authority_m extends CI_Model{

  // get authority information  table for admin
    public function get_authority_info(){

      $query = $this->db->having('access_type',1);
      $query = $this->db->or_having('access_type',5);
      $query = $this->db->or_having('access_type',2)->order_by('id', 'ASC')->get('msit_tb_user');
      return $query->result();
    }

    public function get_single_authority_info($id){
        $query = $this->db->get_where('msit_tb_user', array('id' => $id));
        // return $query->row();
        if ($query->num_rows()==1) {
          return $query->row();
        }
        else {
          return FALSE;
        }

    }

    // chack email address
    public function chackEmail($chackEamil) {
      $query = $this->db->get_where('msit_tb_user', array('email_address' => $chackEamil));
      return $query->row();
    }
    // chack contact no
    public function chackContact($chackContact) {
      $query = $this->db->get_where('msit_tb_user', array('contact_no' => $chackContact));
      return $query->row();
    }
    // chack username
    public function chackUsername($chackContact) {
      $query = $this->db->get_where('msit_tb_user', array('user_name' => $chackContact));
      return $query->row();
    }


  // insert Authority new user login data
    public function authority_user_data($attr){
      $insert = $this->db->insert('msit_tb_user',$attr);
      if($insert){
        return TRUE;
      }
      else{
          return FALSE;
      }
    }
    // delete authorized user a row
    public function delete_authorized_user($id = null){
      $this->db->delete('msit_tb_user', array('id' => $id));
      if($this->db->affected_rows()==1){
        return TRUE ;
      }
      else {
        return FALSE;
      }
    }

    // retrive authorizes user data
    public function user_retrive_info($id)
    {
      $query = $this->db->get_where('msit_tb_user', array('id' => $id));
      // return $query->row();
      if ($query->num_rows()==1) {
        return $query->result();
      }
      else {
        return FALSE;
      }
    }

    // befor update for usermane chacking
     public function user_exits($username, $id){
        $query = $this->db->get_where('msit_tb_user', array('user_name' => $username, 'id !=' => $id));
        return $query->row();
     }
     // befor update for email chaking
     public function get_email_address($email_address, $id){
        $query = $this->db->get_where('msit_tb_user', array('email_address' => $email_address, 'id !=' => $id));
        return $query->row();
     }
     // befor update for contact chaking
     public function get_contact_no($contactNO, $id){
        $query = $this->db->get_where('msit_tb_user', array('contact_no' => $contactNO, 'id !=' => $id));
        return $query->row();
     }


    // update autority info
    public function authority_update_info($array,$id){
      $this->db->where('id', $id);
      $this->db->update('msit_tb_user', $array);
      return TRUE;

    }

}
