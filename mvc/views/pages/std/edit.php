<div class="row well" style="border:0px solid">
  <span style="font-size:16px;"><i class="fa fa-users"></i>&nbsp; &nbsp; Update Student Info</span>
  <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i><span>&nbsp; Back</a>
</div>

<div class="row well" style="border:0px solid">

  <?php foreach($get_stdID_info as $row):
  echo form_open('students/update_std_info/'.$row-> std_display_id);?>
  <table class="table dt-responsive zero-border input-cus select-cus">
    <tbody>
      <tr>
       <td>
         <label> ID :</label>
       </td>
       <td>
         <input type="text" id="std_id" name="std_id" class="form-control" value="<?php echo $row-> std_id ; ?>" onkeyup="sync()"/>
       </td>
     </tr>
     <tr>
      <td>
        <label> Name :</label>
      </td>
      <td>
        <input type="text" id="std_name" name="std_name" class="form-control capitalize" placeholder="Full Name *" value="<?php echo $row-> std_name ; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label>Department :</label>
      </td>
      <td>
        <select name='std_dept' id="std_dept" class="form-control uppercase" >
          <option value="<?php echo $row-> std_dept; ?>"><?php echo $row-> std_dept; ?></option>
          <option disabled="disabled">---------</option>
          <?php foreach($get_dept as $rows) { ?>
          <option class="uppercase" value="<?=$rows->dept_sort_name?>"><?=$rows->dept_sort_name?></option>
          <?php } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>
        <label>Batch :</label>
      </td>
      <td>
        <input type="text" id="std_batch" name="std_batch" class="form-control" placeholder="Batch *" value="<?php echo $row-> std_batch ; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label>Section :</label>
      </td>
      <td>
        <select name='std_section' id="std_section" class="form-control uppercase" >
          <option value="<?php echo $row-> std_section; ?>"><?php echo $row-> std_section; ?></option>
          <option disabled="disabled">---------</option>
          <option value="Day">Day</option>
          <option value="Evening">Evening</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>
        <label>Gender :</label>
      </td>
      <td>
        <select name='std_gender' id="std_gender" class="form-control" >
          <option value="<?php echo $row-> std_gender; ?>"><?php echo $row-> std_gender; ?></option>
          <option disabled="disabled">---------</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>
        <label>Religion :</label>
      </td>
      <td>
        <select name='std_religion' id="std_religion" class="form-control" >
          <option value="<?php echo $row-> std_religion; ?>"><?php echo $row-> std_religion; ?></option>
          <option disabled="disabled">---------</option>
          <option value="Islam">Islam</option>
          <option value="Hindu">Hindu</option>
          <option value="Budhist">Budhist</option>
          <option value="Christian">Christian</option>
          <option value="Others">Others</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>
        <label>Required Credit :</label>
      </td>
      <td>
        <input type="text" id="required_credit" name="required_credit" class="form-control" placeholder="Required Credit *" value="<?php echo $row-> required_credit;?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label>Status :</label>
      </td>
      <td>
        <select name='std_status' id="std_status" class="form-control uppercase" >
          <option value="<?php echo $row-> std_status;?>">
            <?php
            if(($row-> std_status)==1){
              echo "Regular";
            }elseif(($row-> std_status)==2) {
              echo "Irregular";
            }
            ?>
          </option>
          <option disabled="disabled">---------</option>
          <option value="1">Regular</option>
          <option value="2">Irregular</option>
        </select>

      </td>
    </tr>
    <tr>
      <td>
        <label>Email:</label>
      </td>
      <td>
        <input type="text" id="std_email_address" name="std_email_address" placeholder="Email Address *" class="form-control"  value="<?php echo $row-> std_email_address;?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label>Contact No:</label>
      </td>
      <td>
        <input type="text" id="std_contact_no" name="std_contact_no" class="form-control" placeholder="Contact No. *"  value="<?php echo $row-> std_contact_no;?>"/>
      </td>
    </tr>
  </tbody>
</table>
<hr>

<h4>Login Information</h4>
<h5><input type="checkbox" id="checkbox" name="checkbox"/> &nbsp; Change your Password</h5>
<table class="table dt-responsive zero-border input-cus select-cus" >

  <tbody>

    <tr>
      <td >
        <label>User Name :</label>
      </td>
      <td >
        <input type="text" id="user_name" name="user_name" class="form-control" value="<?php echo $row-> std_id ; ?>" disabled="true"/>
      </td>
    </tr>
  </tbody>
</table>
<table id="autoUpdate" class="table dt-responsive zero-border input-cus select-cus" >

  <tbody>

    <tr>
      <td>
        <label>New Password :</label>
      </td>
      <td>
        <input type="Password" id="authorPassword" name="user_pass" class="form-control" placeholder="Password " />
      </td>
    </tr>
    <tr>
      <td>
        <label>Confirm Password :</label>
      </td>
      <td>
        <input type="Password" id="authorConfirmPassword" name="rp_user_pass" class="form-control" placeholder="Confirm Password"/>
      </td>
    </tr>
  </tbody>
</table>

<button type="submit" class="btn btn-default" ><span class="glyphicon glyphicon-save"></span>&nbsp; Update </button>
<?php echo form_close(); endforeach; ?>
</div>


<!-- insert Authority user script module  -->
<script type="text/javascript">
function sync()
{
  var std_id = document.getElementById('std_id');
  var user_name = document.getElementById('user_name');
  user_name.value = std_id.value;
}


$(document).ready(function () {
  $("#autoUpdate").hide();
  $('#checkbox').change(function () {
    if($(this).is(":checked")){
     $('#autoUpdate').show('slow');
   }
   else
    $('#autoUpdate').hide('slow');
});
});
</script>
