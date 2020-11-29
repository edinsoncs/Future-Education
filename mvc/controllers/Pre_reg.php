<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pre_reg extends CI_Controller {
  //constract_function
  public function __construct(){
		parent::__construct();
		if($this->session->userdata('access') == 0 || $this->session->userdata('access') == 2 || $this->session->userdata('access') == 3 || $this->session->userdata('access') == 1)
		redirect(base_url('login/index'));
    $this->load->model('pre_reg_m');
	}
  // defult load function
  public function index(){
    redirect ('dashboard/index');
  }
  // profile methode function
  public function pre_registration(){
    $std_info = $this->pre_reg_m->get_std_info($this->session->userdata('user_id'));

    $get_last_date = 0;
    if(count($get_last_date)){
      $get_last_date = $this->pre_reg_m->get_last_date_for_reg($std_info->std_dept, $std_info->std_batch, $std_info->std_section);
    }
    $get_assign_sub = 0;
    if (count($get_last_date)) {
        $get_assign_sub = $this->pre_reg_m->get_assign_sub_for_semester($std_info->std_dept, $std_info->std_batch, $std_info->std_section,$get_last_date->assign_reg_start_date);
    }

    $get_chack_publish = 0;
    if (count($get_chack_publish)){
      $get_chack_publish = $this->pre_reg_m->get_chack();
    }

    $data= [];
    $data['title'] = "Registration For Student";
    $data['pre_reg']='std/pre_reg/view';
    $data['semester_code'] = $this->pre_reg_m->get_semester_code();
    $data['get_last_date_for_pre_reg'] = $get_last_date;
    $data['get_data'] = $get_assign_sub;
    $data['get_chack'] = $get_chack_publish;
    $this->load->view('dashboard_layout',$data);
  }
  // chack PRE-REGISTRATION
  public function chack_pre_reg(){
    $semester_code = $this->pre_reg_m->get_semester_code();
    $std_info = $this->pre_reg_m->get_std_info($this->session->userdata('user_id'));
    $allSubjectID = $this->input->post('ids');
    $subjects =  explode('$',$allSubjectID);
    if(count($subjects)) {
          foreach ($subjects as $subjectKey => $subject) {
            if($subject != "") {
              $get_subject= $this->pre_reg_m->get_subject($subject);
              $errorSubject = array();
              if(count($get_subject)) {
                $getMatchForDB = $this->pre_reg_m->get_match(
                  $semester_code->semester_code,
                  $std_info->std_dept,
                  $std_info->std_batch,
                  $std_info->std_section,
                  $get_subject->assign_sub_code,
                  $this->session->userdata('user_id')
                );
                if($getMatchForDB !=''){
                  $errorSubject[] = $get_subject->assign_sub_name.' This Subject Is Already Taken !';
                  }
                }
                if(count($errorSubject)) {
                foreach ($errorSubject as $key => $error) {
                echo $error;
              }
            }
          }
        }
      }
    }
  // submit PRE-REGISTRATION
  public function submit_reg(){
    $semester_code = $this->pre_reg_m->get_semester_code();
    $std_info = $this->pre_reg_m->get_std_info($this->session->userdata('user_id'));
    $allSubjectID = $this->input->post('all_ids');
    $subjects =  explode('$',$allSubjectID);
    if(count($subjects)) {
      foreach ($subjects as $subjectKey => $subject) {
        if($subject != "") {
          $get_subject= $this->pre_reg_m->get_subject($subject);
          $errorSubject = array();
          if(count($get_subject)) {
            $getMatchForDB = $this->pre_reg_m->get_match(
              $semester_code->semester_code,
              $std_info->std_dept,
              $std_info->std_batch,
              $std_info->std_section,
              $get_subject->assign_sub_code,
              $this->session->userdata('user_id')
            );
            if(!count($getMatchForDB)) {

              $setArray = array();

              $setArray['semester_code'] = $semester_code->semester_code;
              $setArray['assign_season'] = $semester_code->season_code;
              $setArray['assign_year']   = $semester_code->year_code;

              $setArray['std_display_id '] = $std_info->std_display_id;
              $setArray['std_id ']         = $std_info->std_id;
              $setArray['std_name ']       = $std_info->std_name;
              $setArray['std_batch ']      = $std_info->std_batch;
              $setArray['std_section ']    = $std_info->std_section;
              $setArray['std_dept ']       = $std_info->std_dept;

              $setArray['sub_code ']       = $get_subject->assign_sub_code;
              $setArray['sub_name ']       = $get_subject->assign_sub_name;
              $setArray['sub_credit ']     = $get_subject->assign_sub_cread;

              $setArray['action ']         = "0";


              $this->pre_reg_m->insert_pre_registration($setArray);
              // redirect(base_url('pre_reg/pre_registration'));
            }
            else {
              $errorSubject[] = ' Registration Completed Successfully !';
            }
          }
          if(count($errorSubject)) {
            foreach ($errorSubject as $key => $error) {
              echo $error;
            }
          }
          $this->session->set_flashdata('success', 'Registration Completed Successfully !');
        }
      }
    }
  }

}
