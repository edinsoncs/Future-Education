<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
  //constract_function
  public function __construct(){
    parent::__construct();
    if($this->session->userdata('access') == 0 || $this->session->userdata('access') == 2 || $this->session->userdata('access') == 3 || $this->session->userdata('access') == 4)
      redirect(base_url('login/index'));
    $this->load->model('user_m');
    $this->load->model('gread_point_m');
    $this->load->model('settings_m');
    $this->load->model('authority_m');
    $this->load->library('form_validation');
  }

  public function index(){
    redirect ('dashboard/index');
  }

  /* Start authority user function */
  protected function rulesForAuthority() {
    $config = array(
      array(
       'field'   => 'user_full_name',
       'label'   => 'FullName',
       'rules'   => 'required'
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
       'rules'   => 'required|callback_uinque_access_type'
       ),
      array(
       'field'   => 'user_name',
       'label'   => 'username',
       'rules'   => 'required|callback_chack_duplicate_username'
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
  // chack for email address
function chack_duplicate_email(){
  if(count($this->authority_m->chackEmail($this->input->post('email_address')))){
    $this->form_validation->set_message('chack_duplicate_email','Email Address Already Exists !');
    return FALSE;
  }
  return TRUE;
}
function chack_duplicate_contact_no(){
  if(count($this->authority_m->chackContact($this->input->post('contact_no')))){
    $this->form_validation->set_message('chack_duplicate_contact_no','Contact no. Already Exists !');
    return FALSE;
  }
  return TRUE;
}
function chack_duplicate_username(){
  if(count($this->authority_m->chackUsername($this->input->post('user_name')))){
    $this->form_validation->set_message('chack_duplicate_username','Username Already Exists !');
    return FALSE;
  }
  return TRUE;
}
public function authority_add(){
  $this->load->library('encryption');
  $data= [];
  $data['title'] = "Creat Authority";
  $data['authority_data'] = 'authority/add';
    // get authority informetions
  if($_POST) {
        // dd($this->rulesForAuthority());

    $this->form_validation->set_rules($this->rulesForAuthority());
    if($this->form_validation->run() == FALSE) {
      $data['validation_errors'] = $this->form_validation->verror_array();
      $data['authority_info'] = $this->authority_m->get_authority_info();
      $this->load->view('dashboard_layout',$data);
    } else {
      $array = array();
      $getrules = $this->rulesForAuthority();

      unset($getrules[6]);
      foreach ($getrules as $key => $value) {
        $array[$value['field']] = $this->input->post($value['field']);

      }
      // dd($array);
      // $array['access_type'] = 2;
      $array['user_id'] = $this->input->post('user_id');
      $this->authority_m->authority_user_data($array);
      $this->session->set_flashdata('success', 'Successfully Created Authority');
      redirect(base_url('settings/settings_data'));
    }
  } else {
    $data['authority_info'] = $this->authority_m->get_authority_info();
    $this->load->view('dashboard_layout',$data);
  }
}
  // callback function
function uinque_access_type() {
  if($this->input->post('access_type') == 0) {

    $this->form_validation->set_message('uinque_access_type', 'Please Select Access Type');

    return FALSE;
  }
  return TRUE;
}
  // update  fules for authority users
protected function rulesForAuthorityUpdate() {
  $config = array(
    array(
     'field'   => 'user_full_name',
     'label'   => 'FullName',
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
     'field'   => 'access_type',
     'label'   => 'Access Type',
     'rules'   => 'required|callback_uinque_access_type'
     ),
    array(
     'field'   => 'user_name',
     'label'   => 'username',
     'rules'   => 'required|callback_user_exits'
     ),
    array(
     'field'   => 'user_pass',
     'label'   => 'Password',
     'rules'   => 'md5|callback_chack_required_password'
     ),
    array(
     'field'   => 'rp_user_pass',
     'label'   => 'Repeat Password',
     'rules'   => 'matches[user_pass]|md5'
     )
    );
  return $config;
}
  // callback function for update
function user_exits() {
  $displayID = $this->uri->segment(3);
  $userchack = $this->authority_m->user_exits($this->input->post('user_name'), $displayID);
  if(count($userchack)) {
   $this->form_validation->set_message('user_exits','Username already exists !');
   return FALSE;
 }
 return TRUE;
}
function unique_emailaddress() {
  $displayID = $this->uri->segment(3);
  $userchack = $this->authority_m->get_email_address($this->input->post('email_address'), $displayID);
  if(count($userchack)) {
   $this->form_validation->set_message('unique_emailaddress','Email address already exists !');
   return FALSE;
 }
 return TRUE;
}
function unique_contactno() {
  $displayID = $this->uri->segment(3);
  $userchack = $this->authority_m->get_contact_no($this->input->post('contact_no'), $displayID);
  if(count($userchack)) {
   $this->form_validation->set_message('unique_contactno','Contact No. already exists !');
   return FALSE;
 }
 return TRUE;
}

function chack_required_password(){
  $chack = $this->input->post('checkbox');
  $password = $this->input->post('user_pass');
  if ($chack == true) {
    if (!empty($password)) {
      return TRUE;
    }else {
      $this->form_validation->set_message('chack_required_password','This Password Field is Required.');
      return FALSE;
    }
    $this->form_validation->set_message('chack_required_password','This Password Field is Required.');
    return FALSE;
  }else{
    return TRUE;
  }
}
  // update authority users data
public function authority_update_info($id = null){

  if ($_POST) {
    $this->form_validation->set_rules($this->rulesForAuthorityUpdate());

    if($this->form_validation->run() == FALSE) {
      $data= [];
      $data['title'] = "Update Authority Information";
      $data['edit_authority_data'] = 'authority/edit';
      $data['authority_info'] = $this->authority_m->user_retrive_info($id);
      $data['validation_errors'] = $this->form_validation->verror_array();
      $this->load->view('dashboard_layout',$data);

    }
    else {
      $array = array();
      $getrules = $this->rulesForAuthorityUpdate();
      $chack = $this->input->post('checkbox');

      unset($getrules[6]);
      if ($chack != TRUE) {
        unset($getrules[5]);
        foreach ($getrules as $key => $value) {
          $array[$value['field']] = $this->input->post($value['field']);
        }
      }
      else {
        foreach ($getrules as $key => $value) {
          $array[$value['field']] = $this->input->post($value['field']);
        }
      }

      // dd($array);
              // $array['user_pass'] = md5($this->input->post('user_pass').$encryption_key);
      $this->authority_m->authority_update_info($array,$id);
      $this->session->set_flashdata('success', 'Successfully Updated');
      redirect(base_url('settings/settings_data'));
    }
  }
  else {
    $data['authority_info'] = $this->authority_m->get_authority_info();
    $this->load->view('dashboard_layout',$data);
  }
}
/* Close authority user function */

public function settings_data(){
  $data= [];
  $data['title'] = "Settings";
  $data['datarows']= $this->gread_point_m->get_gread_point();
  $data['authority_info'] = $this->authority_m->get_authority_info();
  $data['settings_data'] = 'settings';
  $this->load->view('dashboard_layout',$data);
}

private function do_upload(){
  $type = explode('.', $_FILES["logo_pic"]["name"]);
  $type = strtolower($type[count($type)-1]);
  $url = "./images/".uniqid(rand()).'.'.$type;
  if(in_array($type, array("jpg", "jpeg", "gif", "png")))
   if(is_uploaded_file($_FILES["logo_pic"]["tmp_name"]))
    if(move_uploaded_file($_FILES["logo_pic"]["tmp_name"],$url))
     return $url;
   return "";
 }
  // update basic informations data
 public function update_settings_data() {

  if($_POST) {
      //data validation
    $this->form_validation->set_rules('site_name','Name', 'trim|required');
    $this->form_validation->set_rules('grade_scale','Grade scale', 'trim|required|numeric');
    $this->form_validation->set_rules('contact_no','Contact no', 'trim|numeric');
    $this->form_validation->set_rules('email_address','Email address', 'trim|valid_email');

    if($this->form_validation->run()==FALSE){

      $this->session->set_flashdata('errors', 'Please fill up required (*) fields');
      redirect(base_url('settings/settings_data'));
    }
    else {
      $IMGup = $this->do_upload();
      if ($IMGup != '') {
        $attr  = array(
          'name'          => $this->input->post('site_name'),
          'tag_line'      => $this->input->post('tag_line'),
          'grade_scale'   => $this->input->post('grade_scale'),
          'contact_no'    => $this->input->post('contact_no'),
          'email_address' => $this->input->post('email_address'),
          'address'       => $this->input->post('address'),
          'site_logo'     => $IMGup,
          );
      }else {
        $attr  = array(
          'name'          => $this->input->post('site_name'),
          'tag_line'      => $this->input->post('tag_line'),
          'grade_scale'   => $this->input->post('grade_scale'),
          'contact_no'    => $this->input->post('contact_no'),
          'email_address' => $this->input->post('email_address'),
          'address'       => $this->input->post('address'),
          );
      }
      if($this->settings_m->update_settings_data($attr))
      {
        $this->session->set_flashdata('success', 'Successfully Upadated Basic Information.');
        redirect(base_url('settings/settings_data'));
      }
    }
  }
  else {
    $this->session->set_flashdata('errors', 'Basic Infornations not Updated, Please Recheck !');
    redirect(base_url('settings/settings_data'));
  }
}




/* start Grade point function*/

// insert grade point
public function add_gread_point(){
  $data = [];

  if($_POST) {
      //data validation
    $this->form_validation->set_rules('gread','Gread', 'trim|required|xss_clean|min_length[1]');
    $this->form_validation->set_rules('gread_point','Gread Point', 'trim|required|xss_clean|min_length[4]');
    $this->form_validation->set_rules('from_marks','From Mark', 'trim|required|xss_clean|min_length[2]');
    $this->form_validation->set_rules('to_marks','To Mark', 'trim|required|xss_clean|min_length[2]');
    if($this->form_validation->run()==FALSE){

      $this->session->set_flashdata('errors', 'New grade point Data is not Inserted');
      redirect(base_url('settings/settings_data'));
    }
    else {
        //Transfering data to Model
      $attr  = array(
        'gread'         => $this->input->post('gread'),
        'gread_point'  => $this->input->post('gread_point'),
        'form_mark'     => $this->input->post('from_marks'),
        'to_mark'       => $this->input->post('to_marks'),
        );
      $this->load->model('gread_point_m');
      $this->gread_point_m->insert_gread_point($attr);
      $this->session->set_flashdata('success', 'Successfully Inserted Data');
      redirect(base_url('settings/settings_data'));
    }
  }
}

// update grade point
public function update_grade_point(){
  $attr  = array(
    'gread'         => $this->input->post('grade'),
    'gread_point'   => $this->input->post('point'),
    'form_mark'     => $this->input->post('frommark'),
    'to_mark'       => $this->input->post('tomark'),
    );
  $id = $this->input->post('editID');
  if($this->gread_point_m->update_grade_point($attr, $id)){
    echo "Successfully Update";
  } else {
    echo 'error';
  }
}

// delete grade point
public function delete_gread_point($id = null){
  if($this->gread_point_m->delete_gread_point($id)){
    $this->session->set_flashdata('success', 'Successfully Deleted');
    redirect(base_url('settings/settings_data'));
  } else {
   redirect(base_url('dashboard/index'));
 }
}


// close Grade point function

}
