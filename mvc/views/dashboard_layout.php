<?php $this->load->view('layout/header.php'); ?>
<?php $this->load->view('layout/navebar.php'); ?>
<!-- main containt body-->
<section style="min-height:522px;">

  <?php
  if (isset($dashboard)) :
    $this->load->view('pages/'.$dashboard);
  // profile page load
  elseif (isset($admin_dashboard)):
    $this->load->view('pages/'.$admin_dashboard);
  elseif (isset($settings_data)):
    $this->load->view('pages/'.$settings_data);
  elseif (isset($authority_data)):
    $this->load->view('pages/'.$authority_data);
  elseif (isset($edit_authority_data)):
    $this->load->view('pages/'.$edit_authority_data);
  elseif (isset($student_info)):
    $this->load->view('pages/'.$student_info);
  elseif (isset($student_add)):
    $this->load->view('pages/'.$student_add);
  elseif (isset($edit_std_info)):
    $this->load->view('pages/'.$edit_std_info);
  elseif (isset($dept_info)):
    $this->load->view('pages/'.$dept_info);
  elseif (isset($subject_info)):
    $this->load->view('pages/'.$subject_info);
  elseif (isset($teachers_info)):
    $this->load->view('pages/'.$teachers_info);
  elseif (isset($add_teacher)):
    $this->load->view('pages/'.$add_teacher);
  elseif (isset($edit_teacher)):
    $this->load->view('pages/'.$edit_teacher);
  elseif (isset($waiver_data)):
    $this->load->view('pages/'.$waiver_data);
  elseif (isset($add_waiver)):
    $this->load->view('pages/'.$add_waiver);
  elseif (isset($assign_semester)):
    $this->load->view('pages/'.$assign_semester);
  elseif (isset($add_semester)):
    $this->load->view('pages/'.$add_semester);
  elseif (isset($assign_teacher)):
    $this->load->view('pages/'.$assign_teacher);
  elseif (isset($assign_subject_cus)):
    $this->load->view('pages/'.$assign_subject_cus);
  elseif (isset($add_subject_cus)):
    $this->load->view('pages/'.$add_subject_cus);
  elseif (isset($semester_archive)):
    $this->load->view('pages/'.$semester_archive);
  elseif (isset($assign_teacher_details)):
    $this->load->view('pages/'.$assign_teacher_details);
  elseif (isset($resultArchive)):
    $this->load->view('pages/'.$resultArchive);
  elseif (isset($get_marksheet)):
    $this->load->view('pages/'.$get_marksheet);
  elseif (isset($report)):
    $this->load->view('pages/'.$report);
  elseif (isset($notice_page)):
    $this->load->view('pages/'.$notice_page);
  elseif (isset($notice_for_teacher)):
    $this->load->view('pages/'.$notice_for_teacher);
  elseif (isset($notice_for_student)):
    $this->load->view('pages/'.$notice_for_student);
  elseif (isset($transport_page)):
    $this->load->view('pages/'.$transport_page);
  elseif (isset($library_page)):
    $this->load->view('pages/'.$library_page);
  
  // authority
  elseif (isset($authority_dashboard)):
    $this->load->view('pages/'.$authority_dashboard);

  // for student
  elseif (isset($std_dashboard)):
    $this->load->view('pages/'.$std_dashboard);
  elseif (isset($marksheet)):
    $this->load->view('pages/'.$marksheet);
  elseif (isset($pre_reg)):
    $this->load->view('pages/'.$pre_reg);

  // for teachers
  elseif (isset($overview)):
   $this->load->view('pages/'.$overview);
 elseif (isset($get_mark_details)):
   $this->load->view('pages/'.$get_mark_details);
 elseif (isset($changepassword)):
   $this->load->view('pages/'.$changepassword);

// for report viewar
 elseif (isset($r_teachersAll)):
  $this->load->view('pages/'.$r_teachersAll);
elseif (isset($r_teachers)):
  $this->load->view('pages/'.$r_teachers);
elseif (isset($s_studentAll)):
  $this->load->view('pages/'.$s_studentAll);
endif;
?>


</section>
<!--close main containt body-->
<?php $this->load->view('layout/footer.php'); ?>
