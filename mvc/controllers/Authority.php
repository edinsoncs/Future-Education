<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authority extends CI_Controller {
  //constract_function
  public function __construct(){
		parent::__construct();
		if($this->session->userdata('access') == 0 || $this->session->userdata('access') == 2 || $this->session->userdata('access') == 3 || $this->session->userdata('access') == 4)
		redirect(base_url('login/index'));
    $this->load->model('Authority_m');
	}
  // defult load function
  public function index(){
    redirect ('dashboard/index');
  }
    // profile methode function
    public function authority_add(){
      $data= [];
      $data['authority_data'] = 'authority';
      $data['authority_info'] = $this->Authority_m->get_authority_info();
      $this->load->view('dashboard_layout',$data);
    }

    // edit authority page
    public function retrive_authority_data($id = null){

      if ($this->Authority_m->user_retrive_info($id)) {
      $data= [];
      $data['title'] = "Update Athority Informations";
      $data['edit_authority_data'] = 'authority/edit';
      $data['authority_info'] = $this->Authority_m->user_retrive_info($id);
      $this->load->view('dashboard_layout',$data);

      }
      else {
          redirect(base_url('settings/settings_data'));
      }
    }

    // Delete Authority user
    public function delete_authorized_user($id = null){

      if($id != 1){

      if($this->Authority_m->delete_authorized_user($id)){
         $this->session->set_flashdata('success', 'Successfully Deleted');
        redirect(base_url('settings/settings_data'));
       }
      else {
       redirect(base_url('dashboard/index'));
      }
    }else {
      $this->session->set_flashdata('errors', 'This USER cannot be Deleted !');
      redirect(base_url('settings/settings_data'));
    }




    }

}
