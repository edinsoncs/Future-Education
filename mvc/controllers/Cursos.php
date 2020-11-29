<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos extends CI_Controller {
  //constract_function
  public function __construct(){
    parent::__construct();
    if($this->session->userdata('access') == 0)
      redirect(base_url('login/index'));
    //$this->load->model('notice_m');
  }
  // defult load function
  public function create(){
    var_dump('ok');
  }
  

}