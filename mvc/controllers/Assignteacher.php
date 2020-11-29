<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assignteacher extends CI_Controller {
  //constract_function
  public function __construct(){
		parent::__construct();
		if($this->session->userdata('access') == 0 || $this->session->userdata('access') == 3 || $this->session->userdata('access') == 4)
		redirect(base_url('login/index'));
    $this->load->model('assignteacher_m');
	}
  // defult load function
  public function index(){
    redirect ('dashboard/index');
  }
  // profile methode function
  public function assign_teacher(){
    $data= [];
    $data['title'] = "Assign Teacher";
    $data['assign_teacher']='assignteacher/view';
    $data['get_all_data'] = $this->assignteacher_m->get_assign_info();
    $data['get_code'] = $this->assignteacher_m->get_semester_code();
    $data['get_teacher'] = $this->assignteacher_m->get_teacher_list();
    $this->load->view('dashboard_layout',$data);
  }
  // get batch
  public function get_batch_code(){
    if($this->input->post('semester_code')){
      $semester_code = $this->assignteacher_m->get_batch_code($this->input->post('semester_code'));
      echo json_encode($semester_code);
    }

  }
  // get section name
  public function get_section(){
      if($this->input->post('std_batch')){
        $semeCode = $this->input->post('semester_code');
        $std_batch = $this->assignteacher_m->get_section($this->input->post('std_batch'),$semeCode);
        echo json_encode($std_batch);
      }
   }
  // get sub_code  && sub_name
  public function get_sub_code_sub_name(){
      if($this->input->post('std_section')){
        $semeCode = $this->input->post('semester_code');
        $stdBatch = $this->input->post('std_batch');
        $std_sub = $this->assignteacher_m->get_sub_code_sub_name($semeCode,$stdBatch,$this->input->post('std_section'));
        echo json_encode($std_sub);
      }
   }
  // assign teachers accroding to Subject
  public function insert_teacher_subject(){
    $semester_code =  $this->input->post('semester_code');
    $std_batch =  $this->input->post('std_batch');
    $std_section =  $this->input->post('std_sections');
    $sub_name =  $this->input->post('sub_name');
    $teachers_display_id =  $this->input->post('assign_teachers');
    $alternative_teacher =  $this->input->post('alternative_teacher');

    if($_POST){
      $this->form_validation->set_rules('std_batch','Batch','trim|required|callback_batch_code');
      $this->form_validation->set_rules('std_sections','Select Sections','trim|required');
      $this->form_validation->set_rules('assign_teachers','Select Teachers','trim|required|callback_assign_teachers_code');
      if($this->form_validation->run() == FALSE) {
        $data['validation_errors'] = $this->form_validation->verror_array();
        $data['title'] = "Assign Teacher";
        $data['assign_teacher']='assignteacher/view';
        $data['get_all_data'] = $this->assignteacher_m->get_assign_info();
        $data['get_code'] = $this->assignteacher_m->get_semester_code();
        $data['get_teacher'] = $this->assignteacher_m->get_teacher_list();
        $this->load->view('dashboard_layout',$data);
      } else {
        $getSubjectCode = $this->assignteacher_m->get_subject_code($sub_name);
        $getTeachersName = $this->assignteacher_m->get_teacher_name($teachers_display_id);
        $getChackFromDB = $this->assignteacher_m->get_chack($semester_code,$std_batch,$getSubjectCode->assign_sub_code);
        if(!count($getChackFromDB)) {
            $attr = array(
              'semester_code' => $semester_code,
              'std_batch' => $std_batch,
              'std_section' => $std_section,
              'sub_code' => $getSubjectCode->assign_sub_code,
              'sub_name' => $sub_name,
              'sub_credit' => $getSubjectCode->assign_sub_cread,
              'assign_teacher' => $getTeachersName->teacher_name,
              'display_code' => $teachers_display_id,
              'alternative_teacher' => $alternative_teacher,
            );
            // dump_exit($attr);
            $this->assignteacher_m->insert_assign_teacher($attr);
            $this->session->set_flashdata('success', 'Successfully Assigned');
            redirect(base_url('assignteacher/assign_teacher'));
        }else {
          $this->session->set_flashdata('errors','Already Exists !');
          redirect(base_url('assignteacher/assign_teacher'));
        }
      }
    }
  }
  // callback function
  function batch_code() {
    if($this->input->post('std_batch') == 0) {
      $this->form_validation->set_message('batch_code', 'Please Select Batch');
      return FALSE;
    }
    return TRUE;
  }
  // function section_code(){
  //   if($this->input->post('std_sections') == 0) {
  //     $this->form_validation->set_message('section_code', 'Please Select Section');
  //     return FALSE;
  //   }
  //   return TRUE;
  // }
  function assign_teachers_code() {
    if($this->input->post('assign_teachers') == 0) {
      $this->form_validation->set_message('assign_teachers_code', 'Please Select Teachers');
      return FALSE;
    }
    return TRUE;
  }
  // delete delete_data
  function delete_data($id = null){
    if($this->assignteacher_m->delete_data($id)){
      $this->session->set_flashdata('success', 'Successfully Deleted');
      redirect(base_url('assignteacher/assign_teacher'));
    } else {
       redirect(base_url('assignteacher/assign_teacher'));
    }
  }

  }
