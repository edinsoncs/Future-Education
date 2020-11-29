<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notice extends CI_Controller {
  //constract_function
  public function __construct(){
    parent::__construct();
    if($this->session->userdata('access') == 0)
      redirect(base_url('login/index'));
    $this->load->model('notice_m');
  }
  // defult load function
  public function index(){
    redirect ('dashboard/index');
  }
  // profile methode function
  public function notice(){
    if($this->session->userdata('access') == 1 || $this->session->userdata('access') == 2){
      $data= [];
      $data['title'] = "Notice";
      $data['notice_page']='notice/view';
      $data['get_data'] = $this->notice_m->get_data();
      $this->load->view('dashboard_layout',$data);
    } else {
      redirect(base_url('login/index'));
    }
  }
  // create new notice
  public function new_notice(){
    $date = date("d-M-Y");
    $this->form_validation->set_rules('note_subject','Subject', 'trim|required');
    $this->form_validation->set_rules('note_no','note no', 'trim|required');
    $this->form_validation->set_rules('note_message','Notice', 'trim|required');

    if($this->form_validation->run()==FALSE){
      $this->session->set_flashdata('errors', 'Please fill up required (*) fields');
      redirect(base_url('notice/notice'));
    }else {
      $attr = array(
        'note_no'      => $this->input->post('note_no'),
        'publish_date' => $date,
        'note_subject' => $this->input->post('note_subject'),
        'note_message' => $this->input->post('note_message'),
        );

      $this->notice_m->create_notice($attr);
      $this->session->set_flashdata('success', 'Successfully Create.');
      redirect(base_url('notice/notice'));
    }
  }


  // retrive data for view 
  public function retrive_data($id=null){
    $id = $this->input->post('noticeID');
    $sessionID = $this->input->post('sessionID');

    $get_data = $this->notice_m->get_single_notice($id);
    $html  = '';
    if(isset($get_data)){
      $html .= '<tr>';
      $html .=  '<td><b>Notice No.:</b>&nbsp;'.$get_data->note_no.'</td>';
      $html .= '</tr>';
      $html .= '<tr>';
      $html .=  '<td><b>Date:</b>&nbsp;'.$get_data->publish_date.'</td>';
      $html .= '</tr>';
      $html .= '<tr>';
      $html .=  '<td><b>Subject:</b>&nbsp;'.$get_data->note_subject.'</td>';
      $html .= '</tr>';
      $html .= '<tr>';
      $html .=  '<td>'.$get_data->note_message.'</td>';
      $html .= '</tr>';
      $html .= '<tr>';
      $html .=  '<td><br>'.'Thank You'.'</td>';
      $html .= '</tr>';
    }
    echo $html;
    
    $attr  = array('notice_no' => $id, 'user_id' => $sessionID);
    if (!count($this->notice_m->get_notification($attr))){
      $this->notice_m->countNotificationNO($attr);
    }
  }
  // rective data for notice update 
  public function retrive_data_for_update($id=null){
    if($this->input->post('noticeID')) {
      $get_data = $this->notice_m->get_single_notice($this->input->post('noticeID'));
      if(count($get_data)) {
        $json = array("confirmation" => 'success','id' => $get_data->id,'note_no' => $get_data->note_no,'note_subject' => $get_data->note_subject, 'note_message' => $get_data->note_message);
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
  // protected rulls for data update
  protected function rulesForNoticeUpdate() {
    $config = array(
      array(
       'field'   => 'note_no',
       'label'   => 'Notice No',
       'rules'   => 'required'
       ),
      array(
       'field'   => 'note_subject',
       'label'   => 'Notice Subject',
       'rules'   => 'required'
       ),
      array(
       'field'   => 'note_message',
       'label'   => 'Notice Message',
       'rules'   => 'required'
       )
      );
    return $config;
  }
  // Notice update
  public function notice_update(){   

    if($_POST){
      $this->form_validation->set_rules($this->rulesForNoticeUpdate());
      if($this->form_validation->run() == FALSE) {
        $data['validation_errors'] = $this->form_validation->verror_array();
         // $this->session->set_flashdata('success', 'aaa');
        $data['title'] = "Notice";
        $data['notice_page']='notice/view';
        $data['get_data'] = $this->notice_m->get_data();
        $this->load->view('dashboard_layout',$data);
      } else {
        $attr = array(
          'note_no'      => $this->input->post('note_no'),
          'note_subject' => $this->input->post('note_subject'),
          'note_message' => $this->input->post('note_message'),
          );

        $id = $this->input->post('id');
        
        $this->notice_m->update_notice($attr, $id);
        $this->session->set_flashdata('success', 'Successfully Update.');
        // echo "Success";

      }
    } else {
      echo 'Error';

    }
    
  }
  
  // delete notice
  public function delete_data($id = null){
   if($this->session->userdata('access') == 1 || $this->session->userdata('access') == 2){
    if($this->notice_m->delete_data($id)){
      $this->session->set_flashdata('success', 'Successfully Deleted');
      redirect(base_url('notice/notice'));
    } else {
     redirect(base_url('dashboard/index'));
   } 
 } else {
   redirect(base_url('login/index'));
 }
}

// profile methode function login for teacher
public function teachersNotice(){
  if($this->session->userdata('access') == 3 || $this->session->userdata('access') == 5){
    $data=[];
    $data['title'] = "Notice";
    $data['notice_for_teacher']='notice/t_view';
    $data['get_data'] = $this->notice_m->get_data();
    $this->load->view('dashboard_layout',$data);
  }else {
    redirect(base_url('login/index'));
  }
}
// profile methode function login for Student
public function studentNotice(){
  if($this->session->userdata('access') == 4){
    $data= [];
    $data['title'] = "Notice";
    $data['notice_for_student']='notice/std_view';
    $data['get_data'] = $this->notice_m->get_data();
    $this->load->view('dashboard_layout',$data);
  }else {
    redirect(base_url('login/index'));
  }
}

}