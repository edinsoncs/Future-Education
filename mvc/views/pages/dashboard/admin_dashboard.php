<br>
<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
    <div class="alert alert-info" style="min-height:134px;">
      <h3 align="center">Autoridad</h3>
      <h3 align="center">
        <b>
          <?php foreach ($total_authority as $authority) { echo $authority->authority; } ?>
        </b>
      </h3>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
    <div class="alert alert-info" style="min-height:134px;">
      <h3 align="center">Profesores</h3>
      <h3 align="center">
        <b>
          <?php foreach ($total_teacher as $teachers) { echo $teachers->teachers; } ?>
      </b>
    </h3>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
    <div class="alert alert-info" style="min-height:134px;">
      <h3 align="center">Estudiantes</h3>
      <h3 align="center">
        <b>
          <?php foreach ($total_student as $student) { echo $student->student; } ?>
        </b>
      </h3>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
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
<!--  Basic info     -->
<div class="row">
  <div class="col-md-7 well" style="border:0px solid">

      <p class="well" style="padding:10px;">
        <span class="glyphicon glyphicon-leaf"></span>&nbsp; Información básica
      </p>
      <table  class="table dt-responsive zero-border">
          <tbody>
            <tr>
                <td>Logotipo del campus</td>
                <td> </td>
                <td><img style="height:170px; width:170px;" src="<?php echo base_url( getSite()->site_logo);?>" /></td>
            </tr>
              <tr>
                  <td>Nombre del campus</td>
                  <td>:</td>
                  <td> <?php echo getSite()->name; ?></td>
              </tr>
              <tr>
                  <td>Línea de etiqueta</td>
                  <td>:</td>
                  <td><?php echo getSite()->tag_line; ?></td>
              </tr>
              <tr>
                  <td>Escala de calificación</td>
                  <td>:</td>
                  <td><?php echo getSite()->grade_scale; ?></td>
              </tr>
              <tr>
                  <td>Contacto No.</td>
                  <td>:</td>
                  <td><?php echo getSite()->contact_no; ?></td>
              </tr>
              <tr>
                  <td>Email </td>
                  <td>:</td>
                  <td><?php echo getSite()->email_address; ?></td>
              </tr>
              <tr>
                  <td>Ubicación</td>
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
      </p>
      <p align="center">Punto de calificación en escala de <?php echo getSite()->grade_scale; ?></p>
      <table class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
      <thead>
            <tr>
                <th>Grado </th>
                <th>Punto de calificación</th>
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
