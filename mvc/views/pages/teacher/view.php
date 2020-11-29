<div class="row well" style="border:0px solid">
    <span style="font-size:16px;"><i class="fa fa-user"></i> &nbsp;&nbsp; Informaciones de los maestros</span>
    <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Back</span></a>
</div>

<div class="row well" style="border:0px solid">
    <p class="well" style="padding:10px;">
      <span> <i class="fa fa-user"></i> Profesores </span>

    <a href="<?php echo base_url('teachers/add_teacher');?>" ><span class="pull-right"><span> <i class="fa fa-plus-square"></i> Agregar nuevo</a>
    </p>

    <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
      <thead>

            <tr>
                <th>ID</th>
                <th>DNI</th>
                <th> Nombre completo </th>
                <th> Designación </th>
                <th> Departamento </th>
                <th> Correo electrónico </th>
                <th> Número de contacto </th>
                <th> Nombre de usuario </th>
                <!-- <th> Tipo de acceso </th> -->
                <th> Acción </th>
            </tr>
        </thead>
        <tbody>
          <?php  foreach ($teacher_info as $row) : ?>
            <tr>
                <td><?php echo $row-> id; ?></td>
                <td><?php echo $row-> display_id; ?></td>
                <td class="capitalize limitationCharacters"><?php echo $row-> teacher_name; ?></td>
                <td class="capitalize"><?php echo $row-> teacher_designation; ?></td>
                <td class="uppercase"><?php echo $row-> teacher_department; ?></td>
                <td><?php echo $row-> email_address; ?></td>
                <td><?php echo $row-> contact_no; ?></td>
                <td><?php echo $row-> user_name; ?></td>
                <!-- <td>
                  <?php
                  if(($row-> access_type)==1){
                    echo "Admin";
                  }elseif (($row-> access_type)==2) {
                  echo "Authority";
                  }elseif (($row-> access_type)==3) {
                  echo "Teacher";
                  }else {
                  echo "Student";
                  }
                 ?>
               </td> -->
                <td>
                  <?php  edit(base_url('teachers/retrive_data/'.$row->display_id));?> &nbsp;

                  <?php if (($row->access_type)!=0) { ?>
                      <?php  activate_btn(base_url('teachers/deactivate/'.$row->display_id));?> &nbsp;
                    <?php }else { ?>
                      <?php  deactivate_btn(base_url('teachers/activate/'.$row->display_id));?> &nbsp;
                  <?php } ?>

                  <?php  del(base_url('teachers/delete_teachers_data/'.$row->display_id));?>
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
