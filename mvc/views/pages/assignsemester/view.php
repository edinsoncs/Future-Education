<div class="row well" style="border:0px solid">
  <span style="font-size:16px;"><i class="fa fa-book"></i> &nbsp;&nbsp; Asignar semestre
</span>
  <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Atras</span></a>
</div>

<div class="row well" style="border:0px solid">
  <p class="well" style="padding:10px;">
    <span> <i class="fa fa-book"></i>&nbsp; Lista de semestres asignados
</span>
    <a href="<?php echo base_url('assignsemester/add_semester');?>"><span class="pull-right"> <i class="fa fa-plus-square"></i> Agregar nuevo</span></a>
  </p>
  <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
   <thead>
    <tr>
      <th>ID</th>
      <th>Código del semestre</th>
      <th>Departamento</th>
      <th>Batch</th>
      <th>Sección</th>
      <th>Reg. Desde</th>
      <th>Reg. A</th>
      <th>Acción</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($get_all_data as $row) { ?>
    <tr>
      <td><?=$row->id;?></td>
      <td><?=$row->assign_semester_code;?></td>
      <td class="uppercase"><?=$row->assign_dept;?></td>
      <td><?=$row->assign_batch;?></td>
      <td><?=$row->assign_section;?></td>
      <td><?=$row->assign_reg_start_date;?></td>
      <td><?=$row->assign_reg_close_date;?></td>
      <td>
        <?php  view_all_sub($row->id);?>
        <?php  update($row->id);?>
        <?php  del(base_url('assignsemester/delete_data_accroding_to_semester/'.$row-> id));?>
      </td>
    </tr>
    <?php } ?>
  </tbody>

</table>

</div>

<!-- add modal view-->
<div class="modal fade" id="view_assign_sub" role="dialog">
 <div class="modal-dialog">
   <!-- Modal content-->
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title"><i class="fa fa-book"></i></span>&nbsp; View All</h4>
     </div>
     <div class="modal-body" id="suggestion">
       <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
         <thead>
           <tr>
             <th>ID</th>
             <th> Código</th>
             <th> Nombre</th>
             <th>Credito</th>
             <th>Acción</th>
           </tr>
         </thead>
         <tbody id="showData">

         </tbody>
       </table>
     </div>
     <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
     </div>
   </div>
 </div>
</div>

<!-- Date update  -->
<div class="modal fade" id="date_Update" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title"><i class="fa fa-book"></i></span>&nbsp; Actualizar registro
 Date </h4>
     </div>
     <div class="modal-body">
       <div>Fecha de Registro :</div>
       <div  hidden="hidden"><input type="text" name="id" id="id" class="form-control" hidden="hidden" disabled="true"/></div>
       <div class="input-group left-right-paddign">
         <input type="text" class="form-control" id="from_date" placeholder="Starting Date" readonly/>
         <span class="input-group-addon"> A </span>
         <input type="text" class="form-control" id="to_date" placeholder=" Closing Date" readonly/>
       </div>
     </div>
     <div class="modal-footer">
       <button type="button" class="btn btn-default updateDATE" data-dismiss="modal">Actualizar</button>
       <button type="button" class="btn btn-default" data-dismiss="modal" onClick="window.location.reload()">Cerrar</button>
     </div>
   </div>
 </div>
</div>

<script type="text/javascript">
$('.viewAllSubject').click(function() {
  var getID = $(this).attr('id');
  if(getID != 'NULL' || getID != '') {
    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?=base_url('assignsemester/get_sub_list')?>",
      data: "getID=" + getID,
      dataType: "html",
      success: function(data) {
       $('#showData').html(data);
     }
   });
  }
});

$('.updateDate').click(function() {
  var updateID = $(this).attr('id');
  if(updateID != 'NULL' || updateID != '') {
    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?=base_url('assignsemester/getEditDateData')?>",
      data: "updateID=" + updateID,
      dataType: "html",
      success: function(data) {
        var response = jQuery.parseJSON(data);
            // console.log(response);
            if(response.confirmation == 'success') {
             $('#id').val(response.id);
             $('#from_date').val(response.assign_reg_start_date);
             $('#to_date').val(response.assign_reg_close_date);

             /*update script */
             $('.updateDATE').click(function() {
               var id       = $('#id').val();
               var fromDate = $('#from_date').val();
               var toDate   = $('#to_date').val();

               $.ajax({
                 type: 'POST',
                 url: "<?=base_url('assignsemester/updateDate')?>",
                 data: {'id' : id, 'fromDate' : fromDate, 'toDate' : toDate},
                 dataType: "html",
                 success: function(data) {
                   window.location.reload()
                 }
               });
             });
                 //  close update
               } else {
                alert('Try Again');
              }
            }
          });
}
});
</script>
