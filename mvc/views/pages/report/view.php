<div class="row well" style="border:0px solid">
  <span style="font-size:16px;"><i class="fa fa-clipboard"></i> &nbsp;&nbsp; Generador de informes
</span>
  <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Atrás</span></a>
</div>

<div class="row well">
  <p class="well" style="padding:10px;">
    <span> <i class="fa fa-clipboard"></i> Reporte </span>
  </p>
  <!-- teachers report   -->
  <?php echo form_open('report/print_preview');?>
  <div class="col-md-12" style="margin-bottom:10px;">
    <div class="col-md-2">Informe del maestro </div>
    <div class="col-md-2" style="margin-bottom:5px;">
      <select type="text" name="dept_info"  id="dept_info1" class="form-control">
       <option value="">Seleccione Dept.</option>
       <?php foreach($get_dept as $row) { ?>
       <option class="uppercase" value="<?=$row->dept_sort_name?>"><?=$row->dept_sort_name?></option>
       <?php } ?>
     </select>
   </div>
   <div class="col-md-3" style="margin-bottom:5px;">
    <select type="text" name="teacher_info"  id="teacher_info" class="form-control capitalize">
      <option value="0">Seleccionar profesor</option>
      <?php foreach ($get_teacher as $value) {
        if(($value->access_type)!=0) {?>
        <option value="<?php echo $value->display_id;?>"><?php echo $value->teacher_name;?> (<?php echo $value->display_id;?>)</option>
        <?php }}?>

      </select>
    </div>
    <div class="col-md-2">
     <button class="btn btn-success btn-sm" type="submit" >Obtener informe</button>
   </div>
 </div>
 <?php echo form_close();?>
 <!-- Student Report -->
 <?php echo form_open('report/print_preview_s') ?>
 <div class="col-md-12" style="margin-bottom:10px;">
   <div class="col-md-2">Informe del estudiante
 </div>
   <div class="col-md-2" style="margin-bottom:5px;">
     <select type="text" name="dept_info"  id="dept_info" class="form-control">
      <option value="">Seleccione Dept.</option>
      <?php foreach($get_dept as $row) { ?>
      <option class="uppercase" value="<?=$row->dept_sort_name?>"><?=$row->dept_sort_name?></option>
      <?php } ?>
    </select>
  </div>
  <div class="col-md-2" style="margin-bottom:5px;">
   <select type="text"  name="batch_info"  id="batch_info2" class="form-control">
     <option value="">Seleccione Batch</option>
     <?php foreach($get_batch as $batch) { ?>
     <option class="uppercase" value="<?=$batch->std_batch?>"><?=$batch->std_batch?></option>
     <?php } ?>
   </select>
 </div>
 <div class="col-md-2" style="margin-bottom:5px;">
   <select type="text" name="section_info" id="section_info"  class="form-control">
     <option value="">Seleccione Section</option>
     <?php foreach($get_section as $section) { ?>
     <option class="uppercase" value="<?=$section->std_section?>"><?=$section->std_section?></option>
     <?php } ?>
   </select>
 </div>
 <div class="col-md-2" name="std_id_list"  id="std_id_list" style="margin-bottom:5px;">
   <select type="text" name="std_ID" id="std_ID"  class="form-control" >
     <option value="">Seleccione Student</option>
     <?php foreach($std_list as $list) { ?>
     <option class="uppercase" value="<?=$list->std_id?>"><?=$list->std_id?></option>
     <?php } ?>
   </select>
 </div>
 <div class="col-md-2">
  <button class="btn btn-success btn-sm" type="submit">Obtener informe</button>
</div>
</div>
<?php echo form_close();?>
<!-- Result Report -->
<?php echo form_open('report/semester_result');?>
<div class="col-md-12">
  <div class="col-md-2">Informe de resultados </div>
  <div class="col-md-2" style="margin-bottom:5px;">
    <select type="text" name="seme_code" id="seme_code" class="form-control">
      <option value="">Seleccionar semestre</option>
      <?php foreach($seme_code as $seme_code) { ?>
      <option class="uppercase" value="<?=$seme_code->semester_code?>"><?=$seme_code->semester_code?></option>
      <?php } ?>
    </select>
  </div>
  <div class="col-md-2" style="margin-bottom:5px;">
    <select type="text" name="dept_info"  id="dept_info" class="form-control">
     <option value="">Seleccione Dept.</option>
     <?php foreach($get_dept as $row) { ?>
     <option class="uppercase" value="<?=$row->dept_sort_name?>"><?=$row->dept_sort_name?></option>
     <?php } ?>
   </select>
 </div>
 <div class="col-md-2" style="margin-bottom:5px;">
  <select type="text"  name="result_batch_info"  id="result_batch_info" class="form-control">
    <option value="">Seleccione Batch</option>
    <?php foreach($get_batch as $batch) { ?>
    <option class="uppercase" value="<?=$batch->std_batch?>"><?=$batch->std_batch?></option>
    <?php } ?>
  </select>
</div>
<div class="col-md-2" style="margin-bottom:5px;">
  <select type="text" class="form-control" name="get_result_section" id="get_result_section">
    <option value="">Seleccione Section</option>
    <?php foreach($get_section as $section) { ?>
    <option class="uppercase" value="<?=$section->std_section?>"><?=$section->std_section?></option>
    <?php } ?>
  </select>
</div>
<div class="col-md-2">
 <button class="btn btn-success btn-sm">Obtener informe</button>
</div>
</div>
<?php echo form_close(); ?>
</div>



<script type="text/javascript">
// rective section name
$('#dept_info1').change(function() {
  var dept_info = $(this).val();
  if(dept_info != 'NULL' || dept_info != '') {
    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?=base_url('report/get_teacher_list_accro_dept')?>",
      data: {"dept_info" : dept_info},
      success: function(data) {
        $('#teacher_info').html('');
        $("<option  value='0'/>").text('Seleccionar profesor').appendTo($('#teacher_info'));
        for(var i=0;i<data.length;i++)
        {
          $("<option />").text(data[i].display_id).text(data[i].teacher_name).appendTo($('#teacher_info'));
        }
      }
    });
  }
});

 // shorted list for student 

 // $('#section_info').change(function() {

 //   var dept_info = $('#dept_info').val();
 //   var batch_info = $('#batch_info2').val();
 //   var section_info = $(this).val();

 //   if(dept_info != 'NULL' || dept_info != '' || batch_info !='NULL' || batch_info !=''|| section_info !='NULL' || section_info !='') {
 //     $.ajax({
 //       type: 'POST',
 //       dataType: "json",
 //       url: "<?=base_url('report/get_shorted_std_list')?>",
 //       data: {"dept_info" : dept_info,'batch_info' : batch_info, 'section_info' : section_info},
 //       success: function(data) {
 //         $('#std_ID').html('');
 //         $("<option  value='0'/>").text('Select Student').appendTo($('#std_ID'));
 //         for(var i=0;i<data.length;i++)
 //         {
 //           $("<option />").text(data[i].std_id).text(data[i].std_id).appendTo($('#std_ID'));
 //         }
 //       }
 //     });
 //   }
 // });

 </script>
