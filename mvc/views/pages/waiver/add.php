<div class="row well">
  <span style="font-size:16px;"><i class="fa fa-pencil-square-o"></i> &nbsp;&nbsp; Renuncia
</span>
  <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Atrás
</span></a>
</div>

<div class="col-md-8 col-sm-10 col-xs-12 col-center">
  <h3 class="row">Estudiante DNI:</h3>
  <from>
    <div class="input-group row">
      <span class="input-group-addon"><i class="fa fa-user"></i> DNI:</span>
      <input type="text" class="form-control std_id" id="std_id" required="required"/>
      <span class="input-group-btn">
        <button class="btn btn-default getStudentID" type="button">Vamos !</button>
      </span>
    </div>
  </from>
</div>
</br>
<!-- basic info  -->
<div class="col-md-8 col-sm-10 col-xs-12 col-center std_info" >

</div>

<form role="form" action="" method="post">
  <div class="row">
    <div class="col-md-8 col-sm-10 col-xs-12 col-center">

      <h3>Seleccionar asunto</h3>

      <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
       <thead>

        <tr>
          <th><input type="checkbox" name="chk" onclick="toggle(this);"/></th>
          <th>ID</th>
          <th>Código de asunto</th>
          <th> Nombre</th>
          <th>Departamento</th>
          <th>Crédito</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach($get_data as $row) { ?>
        <tr>
          <td><input name="chk" class="all_subject" type="checkbox" id="<?=$row->id?>" value="<?=$row->id?>"/></td>
          <td><?=$row->id?></td>
          <td class="uppercase"><?=$row->subject_code?></td>
          <td class="capitalize"><?=$row->subject_name?></td>
          <td class="uppercase"><?=$row->subject_dept?></td>
          <td ><?=$row->subject_credit?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <button class="btn btn-primary nextBtn btn-sm pull-right" id="get_subjectList_button" type="button" >Guardar</button>
  </div>
</div>

<p class="note">
  N.B: <br> 1. Escriba primero la identificación del estudiante y haga clic en el botón Ir. <br> 2. Seleccione Temas de exención y haga clic en el botón Guardar.
</p>

</form>




<script language="JavaScript">
// chack all box
function toggle(source) {
  var checkboxes = document.querySelectorAll('input[name="chk"]');
  for (var j = 0; j < checkboxes.length; j++) {
    if (checkboxes[j] != source)
      checkboxes[j].checked = source.checked;
  }
}
// chack Waiver subject
$('.all_subject').change(function() {
  var studentID = $('#std_id').val();
  if ((studentID)==false) {
    toastr.warning("¡No se encontró la dosis de identificación del estudiante!", "Warning");
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
  }else{
    if($(this).prop('checked') == true) {
      var ids = $(this).prop("id");
      $.ajax({
       type: 'POST',
       url: "<?=base_url('waiver/chack_waiver_data')?>",
       data: {"ids" : ids, "std_id" : studentID},
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
  }
});

$('.getStudentID').click(function() {
  var studentID = $('#std_id').val();
  if(studentID !='' && studentID.length > 0) {

    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?=base_url('waiver/retrive_data')?>",
      data: "studentID=" + studentID,
      dataType: "html",
      success: function(data) {
        var response = jQuery.parseJSON(data);
        if(response.confirmation == 'success') {
          $('.std_info').html(
            '<p class="row hidden_border"><b>Student Name:</b>&nbsp;'+ response.std_name +
            ', <b>Department:</b> &nbsp;'+ response.std_dept +
            ', <b>Batch:</b> &nbsp;'+ response.std_batch +
            ', <b>Section:</b> &nbsp;'+ response.std_section +'</p>'
            );
        } else {
          $('.std_info').html('<p class="row hidden_border">'+ response.message + '</p>');
        }
      }
    });
  } else {
    $('.std_info').html('<p class="row hidden_border"> The Student ID Field Required.</p>');
  }
});


$('#get_subjectList_button').click(function() {
  var std_id = $('#std_id').val();
  var permissionCheck = 'out';
  if(std_id !='' && std_id.length > 0) {
    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?=base_url('waiver/retrive_data')?>",
      data: "studentID=" + std_id,
      dataType: "html",
      success: function(data) {
        var response = jQuery.parseJSON(data);
        if(response.confirmation == 'success') {

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
              url: "<?=base_url('waiver/select_stdORsub')?>",
              data: {"all_ids" : all_ids, 'std_id' : std_id},
              dataType: "html",
              success: function(data) {
                if(data) {
                  toastr.warning(data, "Warning");
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
                } else {
                  window.location = "waivers";
                }


              }
            });
} else {
  toastr.warning("Seleccione el tema", "Warning");
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
} else {
  toastr.warning("No se encontró la identificación de estudiante", "Warning");
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
}
});
}else {
  toastr.warning("Campo de identificación de estudiante obligatorio", "Warning");
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
