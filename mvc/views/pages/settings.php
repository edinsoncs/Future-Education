<div class="row well" style="border:0px solid">
  <h4 style=" margin-top:0px; margin-bottom:0px;"><span style="font-size:16px;" class="showopacity glyphicon glyphicon-cog"></span> Configuraciones</h4>
</div>


<div class="row well" style="border:0px solid">
  <p class="well" style="padding:10px;">
    <span> <i class="fa fa-sitemap"></i> Autoridad </span>

    <a href="<?php echo base_url();?>settings/authority_add" ><span class="pull-right"><span> <i class="fa fa-plus-square"></i> Agregar nuevo</a>
  </p>

  <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
   <thead>

    <tr>
      <th>ID</th>
      <th> ID de usuario </th>
      <th> Nombre completo </th>
      <th> Correo electrónico </th>
      <th> Número de contacto </th>
      <th> Nombre de usuario </th>
      <th> Tipo de acceso </th>
      <th> Acción </th>
    </tr>
  </thead>
  <tbody>
    <?php  foreach ($authority_info as $row) : ?>
    <tr>
      <td><?php echo $row-> id; ?></td>
      <td><?php echo $row-> user_id; ?></td>
      <td><?php echo $row-> user_full_name; ?></td>
      <td><?php echo $row-> email_address; ?></td>
      <td><?php echo $row-> contact_no; ?></td>
      <td><?php echo $row-> user_name; ?></td>
      <td>
        <?php
        if(($row-> access_type)==1){
          echo "Admin";
        }
        elseif (($row-> access_type)==2) {
          echo "Authority";
        }elseif (($row-> access_type)==3) {
          echo "Teacher";
        } elseif(($row->access_type)==5) {
          echo "Librarian";
        }else {
          echo "Student";
        }
        ?>
      </td>
      <td>
        <?php  edit(base_url('authority/retrive_authority_data/'.$row-> id));?> &nbsp;
        <?php  del(base_url('authority/delete_authorized_user/'.$row-> id));?>
      </td>
    </tr>
  <?php  endforeach; ?>
</tbody>

</table>

</div>

<!--  Basic info     -->
<div class="row">

  <div class="col-md-7 well" style="border:0px solid">

    <p class="well" style="padding:10px;">
      <span class="glyphicon glyphicon-leaf"></span>&nbsp; Informe básico
      <a href="#" data-toggle="modal" data-target="#basicInfo" ><span class="pull-right"><span class="glyphicon glyphicon-edit"></span> &nbsp; Editar</a>
    </p>
    <table  class="table dt-responsive zero-border">
      <tbody>
        <tr>
          <td> Logotipo del sitio </td>
          <td>:</td>
          <td><img style="height:170px; width:170px;" src="<?php echo base_url( getSite()->site_logo);?>" /></td>
        </tr>
        <tr>
          <td> Nombre del sitio </td>
          <td>:</td>
          <td> <?php echo getSite()->name; ?></td>
        </tr>
        <tr>
          <td> Línea de etiqueta </td>
          <td>:</td>
          <td><?php echo getSite()->tag_line; ?></td>
        </tr>
        <tr>
          <td> Escala de calificación </td>
          <td>:</td>
          <td><?php echo getSite()->grade_scale; ?></td>
        </tr>
        <tr>
          <td> No de contacto </td>
          <td>:</td>
          <td><?php echo getSite()->contact_no; ?></td>
        </tr>
        <tr>
          <td>Email </td>
          <td>:</td>
          <td><?php echo getSite()->email_address; ?></td>
        </tr>
        <tr>
          <td> Dirección de ubicación </td>
          <td>:</td>
          <td><?php echo getSite()->address; ?></td>
        </tr>

      </tbody>
    </table>
    <br>
  </div>
  <!--  grade point    -->

  <div class=" col-md-5 col-sm-12 well pull-right-lg" style="border:0px solid">
    <p class="well" style="padding:10px; margin-bottom:2px;">
      <span class="glyphicon glyphicon-signal"></span>&nbsp; Tabla de calificaciones
      <a href="#" data-toggle="modal" data-target="#gradePoint" >

        <span class="pull-right"> <span class="glyphicon glyphicon-cog"></span>&nbsp;Configuraciones</a>
      </p>
      <p align="center">Punto de calificación en escala de <?php echo getSite()->grade_scale; ?></p>
      <table class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
       <thead>
        <tr>
         <th> Grado </th>
          <th> Punto de calificación </th>
          <th>marcas obtenidas ( % )</th>
        </tr>
      </thead>
      <tbody>
        <?php  foreach ($datarows as $row)  :  ?>
        <tr>
          <td class="capitalize"><?php echo $row-> gread; ?></td>
          <td><?php echo $row-> gread_point; ?></td>
          <td><?php echo $row-> form_mark;?> - <?php echo $row-> to_mark;?></td>
        </tr>
      <?php  endforeach; ?>
    </tbody>

  </table>


</div>

</div>


