<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends CI_Controller {
  //constract_function
  public function __construct(){
    parent::__construct();
    if($this->session->userdata('access') == 0 || $this->session->userdata('access') == 3 || $this->session->userdata('access') == 4)
      redirect(base_url('login/index'));
    $this->load->model('subject_m');
  }
  // defult load function
  public function index(){
    redirect ('dashboard/index');
  }
    // profile methode function
  public function subject(){

    $data= [];
    $data['title'] = "Subject";
    $data['subject_info']='subject/view';
    $data['get_dept'] = $this->subject_m->get_department();
    $data['get_data'] = $this->subject_m->get_data();
    $this->load->view('dashboard_layout',$data);
  }

    // rules for subject
  protected function rulesForSubject() {
    $config = array(
      array(
       'field'   => 'subject_code',
       'label'   => 'Subject code',
       'rules'   => 'required|min_length[4]|max_length[7]'
       ),
      array(
       'field'   => 'subject_name',
       'label'   => 'Subject Name',
       'rules'   => 'required'
       ),
      array(
       'field'   => 'subject_dept',
       'label'   => 'Department Name',
       'rules'   => 'required'
       ),
      array(
       'field'   => 'subject_credit',
       'label'   => 'Credit',
       'rules'   => 'required'
       )
      );
    return $config;
  }

    // Add New
  public function add_subject(){

    if($_POST) {
          // dump_exit($this->rulesForSubject());
      $this->form_validation->set_rules($this->rulesForSubject());
      if($this->form_validation->run() == FALSE) {
        $data['validation_errors'] = $this->form_validation->verror_array();
        $data['subject_info']='subject/view';
        $data['get_dept'] = $this->subject_m->get_department();
        $data['get_data'] = $this->subject_m->get_data();
        $this->load->view('dashboard_layout',$data);
      } else {
        $array = array();
        $getrules = $this->rulesForSubject();


        foreach ($getrules as $key => $value) {
          $array[$value['field']] = $this->input->post($value['field']);

        }
        $this->subject_m->add_new_sub($array);
        $this->session->set_flashdata('success', 'Successfully Added a new Subject');
        redirect(base_url('subject/subject'));
      }
    } else {
      $data['subject_info'] = 'std/view';
      $this->load->view('dashboard_layout',$data);
    }
  }
        // delete
  public function delete_data($id = null){

    if($this->subject_m->delete_data($id)){
      $this->session->set_flashdata('success', 'Successfully Deleted');
      redirect(base_url('subject/subject'));
    } else {
     redirect(base_url('dashboard/index'));
   }
 }

        // retrive data for update
 public function retrive_data($id=null){
  if($this->input->post('subjectID')) {

    $subject = $this->subject_m->get_single_subject($this->input->post('subjectID'));

    if(count($subject)) {
      $json = array("confirmation" => 'success','id' => $subject->id,'subject_code' => $subject->subject_code, 'subject_name' => $subject->subject_name, 'subject_dept' => $subject->subject_dept, 'subject_credit'=>$subject->subject_credit);
      header("Content-Type: application/json", true);
      echo json_encode($json);
      exit;
    } else {
      $json = array("confirmation" => 'error');
      header("Content-Type: application/json", true);
      echo json_encode($json);
    }
  }
}

        //  update script
public function subject_update(){
  if($_POST) {
    $this->form_validation->set_rules($this->rulesForSubject());
    if($this->form_validation->run() == FALSE) {
      $data['validation_errors'] = $this->form_validation->verror_array();
      $data['subject_info']='subject/view';
      $data['get_dept'] = $this->subject_m->get_department();
      $data['get_data'] = $this->subject_m->get_data();
      $this->load->view('dashboard_layout',$data);
    } else {
      $array= array(
       'subject_code'      => $this->input->post('subject_code'),
       'subject_name'      => $this->input->post('subject_name'),
       'subject_dept'      => $this->input->post('subject_dept'),
       'subject_credit'    => $this->input->post('subject_credit'),
       );

      $id = $this->input->post('id');
      if ($this->subject_m->update_subject($array, $id)) {
       $this->session->set_flashdata('success', ' Update Successfully');
     } else {
      $this->session->set_flashdata('error', 'Please Fillup Correct Information !');
     }
   }
 } else {
  echo 'Error';

}
}






}
