<div class="row well">
    <span style="font-size:16px;"><i class="fa fa-pencil-square-o"></i> &nbsp;&nbsp; Renuncia</span>
    <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Atras</span></a>
</div>

<div class="row well" style="border:0px solid">
    <p class="well" style="padding:10px;">
      <span> <i class="fa fa-book"></i>&nbsp; Lista de estudiantes de exención</span>

      <a href="<?php echo base_url('waiver/addWaivers');?>"><span class="pull-right"> <i class="fa fa-plus-square"></i> Agregar renuncia</span></a>
    </p>

    <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
      <thead>

            <tr>
                <th>ID</th>
                <th>DNI</th>
                <th> Nombre</th>
                <th>Departmento</th>
                <th>Batch</th>
                <th>sección</th>
                <th>Acción</th>
            </tr>
        </thead>
          <?php foreach($waiver_info as $row) { ?>
            <tbody>
              <tr>
                  <td><?=$row->id?></td>
                  <td><?=$row->std_id?></td>
                  <td><?=$row->std_name?></td>
                  <td class="uppercase"><?=$row->std_dept?></td>
                  <td><?=$row->std_batch?></td>
                  <td><?=$row->std_section?></td>
                  <td>
                    <?php  view_all_sub($row->id);?>
                    <?php  del(base_url('waiver/delete_all_data/'.$row->id));?>
                  </td>
              </tr>


             </tbody>
           <?php } ?>
    </table>

</div>


<!-- add modal view-->
<div class="modal fade" id="view_assign_sub" role="dialog">
 <div class="modal-dialog">
   <!-- Modal content-->
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title"><i class="fa fa-book"></i></span>&nbsp; Ver todo</h4>
     </div>
     <div class="modal-body" id="suggestion">
       <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
         <thead>
           <tr>
             <th>ID</th>
             <th>Código</th>
             <th>Nombre</th>
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

<script type="text/javascript">
$('.viewAllSubject').click(function() {
  var getID = $(this).attr('id');
  if(getID != 'NULL' || getID != '') {
    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?=base_url('waiver/get_sub_list')?>",
      data: "getID=" + getID,
      dataType: "html",
      success: function(data) {
       $('#showData').html(data);
     }
   });
  }
});
</script>
