<div class="row well" style="border:0px solid">
    <span style="font-size:16px;"><i class="fa fa-book"></i> &nbsp;&nbsp;Personalizar la asignatura asignada según el semestre en curso
</span>
    <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Atras</span></a>
</div>

<div class="col-md-8 col-sm-10 col-xs-12 col-center">
  <h3 class="row">DNI Estudiante:</h3>
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
                    <th>Sub. Código</th>
                    <th>Nombre del tema</th>
                    <th>Dept.</th>
                    <th>Credito</th>
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
Note: <br> 1) Primero, coloque la identificación del estudiante y haga clic en el botón Ir
. <br> 2) Seleccione los temas deseados y haga clic en el botón Guardar.
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

// chack subject
$('.all_subject').change(function() {
  var studentID = $('#std_id').val();
  if ((studentID)==false) {
    toastr.warning("No se encontró la dosis de identificación del estudiante !", "Warning");
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
          url: "<?=base_url('assignSubjectCus/chack_insert_data')?>",
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
// insert subject
$('.getStudentID').click(function() {
  var studentID = $('#std_id').val();
  if(studentID !='' && studentID.length > 0) {

    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?=base_url('assignSubjectCus/retrive_data')?>",
      data: "studentID=" + studentID,
      dataType: "html",
      success: function(data) {
        var response = jQuery.parseJSON(data);
        if(response.confirmation == 'success') {
          $('.std_info').html(
            '<p class="row hidden_border"><b>Nombre del estudiante:</b>&nbsp;'+ response.std_name +
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
    $('.std_info').html('<p class="row hidden_border"> El campo de identificación del estudiante es obligatorio.</p>');
  }
});


$('#get_subjectList_button').click(function() {
  var std_id = $('#std_id').val();
  var permissionCheck = 'out';
  if(std_id !='' && std_id.length > 0) {
  $.ajax({
    type: 'POST',
    dataType: "json",
    url: "<?=base_url('assignSubjectCus/retrive_data')?>",
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
              url: "<?=base_url('assignSubjectCus/select_stdORsub')?>",
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
                  window.location = "assign_subject_cus";
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
