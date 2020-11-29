<div class="row well" style="border:0px solid">
  <span style="font-size:16px;"><i class="fa fa-book"></i> &nbsp;&nbsp; Agregar nuevo semestre</span>
  <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Atras</span></a>
</div>

<div class="row">

  <div class="col-md-8 well" style="border:0px solid;">

    <p class="well" style="padding:10px;">
      <span class="glyphicon glyphicon-leaf"></span>&nbsp; Crear semestre
    </p>

    <div class="col-md-12" style="margin-left:0px; padding-left:8px;" >
      <h5> Código del semestre :&nbsp;&nbsp;
        <b id="semester_code"><?php if(count($get_data)){if(($get_data->action)!=1){{echo $get_data->semester_code;}}}?></b>

      </h5>
    </div>
    <div class="col-md-12 top-left-paddign">
      <div class="col-md-4">Departamento :</div>
      <div class="col-md-8">
        <select name='std_dept' id="std_dept" class="form-control uppercase" >
         <?php foreach($get_dept as $row) { ?>
         <option class="uppercase" value="<?=$row->dept_sort_name?>"><?=$row->dept_sort_name?></option>
         <?php } ?>
       </select>
     </div>
   </div>
   <div class="col-md-12 top-left-paddign">
    <div class="col-md-4">Batch :</div>
    <div class="col-md-8">
      <select name='std_batch' id="std_batch" class="form-control uppercase" >
       <?php foreach($get_batch as $row) { ?>
       <option class="uppercase" value="<?=$row->std_batch?>"><?=$row->std_batch?></option>
       <?php } ?>
     </select>

   </div>
 </div>
 <div class="col-md-12 top-left-paddign">
  <div class="col-md-4">Sección :</div>
  <div class="col-md-8">
    <select name='std_section' id="std_section" class="form-control uppercase" >
     <?php foreach($get_section as $rows) { ?>
     <option class="uppercase" value="<?=$rows->std_section?>"><?=$rows->std_section?></option>
     <?php } ?>
   </select>

 </div>
</div>
<div class="col-md-12 top-left-paddign">
  <div class="col-md-4">Fecha de Registro :</div>
  <div class="col-md-8 input-group left-right-paddign">
    <input type="text" class="form-control" id="from_date" placeholder="Fecha de inicio" readonly/>
    <span class="input-group-addon"> A </span>
    <input type="text" class="form-control" id="to_date" placeholder=" Fecha de cierre" readonly/>
  </div>
</div>

<br>
</div>
<!--  SET semester code   -->

<div class=" col-md-4 col-sm-12 well pull-right-lg" style="border:0px solid">
  <p class="well" style="padding:10px; margin-bottom:2px;">
    <span class="glyphicon glyphicon-edit"></span>&nbsp; Establecer código de semestre
  </p>
  <p align="center">Asignar código de semestre</p>

  <?php echo form_open('assignsemester/set_semester_code');?>
  <div  class="form-inline col-center">
    <div class="form-group">
      <select id="season_code" name="season_code" class="form-control form-control-inline select-cus" style="border:1px solid#999999;" >
        <option value="0">Semestre</option>
        <option value="1">Primavera</option>
        <option value="2">Verano</option>
        <option value="3">Otoño</option>
      </select>
    </div>
    <div class="form-group">
      <select id="year_code" name="year_code" class="form-control form-control-inline select-cus" disabled="true" style="border:1px solid#999999;" >
        <option value="<?php echo date("y");?>"><?php echo'Código de año :'.date("y");?></option>
      </select>
      <input type="text" value="<?php echo date("y");?>" id="year_code" name="year_code" hidden="hidden"/>
    </div>
    <div class="form-group">

      <?php
      if(count($get_data)){
        if(($get_data->action) != 0){?>
        <button type="submit" class="btn btn-default form-control-inline">Vamos !</button>
        <?php } else { ?>
        <button type="button" class="btn btn-default form-control-inline disabled" data-toggle="tooltip" data-placement="top" title="At first Publish Running Semester Result, then creat a New semester code">Vamos !</button>
        <?php } } else { ?>
        <button type="submit" class="btn btn-default form-control-inline">Vamos !</button>
        <?php } ?>
      </div>
    </div>
    <?php echo form_close();?>
    <br>
    <p align="center">Último semestre asignado</p>
    <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Código del semestre</th>
          <th>Temporada</th>
          <th>Año</th>
        </tr>
      </thead>
      <?php if(isset($get_data)) { ?>
      <tbody>
       <tr>
        <td><?=$get_data->id?></td>
        <td><?=$get_data->semester_code?></td>
        <td><?=$get_data->season_code?></td>
        <td><?=$get_data->year_code?></td>
      </tr>
    </tbody>
    <?php } ?>
  </table>
</div>
</div>


<div class="row">
  <div class="col-md-12 well" style="border:0px solid;">
    <h3>Seleccionar asunto</h3>
    <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap table-hover" cellspacing="0" width="100%">
     <thead>

      <tr>
        <th><input type="checkbox" name="chk" onclick="toggle(this);"/></th>
        <th>ID</th>
        <th>Código</th>
        <th> Nombre</th>
        <th>Dept.</th>
        <th>Credito</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($get_subject_list as $row) { ?>
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
  <button class="btn btn-primary btn-sm pull-right" id="get_assign_semester_button" type="button" >Guardar</button>
</div>
</div>


<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
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

      var semester_code = $('#semester_code').text();
      var std_dept = $('#std_dept').val();
      var std_batch= $('#std_batch').val();
      var std_section = $('#std_section').val();

      if($(this).prop('checked') == true) {
        var ids = $(this).prop("id");
        $.ajax({
         type: 'POST',
         url: "<?=base_url('assignsemester/chack_assign_sub')?>",
         data: {"ids" : ids, 'semester_code' : semester_code, 'std_dept' : std_dept, 'std_batch' : std_batch, 'std_section' : std_section},
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
    // script strat
    $('#get_assign_semester_button').click(function() {

      var semester_code = $('#semester_code').text();
      var std_dept = $('#std_dept').val();
      var std_batch= $('#std_batch').val();
      var std_section = $('#std_section').val();

      var reg_from_date = $('#from_date').val();
      var reg_to_date= $('#to_date').val();
      if(semester_code !='' && semester_code.length > 0){
       if(reg_from_date !='' && reg_from_date.length > 0) {
        if(reg_to_date !='' && reg_to_date.length > 0) {
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
              url: "<?=base_url('assignsemester/insert_assign_semester')?>",
              data: {"all_ids" : all_ids, 'semester_code' : semester_code, 'std_dept' : std_dept, 'std_batch' : std_batch, 'std_section' : std_section, 'reg_from_date' : reg_from_date, 'reg_to_date' : reg_to_date},
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
                  window.location = "assign_semester";
                }
              }
            });
} else {
  toastr.warning("Por favor seleccione Asunto", "Warning");
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
}else {
  toastr.warning("El registro hasta la fecha no está asignado", "Warning");
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
}else {
  toastr.warning("La fecha de inicio de registro no está asignada", "Warning");
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
  toastr.warning("Crear nuevo código de semestre.", "Warning");
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
});
</script>
