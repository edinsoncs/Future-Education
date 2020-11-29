<div class="row well" style="border:0px solid">
    <span style="font-size:16px;"><i class="fa fa-users"></i> &nbsp;&nbsp; Información para miembros de la biblioteca
</span>
    <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Atrás</span></a>
</div>

<div class="row well" style="border:0px solid">
    <p class="well" style="padding:10px;">
      <span> <i class="fa fa-users"></i> Miembros </span>
    </p>

    <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
      <thead>

            <tr>
                <th>ID</th>
                <th> DNI Estudiante </th>
                <th> Nombre </th>
                <th> Departamento </th>
                <th> Lote </th>
                <th> Sección </th>
                <th> Estado </th>
                <th> Correo electrónico </th>
                <th> Número de contacto </th>
                <th> Acción </th>
            </tr>
        </thead>
        <tbody>
          <?php  foreach ($get_info as $row) : ?>
            <tr>
                <td><?php echo $row-> id; ?></td>
                <td><?php echo $row-> std_id; ?></td>
                <td class="capitalize limitationCharacters"><?php echo $row-> std_name; ?></td>
                <td class="uppercase"><?php echo $row-> std_dept; ?></td>
                <td><?php echo $row-> std_batch; ?></td>
                <td><?php echo $row-> std_section; ?></td>
                <td>
                  <?php
                      if (($row-> std_status)==1) {
                        echo "Regular";
                      }elseif (($row-> std_status)==2) {
                        echo "Irregular";
                      }else
                        echo "Complete";
                    ?>
                </td>
                <td><?php echo $row-> std_email_address; ?></td>
                <td><?php echo $row-> std_contact_no; ?></td>

                <td>
                 
                  <!--activate button  -->
                  <?php if (($row->library_access) != 0) { ?>
                      <?php  view(base_url('library/details/'.$row->std_display_id));?> &nbsp;
                      <?php  clearance($row->std_display_id);?> &nbsp;
                      <?php  activate_btn(base_url('library/deactivate/'.$row->std_display_id));?> &nbsp;
                    <?php }else { ?>
                      <?php  view(base_url('library/details/'.$row->std_display_id));?> &nbsp;
                      <?php  clearance($row->std_display_id);?> &nbsp;
                      <?php  deactivate_btn(base_url('library/activate/'.$row->std_display_id));?> &nbsp;
                  <?php } ?>

                </td>
            </tr>
            <?php  endforeach; ?>
         </tbody>

    </table>

</div>



<!-- clearance modal-->
<div class="modal fade" id="clearance" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-smile-o"></i></span>&nbsp;Liquidación de la biblioteca</h4>
      </div>
      <div class="modal-body">
        <table  class="table dt-responsive zero-border">
          <tbody id="showData" style="border:1px solid#ccc;">
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" id="updateData" value="" class="btn btn-default updateForDueDate">Print</button> -->
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>





<script type="text/javascript">
// for text limitation script
$(document).ready(function() {
  $(".limitationCharacters").each(function(i){
    len=$(this).text().length;
    if(len>18)
    {
      $(this).text($(this).text().substr(0,18)+' ...');
    }
  });
});


// clearance script
$('.clearance').click(function() {
  var getID = $(this).attr('id');
  if(getID != 'NULL' || getID != '') {
    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?=base_url('Library/clearance_data')?>",
      data: {'getID' : getID},
      dataType: "html",
      success: function(data) {
        $('#showData').html(data);
      }
    });
  } 
});



</script>