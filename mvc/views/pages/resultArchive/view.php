<div class="row well" style="border:0px solid">
  <span style="font-size:16px;"><i class="fa fa-graduation-cap"></i> &nbsp;&nbsp;Archivo de resultados</span>
  <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Atrás</span></a>
</div>

<div class="col-md-8 col-sm-10 col-xs-12 col-center">
  <?php if(isset($semester_code)){
    if (($semester_code->action) != 1) {?>
    <div class="alert-info" style="text-align: center; padding:15px;">
      <h4>Si desea publicar los resultados de <?php echo $semester_code->semester_code;?> semestre, luego haga clic en el botón Publicar</h4>
      <?php publish(base_url('resultArchive/publish_result/'.$semester_code->semester_code));?>
    </div>
    <?php } else { ?>
    <div class="alert-info" style="text-align: center; padding:15px;">
      <h4>Si desea retirar los resultados de <?php echo $semester_code->semester_code;?> semestre, luego haga clic en el botón Retirar</h4>
      <?php withdraw(base_url('resultArchive/withdrow_result/'.$semester_code->semester_code));?>
    </div>
    <?php }}?>

  </div>
</br>

<div class="row well" style="border:0px solid">
  <p class="well" style="padding:10px;">
    <span> <i class="fa fa-book"></i>&nbsp; Resumen de los resultados</span>
  </p>
  <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
   <thead>
    <tr>
      <th>ID</th>
      <th>DNI </th>
      <th>Nombre del estudiante </th>
      <th>Dept</th>
      <th>Batch</th>
      <th>Req. crédito</th>
      <th>Crédito ganado </th>
      <th>crédito de renuncia </th>
      <th>CGPA</th>
      <th>Acción</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($get_std_result as $row) { ?>
    <tr>
      <td><?=$row->id;?></td>
      <td ><?=$row->std_id;?></td>
      <td class="capitalize"><?=$row->std_name;?></td>
      <td class="uppercase"><?=$row->std_dept;?></td>
      <td class="uppercase"><?=$row->std_batch;?></td>
      <td><?=$row->required_credit;?></td>
      <td><?=$row->credit;?></td>
      <?php foreach ($show_std_waiver as $waiver) {
        if ($row->std_display_id === $waiver->std_display_id) { ?>
        <td><?=$waiver->waiver_credit;?></td>
        <?php  } else { ?>
        <td>0</td>
        <?php } } ?>
        <td>
          <?php
          $calculat_cgpa = $row->point/$row->credit;
          echo $CGPA = number_format($calculat_cgpa, 3);
          ?>
        </td>
        <td>
          <?php view(base_url('resultArchive/view_marksheet/'.$row->std_display_id));?>
          <!-- complete graduation button  -->
          <?php 

          foreach ($get_info as $value) {
            if (($value->std_display_id) == ($row->std_display_id)) {

              
              if (($value->std_complete_graduation)!=0) { ?>
              <?php  complete_btn(base_url('resultArchive/complete_btn/'.$row->std_display_id));?> &nbsp;
              <?php }else { ?>
              <?php  running_btn(base_url('resultArchive/running_btn/'.$row->std_display_id));?> &nbsp;
              <?php } } }?>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
