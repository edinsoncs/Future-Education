<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResultArchive extends CI_Controller {
  //constract_function
  public function __construct(){
    parent::__construct();
    if($this->session->userdata('access') == 0 || $this->session->userdata('access') == 3 || $this->session->userdata('access') == 4)
      redirect(base_url('login/index'));
    $this->load->model('resultArchive_m');
  }
  // defult load function
  public function index(){
    redirect ('dashboard/index');
  }
  // profile methode function
  public function resultArchive(){
    $get_std_result_summary = $this->resultArchive_m->get_all_result($null = 0);
    $data= [];
    $data['title'] = "Result Archive";
    $data['get_std_result'] = $get_std_result_summary;
    $data['semester_code'] = $this->resultArchive_m->get_semester_code();
    $data['show_std_waiver'] = $this->resultArchive_m->show_std_waiver();
    $data['get_info'] = $this->resultArchive_m->get_info();
    $data['resultArchive']='resultArchive/view';
    $this->load->view('dashboard_layout',$data);
  }
  // result publish
  public function publish_result($id){
    $attr = array('action' => 1);
    $this->resultArchive_m->publish_result($id,$attr);
    $this->session->set_flashdata('success', 'Result Published Successfully ');
    redirect(base_url('resultArchive/resultArchive'));
  }
  // result withdraw
  public function withdrow_result($id){
    $attr = array('action' => 0);
    $this->resultArchive_m->withdrow_result($id,$attr);
    $this->session->set_flashdata('warning', 'The Results have been Withdrawn !');
    redirect(base_url('resultArchive/resultArchive'));
  }
  //get view marksheet accroding to std
  public function view_marksheet($display_id = null){
    if ($this->resultArchive_m->std_info($display_id)) {
      $data= [];
      $data['title'] = "View Details";
      $data['get_marksheet'] = 'resultArchive/details';
      $data['std_info'] = $this->resultArchive_m->std_info($display_id);
      // $data['get_info'] = $this->resultArchive_m->get_single_info($display_id);
      $data['get_waiver_sub'] = $this->resultArchive_m->get_waiver_sub($display_id);
      $data['get_waiver_display_id'] = $this->resultArchive_m->get_display_id($display_id);
      $data['dept_full_name'] =$this->resultArchive_m->get_dept($data['std_info']->std_dept);
      $data['point_table'] = $this->resultArchive_m->point_table($display_id);
      $data['get_earn_point'] = $this->resultArchive_m->get_earn_point($display_id, $null = 0);
      $data['per_sub_point'] = $this->resultArchive_m->per_sub_point_table($display_id);
      $this->load->view('dashboard_layout',$data);
    }else {
      redirect(base_url('resultArchive/resultArchive'));
    }
  }

  // complete graduation  function
  public function complete_btn($display_id = null){
    $array = array('std_complete_graduation' => 0);
    $this->resultArchive_m->update_complete_info($array,$display_id);
    redirect(base_url('resultArchive/resultArchive'));
  }

  // running graduation function
  public function running_btn($display_id = null){
    $array = array('std_complete_graduation' => 1);
    $this->resultArchive_m->update_complete_info($array,$display_id);
    redirect(base_url('resultArchive/resultArchive'));
  }

}
