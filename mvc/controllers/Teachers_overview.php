<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teachers_overview extends CI_Controller {
  //constract_function
  public function __construct(){
		parent::__construct();
		if($this->session->userdata('access') == 0 || $this->session->userdata('access') == 1 || $this->session->userdata('access') == 2 || $this->session->userdata('access') == 4)
		redirect(base_url('login/index'));
    $this->load->model('gread_point_m');
    $this->load->model('teachers_overview_m');
	}
  // defult load function
  public function index(){
    redirect ('dashboard/index');
  }
  // profile methode function
  public function overview(){
    $data= [];
    $data['title'] = "Overview";
    $data['overview']='teacher/pages/view';
    $data['get_assign_sub_list'] = $this->teachers_overview_m->get_assign_subject_for_teachers($this->session->userdata('user_id'));
    $this->load->view('dashboard_layout',$data);
  }
  // view details accroding to subject
  public function viewdetails($id = null){
    if($this->teachers_overview_m->assign_teacher_details_info($id)) {
      $get_student_mark_list=$this->teachers_overview_m->assign_teacher_details_info($id);
      $data= [];
      $data['title'] = "View Details";
      $data['get_list'] = $this->teachers_overview_m->get_student_list($get_student_mark_list->semester_code,$get_student_mark_list->sub_code,$get_student_mark_list->std_batch);
      $data['details'] = $this->teachers_overview_m->assign_teacher_details_info($id);
      $data['chack_button'] = $this->teachers_overview_m->get_button_chack();
      $data['get_mark_details']='teacher/pages/details';
      $this->load->view('dashboard_layout',$data);
    }else {
      redirect(base_url('semesterArchive/semester_archive'));
    }
  }
  // get calculate GPA ot Grade
  function gradeCallMethod() {
    $grade = ''; $point = 0;
    $total_number = $this->input->post('total');
    $gradePoints = $this->gread_point_m->get_gread_point();
    if(count($gradePoints)) {
          foreach ($gradePoints as $gradePointkey => $gradePoint) {
              if($total_number >= $gradePoint->form_mark && $total_number <= $gradePoint->to_mark) {
                  $point =  $gradePoint->gread_point;
                  $grade = $gradePoint->gread;
                  break;
              }
          }
    }
    $json = array("point" => $point, "grade" => $grade);
     header("Content-Type: application/json", true);
     echo json_encode($json);
     exit;
  }

  //  update result archive accrodign to semester code + bache code + sub code
  public function updateResult(){
    $semester_code = $this->input->post('semester_code');
    $sub_code = $this->input->post('sub_code');
    $get_id = $this->input->post('get_id');
    $get_std_id = $this->input->post('get_std_id');
    $std_name = $this->input->post('std_name');
    // marks....
    $attendance = $this->input->post('attendance');
    $classTest = $this->input->post('classTest');
    $mid_exam = $this->input->post('mid_exam');
    $final_exam = $this->input->post('final_exam');
    $total_number = $this->input->post('total_number');
    $gpa_point = $this->input->post('gpa_point');
    $grade_point = $this->input->post('grade_point');

    $attr  = array(
      'semester_code' => $semester_code,
      'sub_code' => $sub_code,
      'std_id' => $get_std_id,
      'attendance' => $attendance,
      'class_test' => $classTest,
      'mid_exam' => $mid_exam,
      'final_exam' => $final_exam,
      'total_number' => $total_number,
      'gpa_point' => $gpa_point,
      'grade_point' => $grade_point,
      'action' => '0'
    );
    $this->teachers_overview_m->get_marks($attr,$this->input->post('get_id'));
    // $this->session->set_flashdata('success', 'Marks has been saved Successfully !');
    redirect(base_url('teachers_overview/overview'));

  }


}
