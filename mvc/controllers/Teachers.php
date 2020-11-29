<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teachers extends CI_Controller {
//constract_function
public function __construct(){
    parent::__construct();
    if($this->session->userdata('access') == 0 || $this->session->userdata('access') == 3 || $this->session->userdata('access') == 4)
      redirect(base_url('login/index'));
    $this->load->model('teachers_m');
    $this->load->model('authority_m');
}
// defult load function
public function index(){
  redirect ('dashboard/index');
}
// profile methode function
public function teacher(){
  $data= [];
  $data['title'] = "Teacher";
  $data['teachers_info']='teacher/view';
  $data['teacher_info'] = $this->teachers_m->get_info();
  $this->load->view('dashboard_layout',$data);
}

/* protected rull  */
protected function rulesForTeachers() {
    $config = array(
      array(
       'field'   => 'user_full_name',
       'label'   => 'FullName',
       'rules'   => 'required'
       ),
      array(
       'field'   => 'teacher_designation',
       'label'   => 'teacher designation',
       'rules'   => 'required'
       ),
      array(
       'field'   => 'teacher_department',
       'label'   => 'department',
       'rules'   => 'required'
       ),
      array(
       'field'   => 'date_of_join',
       'label'   => 'Joining Date',
       'rules'   => 'required'
       ),
      array(
       'field'   => 'teacher_gender',
       'label'   => 'Gender',
       'rules'   => 'required|callback_gender_type'
       ),
      array(
       'field'   => 'teacher_religion',
       'label'   => 'Religion',
       'rules'   => 'required|callback_religion_type'
       ),
      array(
       'field'   => 'email_address',
       'label'   => 'Email',
       'rules'   => 'required|valid_email|callback_chack_duplicate_email'
       ),
      array(
       'field'   => 'contact_no',
       'label'   => 'Phone',
       'rules'   => 'required|numeric|min_length[10]|max_length[15]|callback_chack_duplicate_contact_no'
       ),
      array(
       'field'   => 'access_type',
       'label'   => 'Access Type',
       'rules'   => '',
       'value'   =>'3'
       ),
      array(
       'field'   => 'user_name',
       'label'   => 'username',
       'rules'   => 'required'
       ),
      array(
       'field'   => 'user_pass',
       'label'   => 'Password',
       'rules'   => 'required|md5'
       ),
      array(
       'field'   => 'rp_user_pass',
       'label'   => 'Repeat Password',
       'rules'   => 'required|matches[user_pass]|md5'
       )
      );
return $config;
}
// callback function
function chack_duplicate_email(){
  if(count($this->teachers_m->chackTecEmail($this->input->post('email_address')))){
    $this->form_validation->set_message('chack_duplicate_email','This Email Address Already Exits !');
    return FALSE;
  }
  return TRUE;
}
function chack_duplicate_contact_no(){
  if(count($this->teachers_m->chackTecContact($this->input->post('contact_no')))){
    $this->form_validation->set_message('chack_duplicate_contact_no','This Contact no. Already Exits !');
    return FALSE;
  }
  return TRUE;
}
function gender_type(){
  if($this->input->post('teacher_gender') == "0") {
    $this->form_validation->set_message('gender_type', 'Please Select Gender !');
    return FALSE;
  }
  return TRUE;
}
function religion_type() {
  if($this->input->post('teacher_religion') == "0" ) {
    $this->form_validation->set_message('religion_type', 'Please Select Religion !');
    return FALSE;
  }
  return TRUE;
}
// add new teachers page
public function add_teacher(){
  $admin = 'admin';
  $root = 'root';

  $this->load->library('encryption');
  $data= [];
  $data['title'] = "Add New Teacher";
  $data['dept'] =$this->teachers_m->get_dept();
  $data['teachers_info']='teacher/add';
  if($_POST) {
    $chackStdID = $this->teachers_m->chackUserID($this->input->post('user_name'));
    $chackAdmin = $this->input->post('user_name');
    if (!count($chackStdID)){
      if ($chackAdmin != $admin && $chackAdmin != $root) {
        $this->form_validation->set_rules($this->rulesForTeachers());
          // dd($this->rulesForTeachers());
        if($this->form_validation->run() == FALSE) {
          $data['validation_errors'] = $this->form_validation->verror_array();
          $this->load->view('dashboard_layout',$data);
        } else {
          $array = array();
          $getrules = $this->rulesForTeachers();
          unset($getrules[1],$getrules[2],$getrules[3],$getrules[4],$getrules[5],$getrules[11]);
          foreach ($getrules as $key => $value) {
            $array[$value['field']] = $this->input->post($value['field']);

          }
          $array['user_id'] = $this->input->post('user_id');
          $array['access_type'] = '3';
          $this->teachers_m->add_teacher_user_info($array);

          unset($array);
          $array['display_id'] = $this->input->post('user_id');
          $array['teacher_name'] = $this->input->post('user_full_name');
          $array['teacher_designation'] = $this->input->post('teacher_designation');
          $array['teacher_department'] = $this->input->post('teacher_department');
          $array['date_of_join'] = $this->input->post('date_of_join');
          $array['teacher_gender'] = $this->input->post('teacher_gender');
          $array['teacher_religion'] = $this->input->post('teacher_religion');
          $array['email_address'] = $this->input->post('email_address');
          $array['contact_no'] = $this->input->post('contact_no');
          $array['user_name'] = $this->input->post('user_name');
          $array['access_type'] = '3';

          $this->teachers_m->add_teacher_info($array);
          $this->session->set_flashdata('success', 'Successfully Created Teacher Informetion.');
          redirect(base_url('teachers/teacher'));
        }
      } else {
        $this->session->set_flashdata('errors', 'This username is not acceptable !');
        $this->load->view('dashboard_layout',$data);
      }
    } else {
      $this->session->set_flashdata('errors', 'This username Already Exists !');
      $this->load->view('dashboard_layout',$data);
    }
  } else {
    $data['teacher_info'] = $this->teachers_m->get_info();
    $this->load->view('dashboard_layout',$data);
  }
}
// Delete teacher info & user
public function delete_teachers_data($display_id = null){
  if($this->teachers_m->delete_teachers_user($display_id)){
   $this->session->set_flashdata('success', 'Successfully Deleted');
   redirect(base_url('teachers/teacher'));
 } else {
   redirect(base_url('dashboard/index'));
 }
}
// retrive_data
public function retrive_data($display_id = null){
  if ($this->teachers_m->user_retrive_info($display_id)) {
    $data= [];
    $data['title'] = "Update Teachers Information";
    $data['edit_teacher'] = 'teacher/edit';
    $data['teachers_edit_info'] = $this->teachers_m->user_retrive_info($display_id);
    $data['dept'] =$this->teachers_m->get_dept();
    $this->load->view('dashboard_layout',$data);

  }else {
    redirect(base_url('teachers/teacher'));
  }
}
//  update  rulls for teacher users
protected function rulesForTeacherUpdate() {
  $config = array(
    array(
     'field'   => 'user_full_name',
     'label'   => 'FullName',
     'rules'   => 'required'
     ),
    array(
     'field'   => 'teacher_designation',
     'label'   => 'teacher designation',
     'rules'   => 'required'
     ),
    array(
     'field'   => 'teacher_department',
     'label'   => 'department',
     'rules'   => 'required'
     ),
    array(
     'field'   => 'date_of_join',
     'label'   => 'Joining Date',
     'rules'   => 'required'
     ),
    array(
     'field'   => 'teacher_gender',
     'label'   => 'Gender',
     'rules'   => 'required'
     ),
    array(
     'field'   => 'teacher_religion',
     'label'   => 'Religion',
     'rules'   => 'required'
     ),
    array(
     'field'   => 'email_address',
     'label'   => 'Email',
     'rules'   => 'required|valid_email|callback_unique_emailaddress'
     ),
    array(
     'field'   => 'contact_no',
     'label'   => 'Phone',
     'rules'   => 'required|numeric|min_length[10]|max_length[15]|callback_unique_contactno'
     ),
    array(
     'field'   => 'user_name',
     'label'   => 'username',
     'rules'   => 'required|callback_unique_username'
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
//callback function for  chack username
function unique_username() {
  $displayID = $this->uri->segment(3);
  $teacherDisplayQ = $this->teachers_m->get_single_teacher($displayID);
  $teacher = $this->teachers_m->get_teacher($this->input->post('user_name'), $teacherDisplayQ->id);
  if(count($teacher)) {
   $this->form_validation->set_message('unique_username','This Username already exists.');
   return FALSE;
 }
 return TRUE;
}
function unique_emailaddress() {
  $displayID = $this->uri->segment(3);
  $teacherDisplayQ = $this->teachers_m->get_single_teacher($displayID);
  $teacher = $this->teachers_m->get_teacher_email($this->input->post('email_address'), $teacherDisplayQ->id);
  if(count($teacher)) {
   $this->form_validation->set_message('unique_emailaddress','This Email address already exists.');
   return FALSE;
 }
 return TRUE;
}
function unique_contactno() {
  $displayID = $this->uri->segment(3);
  $teacherDisplayQ = $this->teachers_m->get_single_teacher($displayID);
  $teacher = $this->teachers_m->get_teacher_contact($this->input->post('contact_no'), $teacherDisplayQ->id);
  if(count($teacher)) {
   $this->form_validation->set_message('unique_contactno','This Contact No. already exists.');
   return FALSE;
 }
 return TRUE;
}
// update teacher users data
public function teacher_update_info($display_id = null){

  if ($_POST) {
    $this->form_validation->set_rules($this->rulesForTeacherUpdate());

    if($this->form_validation->run() == FALSE) {
      $data= [];
      $data['title'] = "Update Teacher Information";
      $data['edit_teacher'] = 'teacher/edit';
      $data['teachers_edit_info'] = $this->teachers_m->user_retrive_info($display_id);
      $data['validation_errors'] = $this->form_validation->verror_array();
      $data['dept'] =$this->teachers_m->get_dept();
      $this->load->view('dashboard_layout',$data);
    }
    else {
      $array = array();
      $getrules = $this->rulesForTeacherUpdate();
      // dd($this->rulesForTeacherUpdate());
      $chack = $this->input->post('checkbox');
      unset($getrules[1],$getrules[2],$getrules[3],$getrules[4],$getrules[5],$getrules[10]);
      if ($chack != TRUE) {
        unset($getrules[9]);
        foreach ($getrules as $key => $value) {
          $array[$value['field']] = $this->input->post($value['field']);
        }
      }
      else {
        foreach ($getrules as $key => $value) {
          $array[$value['field']] = $this->input->post($value['field']);
        }
      }
      $array['access_type'] = '3';
      $this->teachers_m->update_teacher_user($array,$display_id);

      unset($array);
      $array['teacher_name'] = $this->input->post('user_full_name');
      $array['teacher_designation'] = $this->input->post('teacher_designation');
      $array['teacher_department'] = $this->input->post('teacher_department');
      $array['date_of_join'] = $this->input->post('date_of_join');
      $array['teacher_gender'] = $this->input->post('teacher_gender');
      $array['teacher_religion'] = $this->input->post('teacher_religion');
      $array['email_address'] = $this->input->post('email_address');
      $array['contact_no'] = $this->input->post('contact_no');
      $array['user_name'] = $this->input->post('user_name');
      $array['access_type'] = '3';

      $this->teachers_m->update_teacher_info($array,$display_id);
      $this->session->set_flashdata('success', 'Successfully Updated Informations');
      redirect(base_url('teachers/teacher'));
    }
  }
  else {
    $data['teacher_info'] = $this->teachers_m->get_info();
    $this->load->view('dashboard_layout',$data);
  }
}
// deactivate function
public function deactivate($display_id = null){
  $array = array('access_type' => 0);
  $this->teachers_m->update_teacher_info($array,$display_id);
  $this->teachers_m->update_teacher_user($array,$display_id);
  redirect(base_url('teachers/teacher'));
}
// deactivate function
public function activate($display_id = null){
  $array = array('access_type' => 3);
  $this->teachers_m->update_teacher_info($array,$display_id);
  $this->teachers_m->update_teacher_user($array,$display_id);
  redirect(base_url('teachers/teacher'));
}


}
