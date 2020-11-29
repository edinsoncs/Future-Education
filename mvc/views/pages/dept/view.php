<div class="row well" style="border:0px solid">
  <span style="font-size:16px;"><i class="fa fa-tags"></i> &nbsp;&nbsp; Información del departamento
</span>
  <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> atrás</span></a>
</div>

<div class="row well">
  <p class="well" style="padding:10px;">
    <span> <i class="fa fa-tags"></i> Departamentos </span>

    <a href="#" data-toggle="modal" data-target="#addDept"><span class="pull-right"> <i class="fa fa-plus-square"></i> Agregar nuevo</span></a>
  </p>

  <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
   <thead>

    <tr>
      <th>ID</th>
      <th>Código</th>
      <th>Nombre</th>
      <th>Acción</th>
    </tr>
  </thead>
  <tbody>
    <?php  foreach ($get_data as $row) : ?>
    <tr>
      <td><?php echo $row-> id; ?></td>
      <td class="uppercase"><?php echo $row-> dept_sort_name; ?></td>
      <td class="capitalize"><?php echo $row-> dept_name; ?></td>

      <td>

        <?php  edited($row->id);?> &nbsp;
        <?php  del(base_url('department/delete_data/'.$row-> id));?>
      </td>
    </tr>
  <?php  endforeach; ?>
</tbody>
</table>

<!-- add department info popup   -->
<div class="modal fade" id="addDept" role="dialog">
 <div class="modal-dialog">
   <!-- Modal content-->
   <div class="modal-content">
     <?php echo form_open('department/department_add');?>
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Agregar información de departamento</h4>
     </div>

     <div class="modal-body">

       <table  class="table dt-responsive zero-border">
         <tbody>
          <tr>
             <td>código del departamento *</td>
             <td>:</td>
             <td>
              <input type="text" name="dept_sort_name" value="" id="dept_sort_name" class="form-control uppercase" placeholder="Ej: CSE" />
            </td>
          </tr>
           <tr>
             <td>Nombre de Departamento *</td>
             <td>:</td>
             <td>
               <input type="text" name="dept_name" value="" id="dept_name" class="form-control capitalize" placeholder="Ej: Ciencias de la Computación e Ingeniería"  />
             </td>
           </tr>
        </tbody>
      </table>

    </div>

    <div class="modal-footer">
     <button type="submit" class="btn btn-default">Agregar nuevo</button>
     <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
   </div>
   <!-- </div> -->
   <?php echo form_close()?>
 </div>
</div>
</div>


<!-- add modal view-->
<div class="modal fade" id="dept_Update" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-tags"></i></span>&nbsp; Actualizar la información del departamento</h4>
      </div>

      <div class="modal-body">
       <table  class="table dt-responsive zero-border">
        <tbody>
          <tr hidden="hidden">
            <td>ID</td>
            <td>:</td>
            <td>
              <input type="text" name="id" id="id" class="form-control" disabled="true"/>
            </td>
          </tr>
          <tr>
            <td>Código del departamento *</td>
            <td>:</td>
            <td>
             <input type="text" name="edit_dept_sort_name"  id="edit_dept_sort_name" class="form-control uppercase" placeholder="Ej: CSE" />
           </td>
         </tr>
          <tr>
            <td>Nombre de Departamento *</td>
            <td>:</td>
            <td>
              <input type="text" name="edit_dept_name"  id="edit_dept_name" class="form-control capitalize" placeholder="Ej: Ciencias de la Computación e Ingeniería"  />
            </td>
          </tr>

       </tbody>
     </table>
   </div>
   <div class="modal-footer">
    <button type="button" id="updateData" value="" class="btn btn-default editForDepartment">Actualizar</button>
    <button type="button" class="btn btn-default" data-dismiss="modal" onClick="window.location.reload()">Cerrar</button>
  </div>
</div>
</div>
</div>
</div>


<script type="text/javascript">
$('.editActionButtonClick').click(function() {
  var departmentID = $(this).attr('id');

  if(departmentID != 'NULL' || departmentID != '') {
    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?=base_url('department/retrive_data')?>",
      data: "departmentID=" + departmentID,
      dataType: "html",
      success: function(data) {
        var response = jQuery.parseJSON(data);
        console.log(response);
        if(response.confirmation == 'success') {
          $('#id').val(response.id);
          $('#edit_dept_sort_name').val(response.dept_sort_name);
          $('#edit_dept_name').val(response.dept_name);

          /*update script */
          $('.editForDepartment').click(function() {
            var id = $('#id').val();
            var dept_sort_name = $('#edit_dept_sort_name').val();
            var dept_name = $('#edit_dept_name').val();
            $.ajax({
              type: 'POST',
              url: "<?=base_url('department/dept_update')?>",
              data: {'id' : id, 'dept_sort_name' : dept_sort_name, 'dept_name' : dept_name, },
              dataType: "html",
              success: function(data) {
                window.location.reload()
              }
            });
          });
        } else {
          $('#id').val('');
          $('#edit_dept_sort_name').val('');
          $('#edit_dept_name').val('');
        }

      }
    });
}
});

</script>
