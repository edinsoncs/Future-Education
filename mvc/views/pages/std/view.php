<div class="row well" style="border:0px solid">
    <span style="font-size:16px;"><i class="fa fa-users"></i> &nbsp;&nbsp; Información de los estudiantes</span>
    <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Atras</span></a>
</div>

<div class="row well" style="border:0px solid">
    <p class="well" style="padding:10px;">
      <span> <i class="fa fa-users"></i> Estudiantes </span>

      <a href="<?php echo base_url('students/addNew');?>" ><span class="pull-right"><span> <i class="fa fa-plus-square"></i> Agregar nuevo</a>
    </p>

    <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
      <thead>

            <tr>
                <th>ID</th>
                <th>DNI Estudiante</th>
                <th>Nombre</th>
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
                  <?php  edit(base_url('students/edit_student/'.$row->std_display_id));?> &nbsp;

                  <!--activate button  -->
                  <?php if (($row->access_type)!=0) { ?>
                      <?php  activate_btn(base_url('students/deactivate/'.$row->std_display_id));?> &nbsp;
                    <?php }else { ?>
                      <?php  deactivate_btn(base_url('students/activate/'.$row->std_display_id));?> &nbsp;
                  <?php } ?>

                  <!-- complete graduation button  -->
                  <?php if (($row->std_complete_graduation)!=0) { ?>
                      <?php  complete_btn(base_url('students/complete_btn/'.$row->std_display_id));?> &nbsp;
                    <?php }else { ?>
                      <?php  running_btn(base_url('students/running_btn/'.$row->std_display_id));?> &nbsp;
                  <?php } ?>

                  <!-- <?php  del(base_url('authority/delete_authorized_user/'.$row-> std_display_id));?> -->
                </td>
            </tr>
            <?php  endforeach; ?>
         </tbody>

    </table>

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
</script>