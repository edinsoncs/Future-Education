<?php

if (!function_exists('dump')) {
  function dump ($var, $label = 'Dump', $echo = TRUE)
  {
    ob_start();
    var_dump($var);
    $output = ob_get_clean();

        // Add formatting
    $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
    $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';

    if ($echo == TRUE) {
      echo $output;
    }
    else {
      return $output;
    }
  }
}


if (!function_exists('dd')) {
  function dd($var, $label = 'Dump', $echo = TRUE) {
    dump ($var, $label, $echo);
    exit;
  }
}

// for user name
function getLoginUserName() {
 $CI =& get_instance();
 $query = $CI->db->get_where('msit_tb_user', array('id' => $CI->session->userdata('loginID')));
 echo $query->row()->user_full_name;
}
// for user id
function getLoginUserID() {
 $CI =& get_instance();
 $query = $CI->db->get_where('msit_tb_user', array('id' => $CI->session->userdata('loginID')));
 echo $query->row()->id;
}

// for mex authority user id
function maxUserID() {
 $CI =& get_instance();
 $query = $CI->db->select_max('user_id')->get('msit_tb_user');
 echo $query->row()->user_id+1;
}

// for basic information
function getSite() {
 $CI =& get_instance();
 $query = $CI->db->get('msit_tb_settings');
 return $query->row();
}

// for view btn
function view($link) {
  echo anchor($link, '&nbsp;&nbsp;<span class="glyphicon glyphicon-eye-open" title="View"></span>&nbsp;&nbsp;', array('class' => "btn btn-success btn-xs"));
}

// for publish btn
function publish($link) {
  echo anchor($link, 'Publish&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-send"></span>', array('class' => "btn btn-default"));
}

// for withdrow btn
function withdraw($link) {
  echo anchor($link, 'Withdraw&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-send"></span>', array('class' => "btn btn-default"));
}

// for edit btn
function edit($link) {
  echo anchor($link, '&nbsp;&nbsp;<span class="glyphicon glyphicon-edit" title="Edit"></span>&nbsp;&nbsp;', array('class' => "btn btn-info btn-xs"));
}

// for delete btn
function del($link) {
  echo anchor($link, '&nbsp;&nbsp;<span class="glyphicon glyphicon-trash" title="Delete"></span>&nbsp;&nbsp;', array('class' => "btn btn-danger btn-xs",'onclick'=>"return confirm('are you sure ?')"));
}
// for return book btn
function ret($link) {
  echo anchor($link, '&nbsp;&nbsp;<span class="glyphicon glyphicon-retweet" title="Return Book"></span>&nbsp;&nbsp;', array('class' => "btn btn-primary btn-xs",'onclick'=>"return confirm('are you sure ?')"));
}
// department edit btn
function edited($link) {
  echo  "<button id='".$link."' data-toggle='modal' data-target='#dept_Update' title='Edit' class='btn btn-info btn-xs editActionButtonClick'>&nbsp;&nbsp;<span class='glyphicon glyphicon-edit'></span>&nbsp;&nbsp;</button>";
}
// subject edit btn
function sub_edit($link) {
  echo  "<button id='".$link."' data-toggle='modal' data-target='#sub_Update' title='Edit' class='btn btn-info btn-xs subEditActionButton'>&nbsp;&nbsp;<span class='glyphicon glyphicon-edit'></span>&nbsp;&nbsp;</button>";
}

// view semester offer subject button
function view_all_sub($link) {
  echo  "<button id='".$link."' data-toggle='modal' data-target='#view_assign_sub' title='View' class='btn btn-success btn-xs viewAllSubject'>&nbsp;&nbsp;<span class='glyphicon glyphicon-eye-open'></span>&nbsp;&nbsp;</button>";
}
// view semester offer subject date update
function update($link) {
  echo  "<button id='".$link."' data-toggle='modal' data-target='#date_Update' title='Edit' class='btn btn-info btn-xs updateDate'>&nbsp;&nbsp;<span class='glyphicon glyphicon-edit'></span>&nbsp;&nbsp;</button>";
}

