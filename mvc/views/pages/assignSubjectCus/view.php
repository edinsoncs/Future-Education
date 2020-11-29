<div class="row well" style="border:0px solid">
    <span style="font-size:16px;"><i class="fa fa-book"></i> &nbsp;&nbsp;Personalizar la asignatura asignada según el semestre en curso
</span>
    <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Atras</span></a>
</div>

<div class="row well" style="border:0px solid">
    <p class="well" style="padding:10px;">
      <span> <i class="fa fa-book"></i>&nbsp; Lista de estudiantes registrados</span>

      <a href="<?php echo base_url('assignSubjectCus/assign_sub_cust');?>"><span class="pull-right"> <i class="fa fa-plus-square"></i> &nbsp;Asignar Asunto
</span></a>
    </p>

    <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
      <thead>
        <tr>
            <th>ID</th>
            <th> Semestre</th>
            <th>DNI Estudiante</th>
            <th>Nombre</th>
            <th>Dept</th>
            <th>Batch</th>
            <th>Sección</th>
            <!-- <th>Sub Code</th>
            <th>Sub Name</th>
            <th>Credit</th> -->
            <th>Acción</th>
        </tr>
        </thead>

            <tbody>
              <?php foreach($get_data as $row) { ?>
              <tr>
                  <td><?=$row->id?></td>
                  <td><?=$row->semester_code?></td>
                  <td><?=$row->std_id?></td>
                  <td class="capitalize"><?=$row->std_name?></td>
                  <td class="uppercase"><?=$row->std_dept?></td>
                  <td><?=$row->std_batch?></td>
                  <td><?=$row->std_section?></td>
                  <!-- <td class="uppercase"><?=$row->sub_code?></td>
                  <td class="capitalize"><?=$row->sub_name?></td>
                  <td ><?=$row->sub_credit?></td> -->
                  <td>
                    <?php  view_all_sub($row->id);?>
                    <?php  del(base_url('assignSubjectCus/delete_data_accroding_to_semester/'.$row-> id));?>
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
           <h4 class="modal-title"><i class="fa fa-book"></i></span>&nbsp; Ver todo</h4>
         </div>
         <div class="modal-body" id="suggestion">
           <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
             <thead>
                   <tr>
                       <th>ID</th>
                       <th>Código</th>
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

 <script type="text/javascript">
 $('.viewAllSubject').click(function() {
     var getID = $(this).attr('id');
     if(getID != 'NULL' || getID != '') {
       $.ajax({
           type: 'POST',
           dataType: "json",
           url: "<?=base_url('assignSubjectCus/get_sub_list')?>",
           data: "getID=" + getID,
           dataType: "html",
           success: function(data) {
              $('#showData').html(data);
           }
       });
     }
 });
 </script>
