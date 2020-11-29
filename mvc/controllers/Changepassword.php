<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Changepassword extends CI_Controller {
  //constract_function
  public function __construct(){
		parent::__construct();
		if($this->session->userdata('access') == 0 || $this->session->userdata('access') == 1)
		redirect(base_url('login/index'));
    $this->load->model('changepassword_m');
	}
  // defult load function
  public function index(){
    redirect ('dashboard/index');
  }
  // profile methode function
  public function changepassword(){
    $data= [];
    $data['title'] = "Change Password";
    $data['changepassword']='changepassword/view';
    $this->load->view('dashboard_layout',$data);
  }
  // calback function
  public function chkpassword(){
    $current_password = md5($this->input->post('current_password'));
    $chk = $this->changepassword_m->chackpassword($this->session->userdata('user_id'));
    if ($current_password != $chk->user_pass) {
      $this->form_validation->set_message('chkpassword','Password does not match !');
      return FALSE;
    }
    return TRUE;
  }
  // change password set query
  public function newpassword($id){
    $new_password = md5($this->input->post('new_password'));
    if($_POST){
      $this->form_validation->set_rules('current_password','current password','trim|required|callback_chkpassword');
      $this->form_validation->set_rules('new_password','new password','trim|required|md5');
      $this->form_validation->set_rules('rective_password','rective password','trim|required|matches[new_password]|md5');
      if($this->form_validation->run() == FALSE) {
        $data= [];
        $data['title'] = "Change Password";
        $data['validation_errors'] = $this->form_validation->verror_array();
        $data['changepassword']='changepassword/view';
        $this->load->view('dashboard_layout',$data);
      } else {
          $attr = array(
            'user_pass' => $new_password,
          );
          // dump_exit($attr);
          $this->changepassword_m->updatePassword($attr,$this->session->userdata('user_id'));
          $this->session->set_flashdata('success', 'You have Successfully Changed Your Password.');
          redirect(base_url('dashboard'));
       }
     }
   }

}
