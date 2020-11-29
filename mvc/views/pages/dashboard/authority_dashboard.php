<br>
<div class="row">
  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
    <div class="alert alert-info" style="min-height:134px;">
      <h3 align="center">Profesores</h3>
      <h3 align="center">
        <b>
          <?php foreach ($total_teacher as $teachers) { echo $teachers->teachers; } ?>
      </b>
    </h3>
    </div>
  </div>
  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
    <div class="alert alert-info" style="min-height:134px;">
      <h3 align="center">Total de estudiantes</h3>
      <h3 align="center">
        <b>
          <?php foreach ($total_student as $student) { echo $student->student; } ?>
        </b>
      </h3>
    </div>
  </div>
  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
    <div class="alert alert-info" style="min-height:134px;">
      <h3 align="center">Graduación</h3>
      <h3 align="center">
        <b>
          <?php foreach ($total_graduation as $graduation_std) { echo $graduation_std->graduation_std; } ?>
        </b>
      </h3>
    </div>
  </div>
</div>



<div>
  <div class=" col-md-8 well " style="border:0px solid">
    <p class="well" style="padding:10px; margin-bottom:2px;">
      <span class="fa fa-user"></span>&nbsp; Información básica
    </p>
    <div class="col-md-12"><br>
      <?php if (isset($get_info)) { ?>
      <p class="capitalize"><b>Nombre :</b> <?php echo $get_info->user_full_name;?> </p>
      <p><b>Email :</b> <?php echo $get_info->email_address;?></p>
      <p><b>Contacto Nº :</b> <?php echo $get_info->contact_no;?></p>
      <?php }?>
    </div>
  </div>
  <div class=" col-md-4 col-sm-12 well pull-right-lg" style="border:0px solid">
    <p class="well" style="padding:10px; margin-bottom:2px;">
      <span class="glyphicon glyphicon-signal"></span>&nbsp; Tabla de calificaciones
    </p>
    <p align="center">Punto de calificación en escala de <?php echo getSite()->grade_scale; ?></p>

    <table class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%" style="font-size:14px;">
      <thead>
          <tr>
              <th> Grado </th>
              <th>Punto de calificación</th>
              <th>Marcas obtenidas ( % )</th>
          </tr>
      </thead>
      <tbody>
        <?php  foreach ($get_grade_point_table as $point_table)  :  ?>
          <tr>
              <td class="capitalize" ><?php echo $point_table-> gread;?></td>
              <td><?php echo $point_table-> gread_point; ?></td>
              <td><?php echo $point_table-> form_mark;?> - <?php echo $point_table-> to_mark;?></td>
          </tr>
          <?php  endforeach; ?>
       </tbody>
    </table>
  </div>

  <div class=" col-md-8 well " style="border:0px solid">
    <?php $this->load->view('layout/calendar.php'); ?></br>
  </div>
</div>
