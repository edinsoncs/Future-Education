<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Library_m extends CI_Model{


  // get book list
	public function get_data(){
		$query = $this->db->get('msit_tb_library');
		return $query->result();
	}

  // add new book
	public function add_new($attr){
		$insert = $this->db->insert('msit_tb_library',$attr);
		if($insert){
			return TRUE;
		}else{
			return FALSE;
		}	
	}

  // retrive  data
	public function get_single_data($id){
		$query = $this->db->get_where('msit_tb_library', array('id' => $id));
		if ($query->num_rows()==1) {
			return $query->row();
		}
		else {
			return FALSE;
		}
	}

  // update data
	public function update_data($attr, $id){
		$this->db->affected_rows();
		$this->db->where('id', $id);
		$this->db->update('msit_tb_library', $attr);
		return TRUE;
	}
 // update/change issue book name & writer name 
	public function updateIssueBookName($array, $id){
		$this->db->affected_rows();
		$this->db->where('book_id', $id);
		$this->db->update('msit_tb_issue_book_history', $array);
		return TRUE;
	}
  // get data for barcode 
	public function get_single_item($id){
		$query = $this->db->get_where('msit_tb_library', array('id' => $id));
		if ($query->num_rows()==1) {
			return $query->row();
		}
		else {
			return FALSE;
		}
	}


  // delete book
	public function delete_data($id = null){
		$this->db->delete('msit_tb_library', array('id' => $id));
		if($this->db->affected_rows()==1){
			return TRUE;
		} else {
			return FALSE;
		}
		
	}

	// add member 
	public function chkBeforeActive($display_id){
		$query = $this->db->get_where('msit_tb_student_info', array('std_display_id' => $display_id));
		return $query->row();
	}
/*================================================================================
									issue page script
=================================================================================*/


// get issue book list
	public function get_issue_book(){
		$query = $this->db->get('msit_tb_issue_book_history');
		return $query->result();
	}

// retrive stu id single info
  public function get_single_student($studentID, $library_access){
    $query = $this->db->get_where('msit_tb_student_info', array('std_id' => $studentID, 'library_access' => $library_access));
    if ($query->num_rows()==1) {
      return $query->row();
    }
    else {
      return FALSE;
    }
  }
  // retrive stu id single info
  public function get_single_book($getbookID){
    $query = $this->db->get_where('msit_tb_library', array('id' => $getbookID));
    if ($query->num_rows()==1) {
      return $query->row();
    }
    else {
      return FALSE;
    }
  }

  // get issue book count 
	public function get_count_issue_book($id){
		$query = $this->db->get_where('msit_tb_library', array('id' => $id));
		return $query->row();
	}
  
  // get bookID  
	public function get_bookID($id){
		$query = $this->db->get_where('msit_tb_issue_book_history', array('id' => $id));
		return $query->row();
	}

  // add new book
	public function issue_book($attr){
		$insert = $this->db->insert('msit_tb_issue_book_history',$attr);
		if($insert){
			return TRUE;
		}else{
			return FALSE;
		}	
	}
	// update isseud book script 
	public function update_issued_book($bookID,$array){
		$this->db->where('id', $bookID);
		$this->db->update('msit_tb_library', $array);
		return TRUE;
	}

	// return data script 
	public function return_data($attr,$id){
		$this->db->where('id', $id);
		$this->db->update('msit_tb_issue_book_history', $attr);
		return TRUE;
	}

	// get single issue book 
	public function get_single_issue_book($id){
		$query = $this->db->get_where('msit_tb_issue_book_history', array('id' => $id));
      return $query->row();
		
	}

	// update_due_date
	public function update_due_date($attr, $id){
		$this->db->affected_rows();
		$this->db->where('id', $id);
		$this->db->update('msit_tb_issue_book_history', $attr);
		return TRUE;
	}

	// paid fine amount 
	public function paid_data($attr, $id){
		$this->db->affected_rows();
		$this->db->where('id', $id);
		$this->db->update('msit_tb_issue_book_history', $attr);
		return TRUE;
	}

	/*=========================================================================================
									mamber pages script 
	=========================================================================================*/

	// get members/students list
	public function get_members(){
    $query = $this->db->get_where('msit_tb_student_info');
      return $query->result();
    }

    // update library activate info
	public function update_activate_info($array,$display_id){
	  $this->db->where('std_display_id', $display_id);
	  $this->db->update('msit_tb_student_info', $array);
	return TRUE;
	}
	// get student ID 
	public function get_stdID($std_display_id){
		$query = $this->db->get_where('msit_tb_student_info', array('std_display_id' => $std_display_id));
      	return $query->row();
	}

	// get issue book by std id
	public function get_issue_book_by_stdID($id){
		$query = $this->db->get_where('msit_tb_issue_book_history', array('std_id' => $id));
      	return $query->result();
	}

	// check clearance 
	public function check_clearance($return_type, $id){
		$query = $this->db->get_where('msit_tb_issue_book_history', array('return_type' => $return_type, 'std_id' => $id));
      	return $query->row();
		
	}
	//  check due clearance 
	public function check_due_clearance($return_type, $id){
		$query = $this->db->get_where('msit_tb_issue_book_history', array('return_type' => $return_type, 'std_id' => $id));
      	return $query->row();
		
	}

	// get sdtID by issue book id 
	public function getStdID($id){
		$query = $this->db->get_where('msit_tb_issue_book_history', array('id' => $id));
      	return $query->row();
		
	}
	// get_std_displayid for detalis page
	public function get_std_displayid($get_std_ID){
		$query = $this->db->get_where('msit_tb_student_info', array('std_id' => $get_std_ID));
      	return $query->row();
	}


}
