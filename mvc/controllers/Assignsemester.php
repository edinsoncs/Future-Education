<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assignsemester extends CI_Controller {
  //constract_function
  public function __construct(){
    parent::__construct();
    if($this->session->userdata('access') == 0 || $this->session->userdata('access') == 3 || $this->session->userdata('access') == 4)
      redirect(base_url('login/index'));
    $this->load->model('assignsemester_m');
    $this->load->model('subject_m');
  }
  // defult load function
  public function index(){
    redirect ('dashboard/index');
  }
  // profile methode function
  public function assign_semester(){
    $data= [];
    $data['title'] = "Assign Semester";
    $data['assign_semester']='assignsemester/view';
    $data['get_all_data']=$this->assignsemester_m->get_all_assign_semester();
    $this->load->view('dashboard_layout',$data);
  }
  // goto add new page
  public function add_semester(){
    $get_semester_code = 0;
    if (count($get_semester_code)) {
      $get_semester_code = $this->assignsemester_m->get_semester_code();
    }

    $data= [];
    $data['title'] = "Create a New Semester";
    $data['add_semester']='assignsemester/add';
    $data['get_dept'] = $this->assignsemester_m->get_dept();
    $data['get_batch'] = $this->assignsemester_m->get_batch();
    $data['get_section'] = $this->assignsemester_m->get_section();
    $data['get_data'] = $get_semester_code;
    $data['get_subject_list'] = $this->subject_m->get_data();
    $this->load->view('dashboard_layout',$data);

  }
  /* set insert semester code rules */
  protected function rulesForAssignSemesterCode() {
    $config = array(
      array(
       'field'   => 'season_code',
       'label'   => 'Season Code',
       'rules'   => 'required|callback_uinque_season_code'
       ),
      array(
       'field'   => 'year_code',
       'label'   => 'Year Code',
       'rules'   => ''
       )
      );
    return $config;
  }
 // callback function
  function uinque_season_code() {
   if($this->input->post('season_code') == 0) {
     $this->form_validation->set_message('uinque_season_code','Please Select Semester');
     return FALSE;
   }
   return TRUE;
 }
  // set insert semester code
 public function set_semester_code(){

  if($_POST) {
    $this->form_validation->set_rules($this->rulesForAssignSemesterCode());
    if($this->form_validation->run() == FALSE) {
      $data['validation_errors'] = $this->form_validation->verror_array();
      $data['add_semester']='assignsemester/add';
      $data['get_dept'] = $this->assignsemester_m->get_dept();
      $data['get_batch'] = $this->assignsemester_m->get_batch();
      $data['get_section'] = $this->assignsemester_m->get_section();
      $data['get_data'] = $this->assignsemester_m->get_semester_code();
      $data['get_subject_list'] = $this->subject_m->get_data();
      $data['get_all_data']=$this->assignsemester_m->get_all_assign_semester();
      $this->load->view('dashboard_layout',$data);
    } else {
      $array = array();
      $getrules = $this->rulesForAssignSemesterCode();

      foreach ($getrules as $key => $value) {
        $array[$value['field']] = $this->input->post($value['field']);

      }
      if ($this->input->post('season_code')==1) {
        $array['season_code'] = 'Spring';
      }elseif($this->input->post('season_code')==2) {
        $array['season_code'] = 'Summer';
      }else{
        $array['season_code'] = 'Fall';
      }
      $array['year_code'] = date("Y");
      $year = $this->input->post('year_code');
      $season = $this->input->post('season_code');
      $semester_code = $year.$season;
      $array['semester_code'] = $semester_code;
      $array['action'] = 0;

      $getSemesterCodeFromDB = $this->assignsemester_m->chacking_semester_code($semester_code);

      if(!count($getSemesterCodeFromDB)){
        $this->assignsemester_m->create_semester_code($array);
        $this->session->set_flashdata('success', 'Successfully Created a New semester Code');
        redirect(base_url('assignsemester/add_semester'));
      }else {
        $this->session->set_flashdata('errors','Semester Code Already Exits');
        redirect(base_url('assignsemester/add_semester'));
      }
    }
  } else {
    $data['add_semester']='assignsemester/view';
    $data['get_all_data']=$this->assignsemester_m->get_all_assign_semester();
    $this->load->view('dashboard_layout',$data);
  }

}
  //  chack befor insert semester subject
public function chack_assign_sub(){
  $semester_code = $this->input->post('semester_code');
  $std_dept      = $this->input->post('std_dept');
  $std_batch     = $this->input->post('std_batch');
  $std_section   = $this->input->post('std_section');
  $allSubjectID = $this->input->post('ids');
  $subjects =  explode('$',$allSubjectID);
  if(count($subjects)) {
    foreach ($subjects as $subjectKey => $subject) {
      if($subject != "") {
        $getSubject = $this->assignsemester_m->get_single_subject_list($subject);
        $errorSubject = array();
        if(count($getSubject)) {
          $getMatchForDB = $this->assignsemester_m->get_match($semester_code, $std_dept, $std_batch, $std_section, $getSubject->subject_code);
          if($getMatchForDB !=''){
            $errorSubject[] = 'The '. $getMatchForDB->assign_sub_code .' Subject Already Exists in Running Semester('. $getMatchForDB->assign_semester_code .') of Batch-'.$getMatchForDB->assign_batch.', Section-'.$getMatchForDB->assign_section."\n";
          }
        }
        if(count($errorSubject)) {
          foreach ($errorSubject as $key => $error) {
            echo $error;
          }
        }
      }
    }
  }
}
  // insert Assign Semester.......
public function insert_assign_semester(){

  $semester_code = $this->input->post('semester_code');
  $std_dept      = $this->input->post('std_dept');
  $std_batch     = $this->input->post('std_batch');
  $std_section   = $this->input->post('std_section');
  $reg_from_date = $this->input->post('reg_from_date');
  $reg_to_date   = $this->input->post('reg_to_date');
  $allSubjectID  = $this->input->post('all_ids');
  $subjects =  explode('$',$allSubjectID);
  if(count($subjects)) {
    foreach ($subjects as $subjectKey => $subject) {
      if($subject != "") {
        $getSubject = $this->assignsemester_m->get_single_subject_list($subject);
        $errorSubject = array();
        if(count($getSubject)) {
          $getMatchForDB = $this->assignsemester_m->get_match($semester_code, $std_dept, $std_batch, $std_section, $getSubject->subject_code);
          if(!count($getMatchForDB)) {
            $setArray = array();
            $setArray['assign_semester_code']   = $semester_code;
            $setArray['assign_dept']            = $std_dept;
            $setArray['assign_batch']           = $std_batch;
            $setArray['assign_section']         = $std_section;
            $setArray['assign_reg_start_date']  = $reg_from_date;
            $setArray['assign_reg_close_date']  = $reg_to_date;

            /* Subject part start here........ */
            $setArray['assign_sub_code']         = $getSubject->subject_code;
            $setArray['assign_sub_name']         = $getSubject->subject_name;
            $setArray['assign_sub_cread']        = $getSubject->subject_credit;
            /* Subject part close here........ */

            $this->assignsemester_m->insert_assign_semester($setArray);
                // dd($setArray);
          } else {
            $this->session->set_flashdata('success', 'Successfully Assigned Semester');
          }
        }
        if(count($errorSubject)) {
          foreach ($errorSubject as $key => $error) {
            echo $error;
          }
        }
        $this->session->set_flashdata('success', 'Successfully Assigned Semester');
      }
    }
  }
}
  // delete single data
public function delete_data($id = null) {
  if((int) $id) {
    $this->assignsemester_m->delete_data($id);
    $this->session->set_flashdata('success', 'Deleted Successfully ');
    redirect(base_url('assignsemester/assign_semester'));
  } else {
    redirect(base_url('assignsemester/assign_semester'));
  }
}

  // delete all data accroding to semester code , batch, dept, section
public function delete_data_accroding_to_semester($id = null){
  $get_data = $this->assignsemester_m->get_data_accroding_to_semester($id);
  if($this->assignsemester_m->delete_group_wais_data($get_data->assign_semester_code,$get_data->assign_dept,$get_data->assign_batch,$get_data->assign_section)){
    $this->session->set_flashdata('success', 'Deleted Successfully');
    redirect(base_url('assignsemester/assign_semester'));
  } else {
   redirect(base_url('assignsemester/assign_semester'));
 }
}

  // get view sub. list accroding to semester code
public function get_sub_list(){
  $id = $this->input->post('getID');
  $get_data = $this->assignsemester_m->get_data_accroding_to_semester($id);
  $get_alll = $this->assignsemester_m->get_sub_accroding_to_semester($get_data->assign_semester_code,$get_data->assign_dept,$get_data->assign_batch,$get_data->assign_section);
  $html  = '';
  foreach ($get_alll as $value) {
    $html .= '<tr>';
    $html .=  '<td>'.$value->id.'</td>';
    $html .=  '<td class="uppercase">'.$value->assign_sub_code.'</td>';
    $html .=  '<td class="capitalize">'.$value->assign_sub_name.'</td>';
    $html .=  '<td>'.$value->assign_sub_cread.'</td>';
    $html .=  '<td>'.'<a class="btn btn-danger btn-xs" href="'.base_url('assignsemester/delete_data/'.$value->id).'">&nbsp;&nbsp;<span class="glyphicon glyphicon-trash" title="Delete" onclick="return confirm()"></span>&nbsp;&nbsp;</a>'.'</td>';
    $html .=  '</tr>';
  }
  echo $html;
}

function getEditDateData() {
  $id = $this->input->post('updateID');
  if((int)$id){
    $get_data = $this->assignsemester_m->get_data_accroding_to_semester($id);
    if(count($get_data)) {
      $json = array("confirmation" => 'success','id' => $get_data->id, 'assign_reg_start_date' =>$get_data->assign_reg_start_date, 'assign_reg_close_date' => $get_data->assign_reg_close_date);
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

  // Date Update
public function updateDate(){

  $id = $this->input->post('id');
  $fromDate = $this->input->post('fromDate');
  $ToDate   = $this->input->post('toDate');
  $get_data = $this->assignsemester_m->get_data_accroding_to_semester($id);
  if($id){
    $attr = array(
     'assign_reg_start_date' => $fromDate,
     'assign_reg_close_date' => $ToDate,
     );
    $this->assignsemester_m->update_DATE($attr, $get_data->assign_semester_code,$get_data->assign_dept,$get_data->assign_batch,$get_data->assign_section);
    $this->session->set_flashdata('success', 'Date Updated Successfully !');
    echo "Success";
  } else {
    echo 'Error';
  }
}


}
