<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AssignSubjectCus extends CI_Controller {
  //constract_function
  public function __construct(){
    parent::__construct();
    if($this->session->userdata('access') == 0 || $this->session->userdata('access') == 3 || $this->session->userdata('access') == 4)
      redirect(base_url('login/index'));
    $this->load->model('assignSubjectCus_m');
    $this->load->model('subject_m');
  }
  // defult load function
  public function index(){
    redirect ('dashboard/index');
  }
  // profile methode function
  public function assign_subject_cus(){
    $data= [];
    $data['title'] = "Assign Subject";
    $data['assign_subject_cus']='assignSubjectCus/view';
    $data['get_data'] = $this->assignSubjectCus_m->get_assign_sub_all();
    $this->load->view('dashboard_layout',$data);
  }

  // customiz assign subject new page
  public function assign_sub_cust(){
    $data= [];
    $data['title'] = "Add Student for Assign Subject";
    $data['add_subject_cus']='assignSubjectCus/add';
    $data['get_data'] = $this->subject_m->get_data();
    $this->load->view('dashboard_layout',$data);
  }
  // rective std ID wase basic data
  public function retrive_data() {
    if($this->input->post('studentID')) {
      $studentIDinfo = $this->assignSubjectCus_m->get_single_student($this->input->post('studentID'));
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
        $json = array("confirmation" => 'error', 'message' => 'Student ID not found !');
        header("Content-Type: application/json", true);
        echo json_encode($json);
        exit;
      }
    }
  }
  // chack waiver sub
  public function chack_insert_data(){
    if($this->input->post('std_id')) {
      $studentID = $this->input->post('std_id');
      $allSubjectID = $this->input->post('ids');
      $subjects =  explode('$',$allSubjectID);
      $semester_info = $this->assignSubjectCus_m->get_semester_code($action = 0);
      if(count($semester_info)){
        if(count($subjects)) {
          foreach ($subjects as $subjectKey => $subject) {
            if($subject != "") {
              $getSubject = $this->assignSubjectCus_m->get_single_subject_list($subject);
              $errorSubject = array();
              if(count($getSubject)) {
                $getMatchForDB = $this->assignSubjectCus_m->get_student_subject_with_id($studentID, $getSubject->subject_code, $semester_info->semester_code);
                if($getMatchForDB !=''){
                  $errorSubject[] = 'This Subject -'. $getMatchForDB->sub_code .'  already exists.'."\n";
                }
              }
            }
          }
        }
      }else {
        $errorSubject[] = 'Dose Not Create New Semester Code.';
      }
      if(count($errorSubject)) {
        foreach ($errorSubject as $key => $error) {
          echo $error;
        }
      }
    }
  }

  // insert subject with std info
  public function select_stdORsub(){
    if($this->input->post('std_id')) {
      $studentinfo = $this->assignSubjectCus_m->get_single_student($this->input->post('std_id'));
      $studentID = $this->input->post('std_id');
      $allSubjectID = $this->input->post('all_ids');

      $subjects =  explode('$',$allSubjectID);

      $semester_info = $this->assignSubjectCus_m->get_semester_code($action = 0);
      if(count($semester_info)){

        if(count($subjects)) {
          foreach ($subjects as $subjectKey => $subject) {
            if($subject != "") {
              $getSubject = $this->assignSubjectCus_m->get_single_subject_list($subject);
              $errorSubject = array();
              if(count($getSubject)) {
                $getWaiverFromDB = $this->assignSubjectCus_m->get_student_subject_with_id($studentID, $getSubject->subject_code, $semester_info->semester_code);
                if(!count($getWaiverFromDB)) {
                  $setArray = array();
                  $setArray['std_display_id']   = $studentinfo->std_display_id;
                  $setArray['std_id']           = $studentinfo->std_id;
                  $setArray['std_name']         = $studentinfo->std_name;
                  $setArray['std_dept']         = $studentinfo->std_dept;
                  $setArray['std_batch']        = $studentinfo->std_batch;
                  $setArray['std_section']      = $studentinfo->std_section;
                  $setArray['semester_code']    = $semester_info->semester_code;
                  $setArray['assign_season']    = $semester_info->season_code;
                  $setArray['assign_year']      = $semester_info->year_code;
                  $setArray['action']           = '0';

                  /* Subject part start here........ */
                  $setArray['sub_code']         = $getSubject->subject_code;
                  $setArray['sub_name']         = $getSubject->subject_name;
                  $setArray['sub_credit']       = $getSubject->subject_credit;
                  /* Subject part close here........ */
                  $this->assignSubjectCus_m->insert_cust_subject($setArray);
                    // dump($setArray);
                } else {
                  $this->session->set_flashdata('success', 'Successfully Assigned ');
                }
              }
              $this->session->set_flashdata('success', 'Successfully Assigned');
            }
          }
        }
      }else {
        $errorSubject[] = 'Please Create a New Semester Code !'."\n";
      }
      if(count($errorSubject)) {
        foreach ($errorSubject as $key => $error) {
          echo $error;
        }
      }
    }
  }

    // delete waver subject
  public function delete_data($id = null){
    if($this->assignSubjectCus_m->delete_data($id)){
      $this->session->set_flashdata('success', 'Successfully Deleted');
      redirect(base_url('assignSubjectCus/assign_subject_cus'));
    }else {
      redirect(base_url('dashboard/index'));
    }
  }

    // group delete all data accroding to semester code , student ID
  public function delete_data_accroding_to_semester($id = null){
    $get_data = $this->assignSubjectCus_m->get_data_accroding_to_semester($id);
    if($this->assignSubjectCus_m->delete_group_wais_data($get_data->semester_code,$get_data->std_id)){
      $this->session->set_flashdata('success','Successfully Deleted');
      redirect(base_url('assignSubjectCus/assign_subject_cus'));
    } else {
      redirect(base_url('assignSubjectCus/assign_subject_cus'));
    }
  }

      // get view sub. list accroding to semester code
  public function get_sub_list(){
    $id = $this->input->post('getID');
    $get_data = $this->assignSubjectCus_m->get_data_accroding_to_semester($id);
    $get_alll = $this->assignSubjectCus_m->get_sub_accroding_to_semester($get_data->semester_code,$get_data->std_id);
    $html  = '';
    foreach ($get_alll as $value) {
      $html .= '<tr>';
      $html .=  '<td>'.$value->id.'</td>';
      $html .=  '<td class="uppercase">'.$value->sub_code.'</td>';
      $html .=  '<td class="capitalize">'.$value->sub_name.'</td>';
      $html .=  '<td>'.$value->sub_credit.'</td>';
      $html .=  '<td>'.'<a class="btn btn-danger btn-xs" href="'.base_url('assignSubjectCus/delete_data/'.$value->id).'">&nbsp;&nbsp;<span class="glyphicon glyphicon-trash " title="Delete" onclick="return confirm()"></span>&nbsp;&nbsp;</a>'.'</td>';
      $html .=  '</tr>';
    }
    echo $html;
  }


}
