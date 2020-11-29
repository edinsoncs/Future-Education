<div class="row well" style="border:0px solid">
  <span style="font-size:16px;"><i class="fa fa-user"></i> &nbsp;&nbsp; Asignar profesor</span>
  <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Atras</span></a>
</div>

<div class="row well" style="border:0px solid">
  <p class="well" style="padding:10px;">
    <span> <i class="fa fa-user"></i>&nbsp; 
Asignar lista de profesores</span>

    <a href="#" data-toggle="modal" data-target="#assign_teacher"><span class="pull-right"> <i class="fa fa-plus-square"></i>&nbsp; Asignar</span></a>
  </p>

  <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
   <thead>

    <tr>
      <th>ID</th>
      <th>Semestre</th>
      <th>Batch</th>
      <th>Sección</th>
      <th>Subj. Código</th>
      <th>Nombre</th>
      <th>Credito</th>
      <th>Asignar profesor</th>
      <th>Alt. Profesor</th>
      <th>Acción</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($get_all_data as $row) { ?>
    <tr>
      <td><?=$row->id;?></td>
      <td><?=$row->semester_code;?></td>
      <td class="uppercase"><?=$row->std_batch;?></td>
      <td class="uppercase"><?=$row->std_section;?></td>
      <td class="uppercase"><?=$row->sub_code;?></td>
      <td class="capitalize limitationCharacters"><?=$row->sub_name;?></td>
      <td><?=$row->sub_credit;?></td>
      <td class="capitalize namelength"><?=$row->assign_teacher;?></td>
      <td class="capitalize namelength"><?=$row->alternative_teacher;?></td>
      <td>
        <?php  del(base_url('assignteacher/delete_data/'.$row-> id));?>
      </td>
    </tr>
    <?php } ?>
  </tbody>

</table>

</div>

<!-- add modal view-->
<div class="modal fade" id="assign_teacher" role="dialog">
 <div class="modal-dialog">
   <!-- Modal content-->
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title"><i class="fa fa-user"></i></span>&nbsp;  Acción </h4>
     </div>
     <?php  echo form_open('assignteacher/insert_teacher_subject');?>
     <div class="modal-body">
      <table  class="table dt-responsive zero-border">
       <tbody>
         <tr >
           <td>Código del semestre</td>
           <td>:</td>
           <td>
             <?php foreach ($get_code as $row){
               if (($row->action)!=1) {?>
               <?php echo $row->semester_code;?>
               <input type="text"  name='semester_code' id="semester_code" value="<?php echo $row->semester_code?>"hidden="hidden"/>
               <?php } }?>
             </td>
           </tr>
           <tr>
             <td>Batch *</td>
             <td>:</td>
             <td>
               <select type="text" name="std_batch" id="std_batch" class="form-control">

               </select>
             </td>
           </tr>
           <tr>
             <td>Sección *</td>
             <td>:</td>
             <td>
               <select type="text" name="std_sections" id="std_sections" class="form-control capitalize">

               </select>
             </td>
           </tr>
           <tr>
             <td>Nombre del tema *</td>
             <td>:</td>
             <td>
               <select type="text" name="sub_name"  id="sub_name" class="form-control capitalize">

               </select>
             </td>
           </tr>
           <tr>
             <td>Seleccionar profesor *</td>
             <td>:</td>
             <td>

              <select type="text" name="assign_teachers"  id="assign_teachers" class="form-control capitalize">
                <option value="0">Seleccionar profesor</option>
                <?php foreach ($get_teacher as $value) {
                  if(($value->access_type)!=0) {?>
                  <option value="<?php echo $value->display_id;?>"><?php echo $value->teacher_name;?> (<?php echo $value->display_id;?>)</option>
                  <?php }}?>

                </select>
              </td>
            </tr>
            <tr>
             <td>Profesor alternativo</td>
             <td>:</td>
             <td>
              <select type="text" name="alternative_teacher"  id="alternative_teacher" class="form-control capitalize">
                <option value="" disabled selected>Opcional</option>
                <?php foreach ($get_teacher as $value) {
                  if(($value->access_type)!=0) {?>
                  <option value="<?php echo $value->teacher_name;?>"><?php echo $value->teacher_name;?> (<?php echo $value->display_id;?>)</option>
                  <?php }}?>
                </select>
              </td>
            </tr>
          </tbody>
          <?php echo form_close();?>
        </table>
      </div>
      <div class="modal-footer">
       <button type="submit" class="btn btn-default">Agregar</button>
       <button type="button" class="btn btn-default" data-dismiss="modal" onClick="window.location.reload()">Cerrar</button>
     </div>
   </div>
 </div>
</div>


<script type="text/javascript">
// for text limitation script
$(document).ready(function() {
  $(".limitationCharacters").each(function(i){
    len=$(this).text().length;
    if(len>20)
    {
      $(this).text($(this).text().substr(0,20)+' ...');
    }
    });
  $(".namelength").each(function(i){
    len=$(this).text().length;
    if(len>15)
    {
      $(this).text($(this).text().substr(0,15)+' ...');
    }
    });
});

 // rective batch code
 $('#semester_code').ready(function() {
   var semeCode = $('#semester_code').val();
   if(semeCode != 'NULL' || semeCode != '') {
     $.ajax({
       type: 'POST',
       dataType: "json",
       url: "<?=base_url('assignteacher/get_batch_code')?>",
       data: "semester_code=" + semeCode,
       success: function(data) {
         $('#std_batch').html('');
         $("<option  value='0'/>").text('Seleccionar Batch').appendTo($('#std_batch'));
         for(var i=0;i<data.length;i++)
         {
           $("<option />").text(data[i].assign_batch).appendTo($('#std_batch'));
         }
       }
     });
   }
 });

 // rective section name
 $('#std_batch').change(function() {
   var stdBatch = $(this).val();
   var semeCode = $('#semester_code').val();
   if(stdBatch != 'NULL' || stdBatch != '') {
     $.ajax({
       type: 'POST',
       dataType: "json",
       url: "<?=base_url('assignteacher/get_section')?>",
       data: {"std_batch" : stdBatch,'semester_code' : semeCode},

       success: function(data) {
         $('#std_sections').html('');
         $("<option  value='0'/>").text('Seleccionar sección').appendTo($('#std_sections'));
         for(var i=0;i<data.length;i++)
         {
           $("<option />").text(data[i].assign_section).appendTo($('#std_sections'));
         }
       }
     });
   }
 });

 // rective subject name
 $('#std_sections').change(function() {
   var stdBatch = $('#std_batch').val();
   var stdSection = $(this).val();
   var semeCode = $('#semester_code').val();

   if(stdBatch != 'NULL' || stdBatch != '' || stdSection !='NULL' || stdSection !='') {
     $.ajax({
       type: 'POST',
       dataType: "json",
       url: "<?=base_url('assignteacher/get_sub_code_sub_name')?>",
       data: {"semester_code" : semeCode,'std_batch' : stdBatch, 'std_section' : stdSection},
       success: function(data) {
         $('#sub_name').html('');
         for(var i=0;i<data.length;i++)
         {
           $("<option />").text(data[i].assign_sub_code).text(data[i].assign_sub_name).appendTo($('#sub_name'));
         }
       }
     });
   }
 });

 </script>
