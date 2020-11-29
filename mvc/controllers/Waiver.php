<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Waiver extends CI_Controller {
    //constract_function
  public function __construct(){
    parent::__construct();
    if($this->session->userdata('access') == 0 || $this->session->userdata('access') == 3 || $this->session->userdata('access') == 4)
      redirect(base_url('login/index'));
    $this->load->model('waiver_m');
    $this->load->model('subject_m');
  }
    // defult load function
  public function index(){
    redirect ('dashboard/index');
  }
    // profile methode function
  public function waivers(){
    $data= [];
    $data['title'] = "Waiver";
    $data['waiver_data'] = 'waiver/view';
    $data['waiver_info'] = $this->waiver_m->get_waiver();
    $this->load->view('dashboard_layout',$data);
  }
    // abb waiver page
  public function addWaivers(){
    $data= [];
    $data['title'] = "Add Waiver";
    $data['add_waiver'] = 'waiver/add';
    $data['get_data'] = $this->subject_m->get_data();

    $this->load->view('dashboard_layout',$data);
  }
    // rective std ID wase basic data
  public function retrive_data() {

    if($this->input->post('studentID')) {
      $studentIDinfo = $this->waiver_m->get_single_student($this->input->post('studentID'));
      if($studentIDinfo) {
        $json = array(
          "confirmation" => 'success',
          'std_name' => $studentIDinfo->std_name,
          'std_dept'=> $studentIDinfo->std_dept,
          'std_batch'=> $studentIDinfo->std_batch,
          'std_section'=> $studentIDinfo->std_section,
          'std_display_id'=>$studentIDinfo->std_display_id
          );
        header("Content-Type: application/json", true);
        echo json_encode($json);
        exit;
      } else {
        $json = array("confirmation" => 'error', 'message' => 'Student ID not found.');
        header("Content-Type: application/json", true);
        echo json_encode($json);
        exit;
      }
    }
  }
    // chack waiver sub
  public function chack_waiver_data(){
    if($this->input->post('std_id')) {
      $studentID = $this->input->post('std_id');
      $allSubjectID = $this->input->post('ids');
      $subjects =  explode('$',$allSubjectID);
      if(count($subjects)) {
        foreach ($subjects as $subjectKey => $subject) {
          if($subject != "") {
            $getSubject = $this->waiver_m->get_single_subject_list($subject);
            $errorSubject = array();
            if(count($getSubject)) {
              $getMatchForDB = $this->waiver_m->get_match($getSubject->subject_code,$studentID);
                // dd($getMatchForDB);
              if($getMatchForDB !=''){
                $errorSubject[] = 'The Subject -'. $getMatchForDB->sub_code .' already exists.'."\n";
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
  }
    // insert waiver subject with std info
  public function select_stdORsub(){
    if($this->input->post('std_id')) {
      $studentinfo = $this->waiver_m->get_single_student($this->input->post('std_id'));
      $studentID = $this->input->post('std_id');
      $allSubjectID = $this->input->post('all_ids');
      $subjects =  explode('$',$allSubjectID);

      if(count($subjects)) {
        foreach ($subjects as $subjectKey => $subject) {
          if($subject != "") {
            $getSubject = $this->waiver_m->get_single_subject_list($subject);
            $errorSubject = array();
            if(count($getSubject)) {
              $getWaiverFromDB = $this->waiver_m->get_student_subject_with_id($studentID, $getSubject->subject_code);
              if(!count($getWaiverFromDB)) {
                $setArray = array();
                $setArray['std_display_id']   = $studentinfo->std_display_id;
                $setArray['std_id']           = $studentinfo->std_id;
                $setArray['std_name']         = $studentinfo->std_name;
                $setArray['std_dept']         = $studentinfo->std_dept;
                $setArray['std_batch']        = $studentinfo->std_batch;
                $setArray['std_section']      = $studentinfo->std_section;
                  // $setArray['action']           = '2';

                /* Subject part start here........ */
                $setArray['sub_code']         = $getSubject->subject_code;
                $setArray['sub_name']         = $getSubject->subject_name;
                $setArray['sub_credit']       = $getSubject->subject_credit;
                /* Subject part close here........ */
                $this->waiver_m->insert_waiver($setArray);
                  // dump($setArray);
              } else {
                $this->session->set_flashdata('success', 'Waiver Successfully set ');
              }
            }
            if(count($errorSubject)) {
              foreach ($errorSubject as $key => $error) {
                echo $error;
              }
            }
            $this->session->set_flashdata('success', 'Waiver Successfully set');
          }
        }
      }
    }
  }
    // delete waver subject
  public function delete_data($id = null){
    if($this->waiver_m->delete_data($id)){
      $this->session->set_flashdata('success', 'Successfully Deleted ');
      redirect(base_url('waiver/waivers'));
    } else {
     redirect(base_url('dashboard/index'));
   }
 }

 /* === get view student wase waiver subject  === */

// get view waiver sub. list accroding to student ID
 public function get_sub_list(){
  $id = $this->input->post('getID');
  $get_data = $this->waiver_m->get_data_accroding_to_id($id);
  $get_alll = $this->waiver_m->get_sub_accroding_to_std_display_id($get_data->std_display_id);

  $html  = '';
  foreach ($get_alll as $value) {
    $html .= '<tr>';
    $html .=  '<td>'.$value->id.'</td>';
    $html .=  '<td class="uppercase">'.$value->sub_code.'</td>';
    $html .=  '<td class="capitalize">'.$value->sub_name.'</td>';
    $html .=  '<td>'.$value->sub_credit.'</td>';
    $html .=  '<td>'.'<a class="btn btn-danger btn-xs" href="'.base_url('waiver/delete_data/'.$value->id).'">&nbsp;&nbsp;<span class="glyphicon glyphicon-trash" title="Delete" onclick="return confirm()"></span>&nbsp;&nbsp;</a>'.'</td>';
    $html .=  '</tr>';
  }
  echo $html;
}

// student id wase delete all subect 
public function delete_all_data($id = null){
  $get_data = $this->waiver_m->get_data_accroding_to_id($id);
  if($this->waiver_m->delete_group_wais_data($get_data->std_display_id)){
    $this->session->set_flashdata('success', 'Deleted Successfully');
    redirect(base_url('waiver/waivers'));
  } else {
   redirect(base_url('waiver/waivers'));
 }
}


}