<!-- basic information model popup view -->
<div class="modal fade" id="basicInfo" role="dialog">
 <div class="modal-dialog">
   <!-- Modal content-->
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title"><span class="glyphicon glyphicon-leaf"></span>&nbsp; Informe básico</h4>
     </div>

     <div class="modal-body">
      <?php echo form_open_multipart('Settings/update_settings_data');?>
      <table  class="table dt-responsive zero-border">
       <tbody>
         <tr>
           <td> Logotipo del sitio </td>
           <td>:</td>
           <td>
             <?php echo form_upload('logo_pic'); ?>
           </td>
         </tr>
         <tr>
           <td> Nombre del sitio * </td>
           <td>:</td>
           <td>
             <?php
             $site_name = array(
               'id' => 'site_name_',
               'name' => 'site_name',
               'type' => 'text',
               'class' => 'form-control',
               'value'=>  getSite()->name
               );
             echo form_input($site_name);
             ?>
           </td>
         </tr>
         <tr>
           <td> Línea de etiqueta </td>
           <td>:</td>
           <td>
             <?php
             $tag_line = array(
               'id' => 'tag_line_',
               'name' => 'tag_line',
               'type' => 'text',
               'class' => 'form-control',
               'value'=>  getSite()->tag_line
               );
             echo form_input($tag_line);
             ?>
           </td>
         </tr>
         <tr>
           <td> Escala de calificación * </td>
           <td>:</td>
           <td>
             <?php
             $grade_scale = array(
               'id' => 'grade_scale_',
               'name' => 'grade_scale',
               'type' => 'text',
               'class' => 'form-control',
               'value'=>  getSite()->grade_scale
               );
             echo form_input($grade_scale);
             ?>
           </td>
         </tr>
         <tr>
           <td> Nº de contacto </td>
           <td>:</td>
           <td>
             <?php
             $contact_no = array(
               'id' => 'contact_no_',
               'name' => 'contact_no',
               'type' => 'text',
               'class' => 'form-control',
               'value'=>  getSite()->contact_no
               );
             echo form_input($contact_no);
             ?>
           </td>
         </tr>
         <tr>
           <td>Email </td>
           <td>:</td>
           <td>
             <?php
             $email_address = array(
               'id' => 'email_address_',
               'name' => 'email_address',
               'type' => 'text',
               'class' => 'form-control',
               'value'=>  getSite()->email_address
               );
             echo form_input($email_address);
             ?>
           </td>
         </tr>

         <tr>
           <td> Ubicación </td>
           <td>:</td>
           <td>
             <?php
             $address = array(
               'id' => 'address_',
               'name' => 'address',
               'type' => 'text',
               'class' => 'form-control',
               'value'=>  getSite()->address
               );
             echo form_input($address);
             ?>
           </td>
         </tr>

       </tbody>
     </table>

   </div>

   <div class="modal-footer">
     <button type="submit" class="btn btn-default">Actualizar</button>
     <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
   </div>
 </div>
 <?php echo form_close()?>
</div>
</div>



