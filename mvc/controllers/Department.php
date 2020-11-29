<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {
  //constract_function
  public function __construct(){
    parent::__construct();
    if($this->session->userdata('access') == 0 || $this->session->userdata('access') == 3 || $this->session->userdata('access') == 4)
      redirect(base_url('login/index'));
    $this->load->model('department_m');
  }
  // defult load function
  public function index(){
    redirect ('dashboard/index');
  }
    // profile methode function
  public function department(){
    $data= [];
    $data['title'] = "Department";
    $data['dept_info']='dept/view';
      // get department data
    $data['get_data'] = $this->department_m->get_data();
    $this->load->view('dashboard_layout',$data);
  }

    // rules for department
  protected function rulesForDepatment() {
    $config = array(

      array(
       'field'   => 'dept_name',
       'label'   => 'Department full Name',
       'rules'   => 'required|callback_check_duplicate_name'
       ),
      array(
       'field'   => 'dept_sort_name',
       'label'   => 'Department Nickname',
       'rules'   => 'required|callback_check_duplicate_sortName'
       )
      );
    return $config;
  }
    // callback function
  public function check_duplicate_name($dept_name)
  {
    if ($this->department_m->checkDuplicateName($dept_name)!= TRUE) {
      $this->session->set_flashdata('errors','Department Name Already Exists');
      redirect(base_url('department/department'));
      return FALSE;
    }
    return TRUE;
  }
  public function check_duplicate_sortName($dept_sort_name)
  {
    if ($this->department_m->checkDuplicateRoll($dept_sort_name)!= TRUE) {
      $this->session->set_flashdata('errors','Department Code Already Exists');
      redirect(base_url('department/department'));
      return FALSE;
    }
    return TRUE;
  }
    // Add New department
  public function department_add(){
    if($_POST) {
        // dump_exit($this->encryption);
      $this->form_validation->set_rules($this->rulesForDepatment());
      if($this->form_validation->run() == FALSE) {
        $data['validation_errors'] = $this->form_validation->verror_array();
        $data['get_data'] = $this->department_m->get_data();
        $data['dept_info'] = 'dept/view';
        $this->load->view('dashboard_layout',$data);
      } else {
        $array = array();
        $getrules = $this->rulesForDepatment();

        foreach ($getrules as $key => $value) {
          $array[$value['field']] = $this->input->post($value['field']);

        }
        $this->department_m->add_new_dept($array);
        $this->session->set_flashdata('success', 'Successfully Created a New Department');
        redirect(base_url('department/department'));
      }
    } else {
      $data['dept_info'] = 'dept/view';
      $this->load->view('dashboard_layout',$data);
    }
  }

    // delete department
  public function delete_data($id = null){
    if($this->department_m->delete_data($id)){
      $this->session->set_flashdata('success', 'Successfully Deleted');
      redirect(base_url('department/department'));
    } else {
     redirect(base_url('dashboard/index'));
   }
 }

    // retrive data
 public function retrive_data($id=null){
  if($this->input->post('departmentID')) {
    $department = $this->department_m->get_single_department($this->input->post('departmentID'));
    if(count($department)) {
      $json = array("confirmation" => 'success','id' => $department->id,'dept_name' => $department->dept_name, 'dept_sort_name' => $department->dept_sort_name);
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

    //   protected rulls for data update
protected function rulesForDepatmentUpdate() {
  $config = array(
    array(
     'field'   => 'dept_name',
     'label'   => 'Department full Name',
     'rules'   => 'required'
     ),
    array(
     'field'   => 'dept_sort_name',
     'label'   => 'Department Nickname',
     'rules'   => 'required'
     )
    );
  return $config;
}

    // update department info
public function dept_update(){
  if($_POST) {
    $this->form_validation->set_rules($this->rulesForDepatmentUpdate());
    if($this->form_validation->run() == FALSE) {
      $data['validation_errors'] = $this->form_validation->verror_array();
      $data['get_data'] = $this->department_m->get_data();
      $data['dept_info'] = 'dept/view';
      $this->load->view('dashboard_layout',$data);
    } else {

      $array= array(
       'dept_name'      => $this->input->post('dept_name'),
       'dept_sort_name' => $this->input->post('dept_sort_name'),
       );

      $id = $this->input->post('id');
      if ($this->department_m->update_dept($array, $id)) {
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
