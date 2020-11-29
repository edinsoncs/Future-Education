<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
  //constract_function
  public function __construct(){
    parent::__construct();
    if($this->session->userdata('access') == 0 || $this->session->userdata('access') == 3 || $this->session->userdata('access') == 4)
      redirect(base_url('login/index'));
    $this->load->model('report_m');

    $this->load->library('html2pdf');
    $this->html2pdf->folder('./assets/pdfs/');
    $this->html2pdf->filename('Report.pdf');
    $this->html2pdf->paper('a4', 'portrait');
  }
  // defult load function
  public function index(){
    redirect ('dashboard/index');
  }
  // profile methode function
  public function report(){
    $data= [];
    $data['title'] = "Report";
    $data['report']='report/view';
    $data['get_dept'] = $this->report_m->get_dept_list();
    $data['get_teacher'] = $this->report_m->get_teacher_list();
    $data['get_batch'] = $this->report_m->get_batch();
    $data['get_section'] = $this->report_m->get_section();
    $data['std_list'] = $this->report_m->std_list();
    $data['seme_code'] = $this->report_m->seme_code($action = 1);
    $this->load->view('dashboard_layout',$data);
  }
  // get teacher name
  public function get_teacher_list_accro_dept(){
    if($this->input->post('dept_info')){
      $dept_info = $this->report_m->get_teacher_list_accro_dept($this->input->post('dept_info'));
      echo json_encode($dept_info);
    }
  }
  // get shorted std list 
  // function get_shorted_std_list(){
  //   if($this->input->post('section_info')){
  //       $dept_info = $this->input->post('dept_info');
  //       $batch_info = $this->input->post('batch_info2');

  //       $std_ID = $this->report_m->get_shorted_std_list($dept_info,$batch_info,$this->input->post('section_info'));

  //       echo json_encode($std_ID);
  //     }

  // }
  // report preview and priint
  function print_preview() {

    $dept_name = $this->input->post('dept_info');
    $teacher_code = $this->input->post('teacher_info');

    if(($dept_name != '') && ($teacher_code == 0)) {

      $deptName = $this->report_m->get_dept_full_name($dept_name);
      $teacherInfo = $this->report_m->get_teacher_list();
      $data['dept_fill_name'] = $deptName;
      $data['teacher_info'] = $teacherInfo;
      $html = $this->load->view('pages/report/teachersAll', $data, true);
      $this->html2pdf->html($html);
      $this->html2pdf->create();

    } elseif (($teacher_code != 0)) {

      $singleteacherInfo = $this->report_m->get_single_teachers_info($teacher_code);
      $deptName = $this->report_m->get_dept_full_name($singleteacherInfo->teacher_department);
      $data['singleTeacherInfo'] = $singleteacherInfo;
      $data['dept_fill_name'] = $deptName;
      $html = $this->load->view('pages/report/teacherOne', $data, true);
      $this->html2pdf->html($html);
      $this->html2pdf->create();
    }
    else {
      $data['teacher_info'] = $this->report_m->get_teacher_list();
      $html = $this->load->view('pages/report/teachersAll', $data, true);
      $this->html2pdf->html($html);
      $this->html2pdf->create();
    }
  }
  // std prient preview
  function print_preview_s() {

    $dept_name = $this->input->post('dept_info');
    $batch_info = $this->input->post('batch_info');
    $section_info = $this->input->post('section_info');
    $std_ID = $this->input->post('std_ID');

    if(($dept_name != '') && ($batch_info == '') && ($section_info == '') && ($std_ID == '')) {

      $deptName = $this->report_m->get_dept_full_name($dept_name);
      $data['s_studentAll']='report/studentsAll';
      $data['std_list'] = $this->report_m->std_list_accro_dept($dept_name);
      $data['dept_fill_name'] = $deptName;
      $html = $this->load->view('pages/report/studentsAll', $data, true);
      $this->html2pdf->html($html);
      $this->html2pdf->create();
    }elseif (($batch_info != '') && ($dept_name == '') && ($section_info == '') && ($std_ID == '')) {

      $batchInfo = $this->report_m->get_batch_info($batch_info);
      $data['s_studentAll']='report/studentsAll';
      $data['batchInfo'] = $batchInfo;
      $data['std_list'] = $this->report_m->std_list_accro_batch($batchInfo->std_batch);
      $html = $this->load->view('pages/report/studentsAll', $data, true);
      $this->html2pdf->html($html);
      $this->html2pdf->create();
    }elseif (($section_info != '') && ($dept_name == '') && ($batch_info == '' )&& ($std_ID == '')) {

      $sectionInfo = $this->report_m->get_section_info($section_info);
      $data['s_studentAll']='report/studentsAll';
      $data['sectionInfo'] = $sectionInfo;
      $data['std_list'] = $this->report_m->std_list_accro_section($sectionInfo->std_section);
      $html = $this->load->view('pages/report/studentsAll', $data, true);
      $this->html2pdf->html($html);
      $this->html2pdf->create();
    }elseif ( ($section_info == '') && ($dept_name != '') && ($batch_info != '') && ($std_ID == '')) {
      $deptName = $this->report_m->get_dept_full_name($dept_name);
      $batchInfo = $this->report_m->get_batch_info($batch_info);
      $data['s_studentAll']='report/studentsAll';
      $data['dept_fill_name'] = $deptName;
      $data['batchInfo'] = $batchInfo;
      $data['std_list'] = $this->report_m->std_list_accro_deptORbatch($dept_name,$batch_info);
      $html = $this->load->view('pages/report/studentsAll', $data, true);
      $this->html2pdf->html($html);
      $this->html2pdf->create();
    }elseif (($batch_info == '') && ($dept_name != '') && ($section_info != '') && ($std_ID == '')) {
      $deptName = $this->report_m->get_dept_full_name($dept_name);
      $sectionInfo = $this->report_m->get_section_info($section_info);
      $data['s_studentAll']='report/studentsAll';
      $data['dept_fill_name'] = $deptName;
      $data['sectionInfo'] = $sectionInfo;
      $data['std_list'] = $this->report_m->std_list_accro_deptORsection($dept_name,$section_info);
      $html = $this->load->view('pages/report/studentsAll', $data, true);
      $this->html2pdf->html($html);
      $this->html2pdf->create();
    }elseif (($dept_name == '') &&($batch_info != '') && ($section_info != '') && ($std_ID == '')) {
      $batchInfo = $this->report_m->get_batch_info($batch_info);
      $sectionInfo = $this->report_m->get_section_info($section_info);
      $data['s_studentAll']='report/studentsAll';
      $data['batchInfo'] = $batchInfo;
      $data['sectionInfo'] = $sectionInfo;
      $data['std_list'] = $this->report_m->std_list_accro_batchORsection($batch_info,$section_info);
      $html = $this->load->view('pages/report/studentsAll', $data, true);
      $this->html2pdf->html($html);
      $this->html2pdf->create();
    }elseif (($dept_name != '') && ($batch_info != '') && ($section_info != '' )&& ($std_ID == '')) {
      $deptName = $this->report_m->get_dept_full_name($dept_name);
      $batchInfo = $this->report_m->get_batch_info($batch_info);
      $sectionInfo = $this->report_m->get_section_info($section_info);
      $data['s_studentAll']='report/studentsAll';
      $data['batchInfo'] = $batchInfo;
      $data['sectionInfo'] = $sectionInfo;
      $data['dept_fill_name'] = $deptName;
      $data['std_list'] = $this->report_m->std_list_accro_deptORbatchORsection($dept_name,$batch_info,$section_info);
      $html = $this->load->view('pages/report/studentsAll', $data, true);
      $this->html2pdf->html($html);
      $this->html2pdf->create();
    }
    elseif (($std_ID != '') && ($dept_name == '') && ($batch_info == '') && ($section_info == '')) {

      $stdInfo = $this->report_m->std_single_info($std_ID);
      $deptName = $this->report_m->get_dept_full_name($stdInfo->std_dept);
      $data['dept_fill_name'] = $deptName;
      $data['std_info'] = $stdInfo ;
      $html = $this->load->view('pages/report/studentsOne', $data, true);
      $this->html2pdf->html($html);
      $this->html2pdf->create();
    }
    elseif (($std_ID != '') && ($dept_name != '') && ($batch_info != '') && ($section_info != '')) {
      $stdInfo = $this->report_m->std_single_info($std_ID);
      $deptName = $this->report_m->get_dept_full_name($stdInfo->std_dept);
      $data['dept_fill_name'] = $deptName;
      $data['std_info'] = $stdInfo ;
      $html = $this->load->view('pages/report/studentsOne', $data, true);
      $this->html2pdf->html($html);
      $this->html2pdf->create();
    }
    else {
      // $data['s_studentAll']='report/studentsAll';
      $data['std_list'] = $this->report_m->std_list();
      $html = $this->load->view('pages/report/studentsAll', $data, true);
      $this->html2pdf->html($html);
      $this->html2pdf->create();
    }
  }
  // semester wais result sheet
  function semester_result(){
    $seme_code = $this->input->post('seme_code');
    $dept_info = $this->input->post('dept_info');
    $batch_info = $this->input->post('result_batch_info');
    $section_info = $this->input->post('get_result_section');

    if($_POST) {
      $this->form_validation->set_rules('seme_code','Semester Code', 'trim|required|callback_seme_blank');
      $this->form_validation->set_rules('dept_info','Department', 'trim|required|callback_dept_blank');
      if($this->form_validation->run() == FALSE){
        $data['title'] = "Report";
        $data['report']='report/view';
        $data['get_dept'] = $this->report_m->get_dept_list();
        $data['get_teacher'] = $this->report_m->get_teacher_list();
        $data['get_batch'] = $this->report_m->get_batch();
        $data['get_section'] = $this->report_m->get_section();
        $data['std_list'] = $this->report_m->std_list();
        $data['seme_code'] = $this->report_m->seme_code($action = 1);
        $data['validation_errors'] = $this->form_validation->verror_array();
        $this->load->view('dashboard_layout',$data);
      } else {

        if (($batch_info !='') && ($section_info == '')) {
          $data['dept_fill_name'] = $this->report_m->get_dept_full_name($dept_info);
          $data['batchInfo'] = $this->report_m->get_batch_info($batch_info);
          $data['get_seme_full_name'] = $this->report_m->get_seme_full_name($seme_code);
          $data['get_std_id'] = $this->report_m->get_std_ids_accro_batch($seme_code,$dept_info,$batch_info);
          $data['point_table'] = $this->report_m->point_table($seme_code,$dept_info);
          $data['get_earn_point'] = $this->report_m->get_earn_point($seme_code, $dept_info, $null = 0);
          $data['get_result'] = $this->report_m->get_std_result($seme_code, $dept_info);
          $html = $this->load->view('pages/report/semester_result', $data, true);
          $this->html2pdf->html($html);
          $this->html2pdf->create();
        }
        elseif (($section_info != '') && ($batch_info =='')) {

          $data['dept_fill_name'] = $this->report_m->get_dept_full_name($dept_info);
          $data['sectionInfo'] = $this->report_m->get_section_info($section_info);
          $data['get_seme_full_name'] = $this->report_m->get_seme_full_name($seme_code);
          $data['get_std_id'] = $this->report_m->get_std_ids_accro_section($seme_code,$dept_info,$section_info);
          $data['point_table'] = $this->report_m->point_table($seme_code,$dept_info);
          $data['get_earn_point'] = $this->report_m->get_earn_point($seme_code, $dept_info, $null = 0);
          $data['get_result'] = $this->report_m->get_std_result($seme_code, $dept_info);
          $html = $this->load->view('pages/report/semester_result', $data, true);
          $this->html2pdf->html($html);
          $this->html2pdf->create();

        }
        elseif (($section_info != '') && ($batch_info !='')) {

          $data['dept_fill_name'] = $this->report_m->get_dept_full_name($dept_info);
          $data['batchInfo'] = $this->report_m->get_batch_info($batch_info);
          $data['sectionInfo'] = $this->report_m->get_section_info($section_info);
          $data['get_seme_full_name'] = $this->report_m->get_seme_full_name($seme_code);
          $data['get_std_id'] = $this->report_m->get_std_ids_accro_BatchSection($seme_code,$dept_info,$batch_info,$section_info);
          $data['point_table'] = $this->report_m->point_table($seme_code,$dept_info);
          $data['get_earn_point'] = $this->report_m->get_earn_point($seme_code, $dept_info, $null = 0);
          $data['get_result'] = $this->report_m->get_std_result($seme_code, $dept_info);
          $html = $this->load->view('pages/report/semester_result', $data, true);
          $this->html2pdf->html($html);
          $this->html2pdf->create();

        }

        $data['dept_fill_name'] = $this->report_m->get_dept_full_name($dept_info);
        $data['get_seme_full_name'] = $this->report_m->get_seme_full_name($seme_code);
        $data['get_std_id'] = $this->report_m->get_std_ids($seme_code,$dept_info);
        $data['point_table'] = $this->report_m->point_table($seme_code,$dept_info);
        $data['get_earn_point'] = $this->report_m->get_earn_point($seme_code, $dept_info, $null = 0);
        $data['get_result'] = $this->report_m->get_std_result($seme_code, $dept_info);
        $html = $this->load->view('pages/report/semester_result', $data, true);
        $this->html2pdf->html($html);
        $this->html2pdf->create();
      }
    }
    else {
      redirect(base_url('report/report'));
    }
  }

  // callback function
  function seme_blank($value=''){
    if($this->input->post('seme_code') == ""){
      $this->form_validation->set_message('seme_blank','Please Select Semester Code !');
      return FALSE;
    }
    return TRUE;
  }
  function dept_blank($value=''){
    if($this->input->post('dept_info') == ""){
      $this->form_validation->set_message('dept_blank','Please Select Department !');
      return FALSE;
    }
    return TRUE;
  }






}
