<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marksheet extends CI_Controller {
  //constract_function
  public function __construct(){
		parent::__construct();
		if($this->session->userdata('access') == 0 || $this->session->userdata('access') == 2 || $this->session->userdata('access') == 3 || $this->session->userdata('access') == 1)
		redirect(base_url('login/index'));
    $this->load->model('marksheet_m');
	}
  // defult load function
  public function index(){
    redirect ('dashboard/index');
  }

  public function marksheet(){
     $data= [];
     $data['title'] = "Marksheet";
     $data['marksheet']='std/marksheet/view';
     $data['get_waiver_sub'] = $this->marksheet_m->get_waiver_sub($this->session->userdata('user_id'));
     $data['get_waiver_display_id'] = $this->marksheet_m->get_display_id($this->session->userdata('user_id'));
     $data['point_table'] = $this->marksheet_m->point_table($this->session->userdata('user_id'));
     $data['get_earn_point'] = $this->marksheet_m->get_earn_point($this->session->userdata('user_id'), $null = 0);
     $data['per_sub_point'] = $this->marksheet_m->per_sub_point_table($this->session->userdata('user_id'));

     $this->load->view('dashboard_layout',$data);
  }
}
