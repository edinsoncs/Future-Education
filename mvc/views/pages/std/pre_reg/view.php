<div class="row well">
  <span style="font-size:16px;"><i class="fa fa-check-square-o"></i> &nbsp;&nbsp;Registration</span>
  <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Back</span></a>
</div>


</br>
<!-- basic info  -->
<div style="padding-left:0px;" class="col-md-8 col-sm-10 col-xs-12 col-center">
  <h4>
    <?php
    if(count($get_chack)) {
     if(($get_chack->action)!= 1) {
       if(isset($get_last_date_for_pre_reg)){
        $last_date = strtotime(date($get_last_date_for_pre_reg->assign_reg_close_date));
        $messages_ld = date($get_last_date_for_pre_reg->assign_reg_close_date);
        
        $upcoming_date = strtotime(date($get_last_date_for_pre_reg->assign_reg_start_date));
        $meaasges_ud = date($get_last_date_for_pre_reg->assign_reg_start_date);
        $today_date = strtotime(date("d-m-Y"));
        if($today_date < $upcoming_date){
          echo "Registration will be running : &nbsp;&nbsp;&nbsp;" .$meaasges_ud. "&nbsp;&nbsp;To&nbsp;&nbsp;".$messages_ld;
        } elseif ($today_date > $last_date ) {
          echo "Registration Date is Over";
        }
        else {
          echo "Last Date: ".$messages_ld;
          ?>
        </h4>
      </div>

      <form role="form" action="" method="post">
        <div class="row">
          <div class="col-md-8 col-sm-10 col-xs-12 col-center">
            <h3>Select Subject For <?= $semester_code->semester_code?> Semester</h3>
            <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap " cellspacing="0" width="100%">
             <thead>
              <tr>
                <th><input type="checkbox" name="chk" onclick="toggle(this);"/></th>
                <th>ID</th>
                <th>Subject Code</th>
                <th> Name</th>
                <th>Dept</th>
                <th>Credit</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach($get_data as $row) { ?>
              <tr>
                <td><input name="chk" class="all_subject" type="checkbox" id="<?=$row->id;?>" value="<?=$row->id;?>"/></td>
                <td><?=$row->id;?></td>
                <td class="uppercase"><?=$row->assign_sub_code;?></td>
                <td class="capitalize"><?=$row->assign_sub_name;?></td>
                <td class="uppercase"><?=$row->assign_dept;?></td>
                <td ><?=$row->assign_sub_cread;?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <button class="btn btn-primary nextBtn btn-sm pull-right" id="get_subjectList_button" type="button" >Save</button>
        </div>
      </div>
    </form>
    <?php }}}} ?>



    <script language="JavaScript">
// chack all box
function toggle(source) {
  var checkboxes = document.querySelectorAll('input[name="chk"]');
  for (var j = 0; j < checkboxes.length; j++) {
    if (checkboxes[j] != source)
      checkboxes[j].checked = source.checked;
  }
}
// chack Pre-Registration
$('.all_subject').change(function() {
  if($(this).prop('checked') == true) {
    var ids = $(this).prop("id");
    $.ajax({
     type: 'POST',
     url: "<?=base_url('pre_reg/chack_pre_reg')?>",
     data: {"ids" : ids},
     dataType: "html",
     success: function(data) {
      if(data) {
        toastr.warning(data, "Warning");
        toastr.options = {
          "closeButton": false,
          "debug": false,
          "newestOnTop": false,
          "progressBar": false,
          "positionClass": "toast-top-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
      }
    }
  });
  }
});


// submit Pre-Registration
$('#get_subjectList_button').click(function() {
  var all_ids='';
  $('.all_subject').each(function(index, element) {
    if($(this).prop('checked')) {
      get_id = element.id;
      all_ids += get_id + "$";
    }
  });

  if(all_ids != '') {
    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?=base_url('pre_reg/submit_reg')?>",
      data: "all_ids=" + all_ids,
      dataType: "html",
      success: function(data) {
        if(data) {
          toastr.success(data, "Success");
          toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          }
        } else {
          window.location = "pre_registration";
        }

      }
    });
  } else {
    toastr.warning("Please Select Subject", "Warning");
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-bottom-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  }

});
</script>
