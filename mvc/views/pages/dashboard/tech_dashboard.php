<br>
<div>
  <div class=" col-md-8 well " style="border:0px solid">
    <p class="well" style="padding:10px; margin-bottom:2px;">
      <span class="fa fa-user"></span>&nbsp; Basic Information
    </p>
    <div class="col-md-12"><br>
      <?php if (isset($get_teachers_basic_info)) { ?>
      <p class="capitalize"><b>Name :</b> <?php echo $get_teachers_basic_info->teacher_name;?> </p>
      <p class="capitalize"><b>Designation : </b> <?php echo $get_teachers_basic_info->teacher_designation;?></p>
      <p><b>Department : </b><span  class="uppercase"><?php echo $get_teachers_basic_info->teacher_department;?></span></p>
      <p><b>Joining Date :</b> <?php echo $get_teachers_basic_info->date_of_join; ?></p>
      <p><b>Email Address :</b> <?php echo $get_teachers_basic_info->email_address;?></p>
      <p><b>Contact No :</b> <?php echo $get_teachers_basic_info->contact_no;?></p>
      <?php }?>
    </div>
  </div>
  <div class=" col-md-4 col-sm-12 well pull-right-lg" style="border:0px solid">
    <?php $this->load->view('layout/calendar.php'); ?></br>
  </div>
</div>