<!--close basic information model popup view -->
<!-- grade point model popup view -->
<div class="modal fade" id="gradePoint" role="dialog">
 <div class="modal-dialog">
   <!-- Modal content-->
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title">  <span class="glyphicon glyphicon-signal"></span>&nbsp; Tabla de calificaciones</h4>
     </div>

     <div class="modal-body">
       <!---Tab panel menu-------->
       <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Añadir</a></li>
        <li><a data-toggle="tab" href="#edit_gradepoint">Editar</a></li>
        <li><a data-toggle="tab" href="#delete_gradepoint">Eliminar</a></li>
      </ul>
      <div class="tab-content">
       <div id="home" class="tab-pane fade in active">

        <table class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
         <?php echo form_open('settings/add_gread_point');?>
         <thead>
          <tr>
            <th> Grado </th>
            <th> Punto de calificación </th>
            <th> Puntos obtenidos (%) </th>
            <th> Acción </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <?php
              $gread = array(
                'id' => 'gread',
                'name' => 'gread',
                'type' => 'text',
                'placeholder' => 'A+',
                'class' => 'form-control capitalize',
                );
              echo form_input($gread);
              ?>
              <?php echo form_error('gread', '<div class="error">', '</div>'); ?>
            </td>
            <td>
              <?php
              $gread_point = array(
                'id' => 'gread_point',
                'name' => 'gread_point',
                'type' => 'text',
                'placeholder' => '4.00',
                'class' => 'form-control',
                            // 'required'=>'required',
                );
              echo form_input($gread_point);
              ?>
              <?php echo form_error('gread_point', '<div class="error">', '</div>'); ?>
            </td>
            <td>
              <div class="input-group">
                <?php
                $from_marks = array(
                 'id' => 'from_marks',
                 'name' => 'from_marks',
                 'type' => 'text',
                 'placeholder' => 'Form',
                 'class' => 'form-control',
                    //'required'=>'required',
                 );
                echo form_input($from_marks);
                ?>
                <?php echo form_error('from_marks', '<div class="error">', '</div>'); ?>
                <div class="input-group-addon">-</div>
                <?php
                $to_marks = array(
                 'id' => 'to_marks',
                 'name' => 'to_marks',
                 'type' => 'text',
                 'placeholder' => 'To',
                 'class' => 'form-control',
                    //'required'=>'required',
                 );
                echo form_input($to_marks);
                ?>
                <?php echo form_error('to_marks', '<div class="error">', '</div>'); ?>
              </div>
            </td>
            <td>
             <button type="submit" class="btn btn-default">Add</button>
           </td>
           <?php echo form_close();?>
         </tr>
       </tbody>
     </table>
   </div>
   <!-------Tab panel edit gradepoint-------------->
   <div id="edit_gradepoint" class="tab-pane fade">
    <table class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th> Grado </th>
          <th> Punto de calificación </th>
          <th> Puntos obtenidos (%) </th>
          <th> Acción </th>
        </tr>
      </thead>
      <tbody>
        <?php  foreach ($datarows as $row)  :  ?>
        <tr id="<?php echo $row-> id;?>">
          <td>
            <?php
            $edit_grade = array(
             'id' => 'editForGradePoint_edit_grade_'.$row->id,
             'name' => 'edit_grade',
             'type' => 'text',
             'class' => 'form-control capitalize',
             'value'=> $row-> gread
             );
            echo form_input($edit_grade);
            ?>
          </td>
          <td>
            <?php
            $edit_point = array(
             'id' => 'editForGradePoint_edit_point_'.$row->id,
             'name' => 'edit_point',
             'type' => 'text',
             'class' => 'form-control capitalize',
             'value'=> $row-> gread_point
             );
            echo form_input($edit_point);
            ?>
          </td>
          <td>
            <div class="input-group">
              <?php
              $edit_form_marks = array(
               'id' => 'editForGradePoint_edit_form_marks_'.$row->id,
               'name' => 'edit_form_marks',
               'type' => 'text',
               'class' => 'form-control capitalize',
               'value'=> $row-> form_mark
               );
              echo form_input($edit_form_marks);
              ?>
              <div class="input-group-addon">-</div>
              <?php
              $edit_to_marks = array(
               'id' => 'editForGradePoint_edit_to_marks_'.$row->id,
               'name' => 'edit_to_marks',
               'type' => 'text',
               'class' => 'form-control capitalize',
               'value'=> $row-> to_mark
               );
              echo form_input($edit_to_marks);
              ?>
            </div>
          </td>
          <td>
           <button  id="<?=$row->id?>" class="btn btn-default editForGradePoint">Actualizar</button>
         </td>
       </tr>
     <?php  endforeach; ?>
   </tbody>
 </table>
</div>


<!---------delete tab panel------------>
<div id="delete_gradepoint" class="tab-pane fade">
  <table class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th> Grado </th>
        <th> Punto de calificación </th>
        <th> Puntos obtenidos (%) </th>
        <th> Acción </th>
      </tr>
    </thead>
    <tbody>
      <?php  foreach ($datarows as $row)  :  ?>
      <tr id="<?php echo $row-> id;?>">
        <td class="capitalize"><?php echo $row-> gread; ?></td>
        <td><?php echo $row-> gread_point; ?></td>
        <td><?php echo $row-> form_mark;?> - <?php echo $row-> to_mark;?></td>
        <td style="padding:2px;"><a id="<?php echo $row-> id;?>" href="<?php echo base_url();?>settings/delete_gread_point/<?php echo $row-> id;?>" onclick="return confirm('are you sure ?')"><button style=" margin:0px;" class="btn btn-default">Eliminar</button></a></td>
      </tr>
    <?php  endforeach; ?>
  </tbody>
</table>
</div>
</div>


</div>

<div class="modal-footer">
 <button type="button" class="btn btn-default" data-dismiss="modal" onClick="window.location.reload()">Cerrar</button>
</div>



</div>
</div>
</div>

<!--close grade point model popup view -->
<script type="text/javascript">
window.setTimeout(function() {
  $("#alert").fadeTo(500, 0).slideUp(500, function(){
    $(this).remove();
  });
}, 4000);
</script>
<!-- grade point update script module  -->
<script type="text/javascript">
$('.editForGradePoint').click(function() {
  var editID = $(this).attr('id');
      // var grade = $("#editForGradePoint_edit_grade_"+editID).val();

      $.ajax({
        type: 'POST',
        url: "<?=base_url('settings/update_grade_point')?>",
          // data:{"grade" : grade},
          data: {'editID' : editID, "grade" : $('#editForGradePoint_edit_grade_'+editID).val(), "point" : $('#editForGradePoint_edit_point_'+editID).val(), "frommark" : $('#editForGradePoint_edit_form_marks_'+editID).val(),  "tomark" : $('#editForGradePoint_edit_to_marks_'+editID).val()},
          dataType: "html",
          success: function(data) {
            if(data) {
              toastr.success(data, "Success");
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
            console.log(data);
          }
        });


});
</script>
