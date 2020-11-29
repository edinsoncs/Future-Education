<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends CI_Controller {
  //constract_function
  public function __construct(){
    parent::__construct();
    if($this->session->userdata('access') == 0 || $this->session->userdata('access') == 3 || $this->session->userdata('access') == 4)
      redirect(base_url('login/index'));
    $this->load->model('student_m');
  }
    // defult load function
  public function index(){
    redirect ('dashboard/index');
  }
    // profile methode function
  public function student(){
    $data= [];
    $data['title'] = "Student";
    $data['student_info']='std/view';
    $data['get_info'] = $this->student_m->get_info();
    $this->load->view('dashboard_layout',$data);
  }

  /* protected rull  */
  protected function rulesForAddStudent() {
    $config = array(
      array(
       'field'   => 'std_id',
       'label'   => 'Student ID',
       'rules'   => 'required|numeric'
       ),
      array(
       'field'   => 'std_name',
       'label'   => 'Student Full Name',
       'rules'   => 'required'
       ),
      array(
       'field'   => 'std_dept',
       'label'   => 'Department',
       'rules'   => 'required'
       ),
      array(
       'field'   => 'std_batch',
       'label'   => 'Batch',
       'rules'   => 'required',
       ),
      array(
       'field'   => 'std_section',
       'label'   => 'Section',
       'rules'   => 'required',
       ),
      array(
        'field' => 'required_credit',
        'label' => 'Required Credit',
        'rules' => 'required|numeric|min_length[3]|max_length[4]',
        ),
      array(
       'field'   => 'std_status',
       'label'   => 'Status',
       'rules'   => 'required',
       ),
      array(
       'field'   => 'std_gender',
       'label'   => 'Gender',
       'rules'   => 'required|callback_gender_type',
       ),
      array(
       'field'   => 'std_religion',
       'label'   => 'Religion',
       'rules'   => 'required|callback_religion_type',
       ),
      array(
       'field'   => 'std_email_address',
       'label'   => 'Email Address',
       'rules'   => 'required|valid_email|callback_chack_duplicate_email',
       ),
      array(
       'field'   => 'std_contact_no',
       'label'   => 'Contact No',
       'rules'   => 'required|numeric|min_length[10]|max_length[15]|callback_chack_duplicate_contact_no',
       )
      );
return $config;
}
    // callback function
function chack_duplicate_email(){
  if(count($this->student_m->chackStdEmail($this->input->post('std_email_address')))){
    $this->form_validation->set_message('chack_duplicate_email','This Email Address Already Exits !');
    return FALSE;
  }
  return TRUE;
}
function chack_duplicate_contact_no(){
  if(count($this->student_m->chackStdContact($this->input->post('std_contact_no')))){
    $this->form_validation->set_message('chack_duplicate_contact_no','This Contact no. Already Exits !');
    return FALSE;
  }
  return TRUE;
}
function gender_type() {
  if($this->input->post('std_gender') == "0") {
    $this->form_validation->set_message('gender_type', 'Please Select Gender !');
    return FALSE;
  }
  return TRUE;
}
function religion_type() {
  if($this->input->post('std_religion') == "0") {
    $this->form_validation->set_message('religion_type', 'Please Select Religion !');
    return FALSE;
  }
  return TRUE;
}
// add new student info
public function addNew(){
  $this->load->library('encryption');
  $data= [];
  $data['title'] = "Add New Student";
  $data['get_dept']= $this->student_m->get_department();
  $data['student_add']='std/add';

  if($_POST) {
    $chackStdID = $this->student_m->chackStdID($this->input->post('std_id'));
    if (!count($chackStdID)) {
      $this->form_validation->set_rules($this->rulesForAddStudent());
      if($this->form_validation->run() == FALSE) {
        $data['validation_errors'] = $this->form_validation->verror_array();
        $this->load->view('dashboard_layout',$data);
      } else {
        $array = array();
        $getrules = $this->rulesForAddStudent();
        foreach ($getrules as $key => $value) {
          $array[$value['field']] = $this->input->post($value['field']);
        }
        $array['access_type'] = '4';
        $array['std_complete_graduation'] = '0';

        $array['std_display_id'] = $this->input->post('display_id');
        $std_user_info = array(
          'user_id'         => $this->input->post('display_id'),
          'user_full_name'  => $this->input->post('std_name'),
          'email_address'   => $this->input->post('std_email_address'),
          'contact_no'      => $this->input->post('std_contact_no'),
          'user_name'       => $this->input->post('std_id'),
          'user_pass'       => md5($this->input->post('std_id')),
          'access_type'     => '4'
          );
        $this->student_m->add_student_info($array,$std_user_info);
        $this->session->set_flashdata('success', 'Successfully Create an Student Info');
        redirect(base_url('students/student'));
      }
    } else {
      $this->session->set_flashdata('errors', 'This Student ID Already Exits !');
      $this->load->view('dashboard_layout',$data);
    }
  } else {
    $data['get_info'] = $this->student_m->get_info();
    $this->load->view('dashboard_layout',$data);
  }
}

    // rective ID wase student info
public function edit_student($std_display_id = null){
  if ($this->student_m->get_stdID_info($std_display_id)) {
    $data= [];
    $data['title'] = "Update Student Informetion";
    $data['edit_std_info']='std/edit';
    $data['get_dept']= $this->student_m->get_department();
    $data['get_stdID_info']= $this->student_m->get_stdID_info($std_display_id);
    $this->load->view("dashboard_layout",$data);
  }else {
    redirect(base_url('settings/settings_data'));
  }
}

    // update srudent permission informetion
protected function rulesForUpdateStudent() {
  $config = array(
    array(
     'field'   => 'std_id',
     'label'   => 'Student ID',
     'rules'   => 'required|numeric|callback_unique_std_id'
     ),
    array(
     'field'   => 'std_name',
     'label'   => 'Student Full Name',
     'rules'   => 'required'
     ),
    array(
     'field'   => 'std_dept',
     'label'   => 'Department',
     'rules'   => 'required'
     ),
    array(
     'field'   => 'std_batch',
     'label'   => 'Batch',
     'rules'   => 'required',
     ),
    array(
     'field'   => 'std_section',
     'label'   => 'Section',
     'rules'   => 'required',
     ),
    array(
      'field' => 'required_credit',
      'label' => 'Required Credit',
      'rules' => 'required|numeric|min_length[3]|max_length[4]',
      ),
    array(
     'field'   => 'std_status',
     'label'   => 'Status',
     'rules'   => 'required',
     ),
    array(
     'field'   => 'std_gender',
     'label'   => 'Gender',
     'rules'   => 'required',
     ),
    array(
     'field'   => 'std_religion',
     'label'   => 'Religion',
     'rules'   => 'required',
     ),
    array(
     'field'   => 'std_email_address',
     'label'   => 'Email Address',
     'rules'   => 'required|valid_email|callback_unique_emailaddress'
     ),
    array(
     'field'   => 'std_contact_no',
     'label'   => 'Contact No',
     'rules'   => 'required|numeric|min_length[10]|max_length[15]|callback_unique_contactno'
     ),
    array(
     'field'   => 'user_pass',
     'label'   => 'Password',
     'rules'   => 'md5'
     ),
    array(
     'field'   => 'rp_user_pass',
     'label'   => 'Repeat Password',
     'rules'   => 'matches[user_pass]|md5'
     )
    );
return $config;
}

    //  callback function ......

function unique_std_id() {
  $displayID = $this->uri->segment(3);
  $studentDisplayQ = $this->student_m->get_single_student($displayID);
  $student = $this->student_m->get_student($this->input->post('std_id'), $studentDisplayQ->id);
  if(count($student)) {
   $this->form_validation->set_message('unique_std_id','This student ID already exists.');
   return FALSE;
 }
 return TRUE;
}
function unique_emailaddress() {
  $displayID = $this->uri->segment(3);
  $studentDisplayQ = $this->student_m->get_single_student($displayID);
  $student = $this->student_m->get_student_email($this->input->post('std_email_address'), $studentDisplayQ->id);
  if(count($student)) {
   $this->form_validation->set_message('unique_emailaddress','This Email address already exists.');
   return FALSE;
 }
 return TRUE;
}

function unique_contactno() {
  $displayID = $this->uri->segment(3);
  $studentDisplayQ = $this->student_m->get_single_student($displayID);
  $student = $this->student_m->get_student_contact($this->input->post('std_contact_no'), $studentDisplayQ->id);
  if(count($student)) {
   $this->form_validation->set_message('unique_contactno','This Contact No. already exists.');
   return FALSE;
 }
 return TRUE;
}



public function update_std_info($std_display_id = std_display_id){

  if ($_POST) {
    $this->form_validation->set_rules($this->rulesForUpdateStudent());
    if($this->form_validation->run() == FALSE) {
     $data= [];
     $data['title'] = "Update Student Information";
     $data['edit_std_info']='std/edit';
     $data['get_dept']= $this->student_m->get_department();
     $data['get_stdID_info']= $this->student_m->get_stdID_info($std_display_id);
     $data['validation_errors'] = $this->form_validation->verror_array();
     $this->load->view('dashboard_layout',$data);
   } else {
    $array = array();
    $getrules = $this->rulesForUpdateStudent();
    unset($getrules[11], $getrules[12]);
    foreach ($getrules as $key => $value) {
      $array[$value['field']] = $this->input->post($value['field']);
    }
    $array['access_type'] = '4';
    $chack = $this->input->post('checkbox');
    if ($chack != TRUE) {
      $std_user_info = array(
        'user_full_name'  => $this->input->post('std_name'),
        'email_address'   => $this->input->post('std_email_address'),
        'contact_no'      => $this->input->post('std_contact_no'),
        'user_name'       => $this->input->post('std_id'),
        );
    } else {
      $std_user_info = array(
        'user_full_name'  => $this->input->post('std_name'),
        'email_address'   => $this->input->post('std_email_address'),
        'contact_no'      => $this->input->post('std_contact_no'),
        'user_name'       => $this->input->post('std_id'),
        'user_pass'       =>$this->input->post('user_pass'),
        );
    }
    $this->student_m->update_student_info($array,$std_user_info,$std_display_id);
    $this->session->set_flashdata('success', 'Successfully Created Student Info');
    redirect(base_url('students/student'));
  }
} else {
  $data['get_info'] = $this->student_m->get_info();
  $this->load->view('dashboard_layout',$data);
}
}

// deactivate function
public function deactivate($display_id = null){
  $array = array('access_type' => 0);
  $this->student_m->update_activate_info($array,$display_id);
  redirect(base_url('students/student'));
}
// deactivate function
public function activate($display_id = null){
  $array = array('access_type' => 4);
  $this->student_m->update_activate_info($array,$display_id);
  redirect(base_url('students/student'));

}

// complete graduation  function
public function complete_btn($display_id = null){
  $array = array('std_complete_graduation' => 0);
  $this->student_m->update_complete_info($array,$display_id);
  redirect(base_url('students/student'));
}

// running graduation function
public function running_btn($display_id = null){
  $array = array('std_complete_graduation' => 1, 'library_access'=> 0);
  $this->student_m->update_complete_info($array,$display_id);
  redirect(base_url('students/student'));
}

}