// active buttonbtn
function activate_btn($link) {
  echo anchor($link, '&nbsp;&nbsp;<span style="font-size:15px;" class="fa fa-unlock-alt" title="Activate"></span>&nbsp;&nbsp;', array('class' => "btn btn-primary btn-xs",'onclick'=>"return confirm('are you sure ?')"));
}
// dactive buttonbtn
function deactivate_btn($link) {
  echo anchor($link, '&nbsp;&nbsp;<span style="font-size:15px;" class="fa fa-lock" title="Deactivate"></span>&nbsp;&nbsp;', array('class' => "btn btn-warning btn-xs",'onclick'=>"return confirm('are you sure ?')"));
}


// active buttonbtn
function complete_btn($link) {
  echo anchor($link, '&nbsp;&nbsp;<span style="font-size:15px;" class="fa fa-check" title="Complete"></span>&nbsp;&nbsp;', array('class' => "btn btn-success btn-xs",'onclick'=>"return confirm('are you sure ?')"));
}
// dactive buttonbtn
function running_btn($link) {
  echo anchor($link, '&nbsp;&nbsp;<span style="font-size:15px;" class="fa fa-pause" title="Running"></span>&nbsp;&nbsp;', array('class' => "btn btn-default btn-xs",'onclick'=>"return confirm('are you sure ?')"));
}

// view notice button
function view_notice($link) {
  echo  "<button id='".$link."' data-toggle='modal' data-target='#view_notice' title='View' class='btn btn-success btn-xs viewNotice'>&nbsp;&nbsp;<span class='glyphicon glyphicon-eye-open'></span>&nbsp;&nbsp;</button>";
}
// view barCode button
function barCode($link) {
  echo  "<button id='".$link."' data-toggle='modal' data-target='#barCode' title='Barcode' class='btn btn-primary btn-xs viewBarCode'>&nbsp;<span class='fa fa-barcode'></span>&nbsp;&nbsp;</button>";
}

// fine btn
function fine($link) {
  echo  "<button id='".$link."' data-toggle='modal' data-target='#fine' title='Fine' class='btn btn-warning btn-xs addFine'>&nbsp;&nbsp;<span class='glyphicon glyphicon-paperclip'></span>&nbsp;&nbsp;</button>";
}
// paid btn
function paid($link) {
  echo anchor($link, '&nbsp;&nbsp;<span style="font-size:15px;" class="fa fa-money" title="Payment"></span>&nbsp;&nbsp;', array('class' => "btn btn-success btn-xs",'onclick'=>"return confirm('Confirm Payment !')"));
}

// library clearance
function clearance($link) {
echo  "<button id='".$link."' data-toggle='modal' data-target='#clearance' title='Library Clearance' class='btn btn-info btn-xs clearance'>&nbsp;&nbsp;<i class='fa fa-handshake-o'></i>&nbsp;&nbsp;</button>";
}

/*
// notification script 
*/

function pluck($array, $value, $key=NULL) {
  $returnArray = array();
  if(count($array)) {
    foreach ($array as $item) {
      if($key != NULL) {
        $returnArray[$item->$key] = strtolower($value) == 'obj' ? $item : $item->$value;
      } else {
        $returnArray[] = $item->$value;
      }
    }
  }
  return $returnArray;
}

function noticeCounter() {
  $CI =& get_instance();
  $query = $CI->db->get('msit_tb_notice');
  $notices = $query->result();

  $counterQuery = $CI->db->get_where('msit_tb_notification', array('user_id' => $CI->session->userdata('loginID')));
  $counters = $counterQuery->result();
  $counters = pluck($counters, 'notice_no');
  // return $counters;
  $i = 0;
  foreach ($notices as $notice) {
    if(!in_array($notice->id, $counters)) {
      $i++;
    }
  }
  return $i;
}

/*
// close notification script
*/