<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends CI_Controller {
  //constract_function
  public function __construct(){
    parent::__construct();
    if($this->session->userdata('access') == 0)
      redirect(base_url('login/index'));
    $this->load->model('library_m');
  }
  // defult load function
  public function index(){
    redirect ('dashboard/index');
  }
  //  pages
  public function pages(){
    if($this->session->userdata('access') == 1 || $this->session->userdata('access') == 2 || $this->session->userdata('access') == 5){
      $data= [];
      $data['title'] = "Library";
      $data['library_page']='library/view';
      $data['get_data'] = $this->library_m->get_data();
      $this->load->view('dashboard_layout',$data);
    } else {
      redirect(base_url('login/index'));
    }
  }
  
  // Add new book
  public function add_new(){
    $date = date("d-M-Y");
    $this->form_validation->set_rules('book_name','Subject', 'trim|required');
    $this->form_validation->set_rules('writer_name','note no', 'trim|required');
    $this->form_validation->set_rules('subject_code','Subject Code', 'trim|required');
    $this->form_validation->set_rules('price','Price', 'trim|required');
    $this->form_validation->set_rules('quantity','Quentity', 'trim|required');
    $this->form_validation->set_rules('rack_no','Rack No', 'trim|required');

    if($this->form_validation->run()==FALSE){
      $this->session->set_flashdata('errors', 'Please fill up required (*) fields');
      redirect(base_url('library/pages'));
    }else {
      $attr = array(
        'book_name'    => $this->input->post('book_name'),
        'writer_name'  => $this->input->post('writer_name'),
        'subject_code' => $this->input->post('subject_code'),
        'edition'      => $this->input->post('edition'),
        'edition_year' => $this->input->post('edition_year'),
        'price'        => $this->input->post('price'),
        'quantity'     => $this->input->post('quantity'),
        'rack_no'      => $this->input->post('rack_no'),
        'add_date'     => $date,
      );
      $this->library_m->add_new($attr);
      $this->session->set_flashdata('success', 'Successfully Created.');
      redirect(base_url('library/pages'));
    }
  }

  // retrive data for view 
  public function retrive_data($id=null){
    $id = $this->input->post('getID');
    $get_data = $this->library_m->get_single_item($id);
    $html  = '';
    if(isset($get_data)){
      $html .= '<tr>';
      $html .=  '<td><b>Book Name</td><td>:</td></b><td>&nbsp;'.$get_data->book_name.'</td>';
      $html .= '</tr>';
      $html .= '<tr>';
      $html .=  '<td><b>Writer Name</td><td>:</td></b><td>&nbsp;'.$get_data->writer_name.'</td>';
      $html .= '</tr>';
      $html .= '<tr>';
      $html .=  '<td><b>Subject Code</td><td>:</td></b><td>&nbsp;'.$get_data->subject_code.'</td>';
      $html .= '</tr>';
      $html .= '<tr>';
      $html .=  '<td><b>Edition</td><td>:</td></b><td>&nbsp;'.$get_data->edition.'</td>';
      $html .= '</tr>';
      $html .= '<tr>';
      $html .=  '<td><b>Edition Year</td><td>:</td></b><td>&nbsp;'.$get_data->edition_year.'</td>';
      $html .= '</tr>';
      $html .= '<tr>';
      $html .=  '<td><b>Price</td><td>:</td></b><td>&nbsp;'.$get_data->price.'</td>';
      $html .= '</tr>';
      $html .= '<tr>';
      $html .=  '<td><b>Quantity</td><td>:</td></b><td>&nbsp;'.$get_data->quantity.'</td>';
      $html .= '</tr>';
      $html .= '<tr>';
      $html .=  '<td><b>Rack No.</td><td>:</td></b><td>&nbsp;'.$get_data->rack_no.'</td>';
      $html .= '</tr>';
      $html .= '<tr>';
      $html .=  '<td><b>Entry Date</td><td>:</td></b><td>&nbsp;'.$get_data->add_date.'</td>';
      $html .= '</tr>';
    }
    echo $html;
  }

  // retrivre data for update
  public function retrive_data_for_update($id=null){
    if($this->input->post('getID')) {
      $get_data = $this->library_m->get_single_data($this->input->post('getID'));
      if(count($get_data)) {
        $json = array(
          "confirmation" => 'success',
          'id' => $get_data->id,
          'book_name' => $get_data->book_name,
          'writer_name' => $get_data->writer_name,
          'subject_code' => $get_data->subject_code, 
          'edition' => $get_data->edition, 
          'edition_year' => $get_data->edition_year, 
          'price' => $get_data->price,
          'quantity' => $get_data->quantity,
          'rack_no' => $get_data->rack_no
          );
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
  protected function rulesForBookUpdate() {
    $config = array(
      array(
       'field'   => 'book_name',
       'label'   => 'Book Name',
       'rules'   => 'trim|required'
       ),
      array(
       'field'   => 'writer_name',
       'label'   => 'Writer Name',
       'rules'   => 'trim|required'
       ),
      array(
       'field'   => 'subject_code',
       'label'   => 'Subject Code',
       'rules'   => 'trim|required'
       ),
      array(
       'field'   => 'price',
       'label'   => 'Price',
       'rules'   => 'trim|required'
       ),
      array(
       'field'   => 'quantity',
       'label'   => 'Quantity',
       'rules'   => 'trim|required|callback_chk_issued_book'
       ),
      array(
       'field'   => 'rack_no',
       'label'   => 'Rack no.',
       'rules'   => 'trim|required'
       )
      );
    return $config;
  }
  // callback function
  public function chk_issued_book(){
    $chk_quantity = $this->input->post('quantity');
    $get_count_issue_book = $this->library_m->get_count_issue_book($this->input->post('id'))->issued;
    if ($get_count_issue_book <= $chk_quantity) {
      return TRUE;
    } 
    else
    $this->form_validation->set_message('chk_issued_book','Allready&nbsp;'.$get_count_issue_book.'&nbsp;Books are Issed !');
    return FALSE;
  }
  // Update data
  public function book_update(){   
    if($_POST){
      $this->form_validation->set_rules($this->rulesForBookUpdate());
      if($this->form_validation->run() == FALSE) {
        $validation_errors = $this->form_validation->verror_array();
        $json = array("confirmation" => 'error', 'validations' => $validation_errors);
        header("Content-Type: application/json", true);
        echo json_encode($json);
        exit;
      } else {
        $attr = array(
          'book_name'    => $this->input->post('book_name'),
          'writer_name'  => $this->input->post('writer_name'),
          'subject_code' => $this->input->post('subject_code'),
          'edition'      => $this->input->post('edition'),
          'edition_year' => $this->input->post('edition_year'),
          'price'        => $this->input->post('price'),
          'quantity'     => $this->input->post('quantity'),
          'rack_no'      => $this->input->post('rack_no'),
        );

        $array = array(
          'book_name'    => $this->input->post('book_name'),
          'writer_name'  => $this->input->post('writer_name'),
        );

        $id = $this->input->post('id');
        $this->library_m->update_data($attr, $id);
        $this->library_m->updateIssueBookName($array, $id);
        $this->session->set_flashdata('success', "Successfully Updated.");
        $json = array("confirmation" => 'Success');
        header("Content-Type: application/json", true);
        echo json_encode($json);
      }
    } else {
      $json = array("confirmation" => 'error');
      header("Content-Type: application/json", true);
      echo json_encode($json);

    }
  }


  // delete data
  public function delete_data($id = null){
    if($this->session->userdata('access') == 1 || $this->session->userdata('access') == 2 || $this->session->userdata('access') == 5){
      $chk_issue = $this->library_m->get_single_book($id);

        if (($chk_issue->issued)== NUL || ($chk_issue->issued) == 0) {
          if($this->library_m->delete_data($id)){
            $this->session->set_flashdata('success', 'Successfully Deleted');
            redirect(base_url('library/pages'));
          } else {
           redirect(base_url('dashboard/index'));
         } 
       }else {
        $this->session->set_flashdata('errors', 'Some Books are Issued!');
        redirect(base_url('library/pages'));
      }
    } else {
     redirect(base_url('login/index'));
    }
  }


  public function getBarcode(){
        $getID = $this->input->post('getID');
        $getData = $this->library_m->get_single_item($getID);
        if(count($getData)) {
          $temp = $getData->id;
          // $temps = rand(10000, 99999);
        echo $this->barcode($temp);
        }
  }

  function barcode($text){
      $this->load->library('zend');
      $this->zend->load('Zend/Barcode');

      $file = Zend_Barcode::draw('code128', 'image', array('text' => $text), array());
    $text = time().$text;
    $store_image = imagepng($file,"images/$text.png");
    return base_url('images/'.$text.'.png');
  }

 /*==========================================================================================
                              Issue & Return page script
 ==========================================================================================*/
 public function book_issue_pages(){
    if($this->session->userdata('access') == 1 || $this->session->userdata('access') == 2 || $this->session->userdata('access') == 5){
      $data= [];
      $data['title'] = "Library";
      $data['library_page']='library/issue';
      $data['issue_book'] = $this->library_m->get_issue_book();
      $this->load->view('dashboard_layout',$data);
    } else {
      redirect(base_url('login/index'));
    }
  }
  // rective std ID wase basic data
  public function retrive_std_info() {
    if($this->input->post('studentID')) {
      $studentIDinfo = $this->library_m->get_single_student($this->input->post('studentID'), $library_access = 1);
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
        $json = array("confirmation" => 'error', 'message' => 'This Student ID is not Approved !');
        header("Content-Type: application/json", true);
        echo json_encode($json);
        exit;
      }
    }
  }
  // rective book ID wise book info
  public function retrive_book_info() {
    if($this->input->post('getbookID')) {
      $bookIDinfo = $this->library_m->get_single_book($this->input->post('getbookID'));
      if ($bookIDinfo) {
          if(($bookIDinfo->quantity) == ($bookIDinfo->issued)) {
          $json = array("confirmation" => 'error', 'message' => 'Not available !');
          header("Content-Type: application/json", true);
          echo json_encode($json);
          exit;
        } else {
          $json = array(
            "confirmation" => 'success',
            'id' => $bookIDinfo->id,
            'book_name' => $bookIDinfo->book_name,
            'writer_name'=> $bookIDinfo->writer_name
          );
          header("Content-Type: application/json", true);
          echo json_encode($json);
          exit;
        }
      }else {
        $json = array("confirmation" => 'error', 'message' => 'This ID is not Exist !');
        header("Content-Type: application/json", true);
        echo json_encode($json);
        exit;
      }
      
    }
  }
  // protected rulls for issue book
  protected function rulesForIssueBook() {
    $config = array(
      array(
       'field'   => 'std_id',
       'label'   => 'Student ID',
       'rules'   => 'trim|required|callback_chk_std_id'
       ),
      array(
       'field'   => 'book_id',
       'label'   => 'Book ID',
       'rules'   => 'trim|required|callback_chk_book_id'
       ),
      array(
       'field'   => 'book_name',
       'label'   => 'Book Name',
       'rules'   => 'trim|required'
       ),
      array(
       'field'   => 'writer_name',
       'label'   => 'Writer Name',
       'rules'   => 'trim|required'
       ),
      
      array(
       'field'   => 'due_date',
       'label'   => 'Due Date',
       'rules'   => 'trim|required|callback_chk_due_date'
       )
      );
    return $config;
  }
  // callback functions....
  public function chk_std_id(){
    if($this->input->post('std_id')){
      $get_count = $this->library_m->get_single_student($this->input->post('std_id'), $library_access = '1');
      if($get_count){
        return TRUE;
      } else {
        $this->form_validation->set_message('chk_std_id','This Student ID is not Approved !');
        return FALSE;
      }
    }
  }
  public function chk_book_id(){
    if($this->input->post('book_id')) {
      $bookIDinfo = $this->library_m->get_single_book($this->input->post('book_id'));
      if ($bookIDinfo) {
          if(($bookIDinfo->quantity) == ($bookIDinfo->issued)) {
            $this->form_validation->set_message('chk_book_id','Not available !');
          return FALSE;
          } else {
            return TRUE;
          }
      } else {
        $this->form_validation->set_message('chk_book_id','This ID is not Exist !');
        return FALSE;
      }
    }
  }
  public function chk_due_date(){
    $date = strtotime(date("d-m-Y"));
    $due_date = strtotime(date($this->input->post('due_date')));
    if($date >= $due_date){
        $this->form_validation->set_message('chk_due_date','This Date not Largest !');
        return FALSE;
    }
    return TRUE;
  }
  // Add issuce book
  public function creat_issue_book(){   
    if($_POST){
      $this->form_validation->set_rules($this->rulesForIssueBook());
      if($this->form_validation->run() == FALSE) {
        $validation_errors = $this->form_validation->verror_array();
        $json = array("confirmation" => 'error', 'validations' => $validation_errors);
        header("Content-Type: application/json", true);
        echo json_encode($json);
        exit;
      } else {

        $date = date("d-m-Y");

        $bookID = $this->input->post('book_id');
        $get_count_issue_book = $this->library_m->get_count_issue_book($this->input->post('book_id'))->issued; 
        $count = $get_count_issue_book+1;
        
        $attr = array(
          'std_id'       => $this->input->post('std_id'),
          'book_id'      => $this->input->post('book_id'),
          'book_name'    => $this->input->post('book_name'),
          'writer_name'  => $this->input->post('writer_name'),     
          'issue_date'   => $date,        
          'due_date'     => $this->input->post('due_date')
        );

        $this->library_m->issue_book($attr);
        $array = array('issued' => $count);
        $this->library_m->update_issued_book($bookID,$array);

        $this->session->set_flashdata('success', "Successfully Issued.");
        $json = array("confirmation" => 'Success');
        header("Content-Type: application/json", true);
        echo json_encode($json);
      }
    } else {
      $json = array("confirmation" => 'error');
      header("Content-Type: application/json", true);
      echo json_encode($json);

    }
  }
  // Return Book script
  public function return_data($id = null){
   if($this->session->userdata('access') == 1 || $this->session->userdata('access') == 2 || $this->session->userdata('access') == 5){

    $bookID = $this->library_m->get_bookID($id)->book_id;
    $get_count_issue_book = $this->library_m->get_count_issue_book($bookID)->issued; 
    $count = $get_count_issue_book-1;
 
    $attr = array('return_type' => 1);
    $this->library_m->return_data($attr, $id);

    $array = array('issued' => $count);
    $this->library_m->update_issued_book($bookID,$array);

    $this->session->set_flashdata('success', 'Return Successfully .');
    redirect(base_url('library/book_issue_pages'));
   } else {
     redirect(base_url('login/index'));
   }
  }
  // Return Book script member details page
  public function return_details_page($id = null){
   if($this->session->userdata('access') == 1 || $this->session->userdata('access') == 2 || $this->session->userdata('access') == 5){

    $get_std_ID = $this->library_m->getStdID($id)->std_id;
    $get_std_displayid = $this->library_m->get_std_displayid($get_std_ID)->std_display_id;
    
    $bookID = $this->library_m->get_bookID($id)->book_id;
    $get_count_issue_book = $this->library_m->get_count_issue_book($bookID)->issued; 
    $count = $get_count_issue_book-1;

    $attr = array('return_type' => 1);
    $this->library_m->return_data($attr, $id);

    $array = array('issued' => $count);

    $this->library_m->update_issued_book($bookID,$array);
    $this->session->set_flashdata('success', 'Return Successfully.');
    redirect(base_url('library/details/'.$get_std_displayid));
   } else {
     redirect(base_url('login/index'));
   }
  }

// paid fine amount 
  public function paid_data($id = null){
   if($this->session->userdata('access') == 1 || $this->session->userdata('access') == 2 || $this->session->userdata('access') == 5){
    $attr = array('fine_paid'=> 1);
    $this->library_m->paid_data($attr, $id);
    $this->session->set_flashdata('success', 'Payment Successfull.');
    redirect(base_url('library'));
    } else {
     redirect(base_url('login/index'));
   }
  }



 // retrive_due_date_update 
public function retrive_due_date_update(){
  if($this->input->post('getID')) {
    $bookIDinfo = $this->library_m->get_single_issue_book($this->input->post('getID'));
    if ($bookIDinfo) {
        $json = array(
          "confirmation" => 'success',
          'id'       => $bookIDinfo->id,
          'due_date' => $bookIDinfo->due_date,
          'library_fine' => $bookIDinfo->library_fine
        );
        header("Content-Type: application/json", true);
        echo json_encode($json);
        exit;
    } else {
      $json = array("confirmation" => 'error', 'message' => 'This ID does not Exist !');
      header("Content-Type: application/json", true);
      echo json_encode($json);
      exit;
    }
  }
}
// update due date 
public function due_date_update(){   
    if($_POST){
      $this->form_validation->set_rules('due_date','Due Date', 'trim|required|callback_chk_due_date');
      if($this->form_validation->run() == FALSE) {
        $validation_errors = $this->form_validation->verror_array();
        $json = array("confirmation" => 'error', 'validations' => $validation_errors);
        header("Content-Type: application/json", true);
        echo json_encode($json);
        exit;
      } else {
        $attr = array(
          'due_date'  => $this->input->post('due_date'),
        );
        $id = $this->input->post('id');
        $this->library_m->update_due_date($attr, $id);
        $this->session->set_flashdata('success', "Successfully Updated.");
        $json = array("confirmation" => 'Success');
        header("Content-Type: application/json", true);
        echo json_encode($json);
      }
    } else {
      $json = array("confirmation" => 'error');
      header("Content-Type: application/json", true);
      echo json_encode($json);

    }
}

// add fine amount
public function add_fine_amount(){
  if($_POST){
    $this->form_validation->set_rules('library_fine','Fine Amount', 'trim|required');
    if($this->form_validation->run() == FALSE) {
      $validation_errors = $this->form_validation->verror_array();
      $json = array("confirmation" => 'error', 'validations' => $validation_errors);
      header("Content-Type: application/json", true);
      echo json_encode($json);
      exit;
    } else {
      
      $addFine =$this->input->post('library_fine');
      if ($addFine == 0) {
        $post_fine = NULL;
      }else {
        $post_fine = $addFine;
      }

      $attr = array('library_fine' => $post_fine);
      $id = $this->input->post('id');
      $this->library_m->update_due_date($attr, $id);
      $this->session->set_flashdata('success', "Successfully Updated.");
      $json = array("confirmation" => 'Success');
      header("Content-Type: application/json", true);
      echo json_encode($json);
    }
  } else {
    $json = array("confirmation" => 'error');
    header("Content-Type: application/json", true);
    echo json_encode($json);

  }
  
}

 /*===========================================================================
                             mambers page script
 ===========================================================================*/
// mamber pages 
public function members(){
    if($this->session->userdata('access') == 1 || $this->session->userdata('access') == 2 || $this->session->userdata('access') == 5){
      $data= [];
      $data['title'] = "Library_Members";
      $data['library_page']='library/members';
      $data['get_info'] = $this->library_m->get_members();
      $this->load->view('dashboard_layout',$data);
    } else {
      redirect(base_url('login/index'));
    }
  }

// deactivate function
public function deactivate($display_id = null){
  $array = array('library_access' => 0);
  $this->library_m->update_activate_info($array,$display_id);
  redirect(base_url('library/members'));
}
// deactivate function
public function activate($display_id = null){
  $chkBefore = $this->library_m->chkBeforeActive($display_id);
  if ((($chkBefore->access_type) == 4) && (($chkBefore->std_complete_graduation) == 0)) {
    $array = array('library_access' => 1);
    $this->library_m->update_activate_info($array,$display_id);
    redirect(base_url('library/members'));
  } else {
    $this->session->set_flashdata('errors', 'This Student ID is not Active !');
    redirect(base_url('library/members'));
  }
}


public function details($std_display_id = null){
  if($this->session->userdata('access') == 1 || $this->session->userdata('access') == 2 || $this->session->userdata('access') == 5){
  if ($this->library_m->get_stdID($std_display_id)) {
    $data= [];
    $data['title'] = "Library_Members";
    $data['library_page']='library/details';
    // $data['std_info'] = $this->library_m->get_stdID($std_display_id);
    $data['issue_book'] = $this->library_m->get_issue_book_by_stdID($this->library_m->get_stdID($std_display_id)->std_id);
    $this->load->view("dashboard_layout",$data);
  } else {
    redirect(base_url('library/members'));
    }
  } else {
    redirect(base_url('login/index'));
  }

}

  // student access type
  public function library_details(){
    if($this->session->userdata('access') == 4){
    if ($this->library_m->get_stdID($this->session->userdata('user_id'))) {
      $data= [];
      $data['title'] = "Library Details";
      $data['library_page']='std/library';
      $data['issue_book'] = $this->library_m->get_issue_book_by_stdID($this->library_m->get_stdID($this->session->userdata('user_id'))->std_id);
      $this->load->view("dashboard_layout",$data);
    } else {
      redirect(base_url('library/members'));
      }
    } else {
      redirect(base_url('login/index'));
    }
  }

//===============================================================================
//                            library clearance
//===============================================================================

// retrive data for view 
  public function clearance_data($id= null){
    $id = $this->input->post('getID');
    $get_data = $this->library_m->get_stdID($id);
    $issulist = $this->library_m->get_issue_book_by_stdID($get_data->std_id);
    $check_returnType = $this->library_m->check_clearance( $return_type = NULL, $get_data->std_id);
    $check_returnDueType = $this->library_m->check_due_clearance( $return_type = 1, $get_data->std_id);


    $html  = '';
    if (($get_data->library_access) == 1 ) {
      if (!count($issulist)){
        $html .= '<tr>';
        $html .=  '<td><b>Name</td><td>:</td></b><td>&nbsp;'.$get_data->std_name.'</td>';
        $html .= '<tr>';
        $html .= '</tr>';
        $html .=  '<td><b>ID</td><td>:</td></b><td>&nbsp;'.$get_data->std_id.'</td>';
        $html .= '</tr>';
        $html .= '<tr >';
        $html .=  '<td colspan="3" class="text-center" style="border:1px solid#cccccc; padding:15px"><b>This Memeber never issued anything!</b></td>';
        $html .= '</tr>';
      } else {
        if(isset($get_data)){
          $html .= '<tr>';
          $html .=  '<td><b>Name</td><td>:</td></b><td>&nbsp;'.$get_data->std_name.'</td>';
          $html .= '<tr>';
          $html .= '</tr>';
          $html .=  '<td><b>ID</td><td>:</td></b><td>&nbsp;'.$get_data->std_id.'</td>';
          $html .= '</tr>';
          if(count($check_returnType)){
            if (($check_returnType->library_fine) != NULL && ($check_returnType->fine_paid) == NULL) {
              $html .= '<tr >';
              $html .=  '<td colspan="3" class="text-center" style="border:1px solid#cccccc; padding:15px"><b>Books and penalty due! </b></td>';
              $html .= '</tr>';
            }else {
              $html .= '<tr>';
              $html .=  '<td colspan="6" class="text-center" style="border:1px solid#cccccc; padding:15px"><b>Books due!</b></td>';
              $html .= '</tr>';
            }
          } elseif(count($check_returnDueType)){
            if (($check_returnDueType->library_fine) != NULL && ($check_returnDueType->fine_paid) == NULL) {
              $html .= '<tr>';
              $html .=  '<td colspan="3" class="text-center"  style="border:1px solid#cccccc; padding:15px"><b>Fines due but no Book. </b></td>';
              $html .= '</tr>';
            }else {  
              $html .= '<tr >';
              $html .=  '<td colspan="3" class="text-center" style="border:1px solid#cccccc; padding:15px"><b>Clear of everything </b></td>';
              $html .= '</tr>';
            }
          }
        }  
      } 
    }else {
      if(isset($get_data)){
        $html .= '<tr>';
        $html .=  '<td><b>Name</td><td>:</td></b><td>&nbsp;'.$get_data->std_name.'</td>';
        $html .= '<tr>';
        $html .= '</tr>';
        $html .=  '<td><b>ID</td><td>:</td></b><td>&nbsp;'.$get_data->std_id.'</td>';
        $html .= '</tr>';
        $html .= '<tr >';
        $html .=  '<td colspan="3" class="text-center" style="border:1px solid#cccccc; padding:15px"><b>This ID is not a Library Member!</b></td>';
        $html .= '</tr>';
      }
      
    }
    echo $html;
  }
  

}