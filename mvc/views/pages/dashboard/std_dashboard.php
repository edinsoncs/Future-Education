
<br>
<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
    <div class="alert alert-info">
      <h3 align="center">Crédito requerido</h3>
      <h3 align="center">
        <b>
          <?php if (isset($required_credit)) {
              echo $required_credit->required_credit;
          }?>
        </b>
      </h3>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
    <div class="alert alert-info" style="min-height:134px;">
      <h3 align="center">Reputacion</h3>
      <h3 align="center">
        <b>
          <?php foreach($get_waiver as $value) {
            if (($value->sub_credit)!= 0) {
              echo $value->sub_credit;
            }else {
            echo "0";
            }

          }
          ?>
      </b>
    </h3>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
    <div class="alert alert-info" style="min-height:134px;">
      <h3 align="center">Creditos Obtenidos</h3>
      <h3 align="center">
        <b>
          <?php echo $get_earn_credit; ?>
        </b>
      </h3>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
    <div class="alert alert-info" style="min-height:134px;">
      <h3 align="center">Puntaje actual</h3>
      <h3 align="center">
        <b>
          <?php if(isset($get_cgpa_point)) {
            echo $get_cgpa_point;
            }
          ?>
        </b>
      </h3>
    </div>
  </div>
</div>


<div>
  <div class=" col-md-8 well " style="border:0px solid">
    <p class="well" style="padding:10px; margin-bottom:2px;">
      <span class="fa fa-users"></span>&nbsp; Información básica
    </p>
    <div class="col-md-12">
      <?php if (isset($get_basic_info)) { ?>
      <p class="capitalize"><b>Nombre :</b> <?php echo $get_basic_info->std_name;?> </p>
      <p class="capitalize"><b>Identificación del Estudiante :</b> <?php echo $get_basic_info->std_id;?> </p>
      <p class="capitalize"><b>Departamento :</b> <?php if(isset($get_degree_objective)){ echo $get_degree_objective->dept_name;}?> </p>
      <p><b>Batch :</b> <?php echo $get_basic_info->std_batch;?></p>
      <p><b>Sección :</b> <?php echo $get_basic_info->std_section;?></p>
      <p><b>Email :</b> <?php echo $get_basic_info->std_email_address;?></p>
      <p><b>Nº de Contacto :</b> <?php echo $get_basic_info->std_contact_no;?></p>
      <?php }?>
    </div>
  </div>

  <div class=" col-md-4 col-sm-12 well pull-right-lg" style="border:0px solid">
    <p class="well" style="padding:10px; margin-bottom:2px;">
      <span class="glyphicon glyphicon-stats"></span>&nbsp; Estado actual
    </p>
    <div class="col-md-12">
      <p><b>Estado :</b>
        <?php if (isset($get_basic_info)){
          if(($get_basic_info->std_status)==1){
              echo "Active";
              } else {
              echo "Inactive";
            }
         }
         ?>
      </p>
      <p><b>Obtener el código del último semestre:</b> <?php if (isset($get_running_semester_code)){ echo $get_running_semester_code->semester_code;}?></p>
      <p><b>Get Credit :</b>
        <?php if (isset($get_last_semester_credit))  if($get_last_semester_credit != '') { echo $get_last_semester_credit->sub_credit; }  ?>
      </p>
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
              <th> Punto de calificación </th>
              <th> Puntos obtenidos ( % ) </th>
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
