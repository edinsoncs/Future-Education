<div class="row well" style="border:0px solid">
  <span style="font-size:16px;"><i class="fa fa-bus"></i>&nbsp;&nbsp; Transporte</span>
  <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Atras</span></a>
</div>

<div class="row well">
  <p class="well" style="padding:10px;">
    <span> <i class="fa fa-bus"></i>&nbsp;&nbsp; Información de ruta </span>

    <a href="#" data-toggle="modal" data-target="#addNotice"><span class="pull-right"> <i class="fa fa-plus-square"></i>&nbsp; Agregar nuevo</span></a>
  </p>

  <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th> Ruta </th>
        <th> Número de vehículo </th>
        <th> Hora de salida </th>
        <th> Tarifa anual </th>
        <th> Día libre </th>
      </tr>
    </thead>
    <tbody>
      <?php  $i = 1; foreach ($get_data as $row) : ?>
      <tr>
        <td><?php echo $i; $i++; ?></td>
        <td><?php echo $row->route_from;?> <b>To</b> <?php echo $row->route_to;?></td>
        <td><?php echo $row->vehicle_no;?></td>
        <td><?php echo $row->departure_time;?></td>
        <td><?php echo $row->yearly_fare;?></td>
        <td><?php echo $row->off_day;?></td>
      </tr>
      <?php  endforeach; ?>
    </tbody>
  </table>
</div>