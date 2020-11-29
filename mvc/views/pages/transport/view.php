
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
      <th> Acción </th>
    </tr>
  </thead>
  <tbody>
    <?php  foreach ($get_data as $row) : ?>
    <tr>
      <td><?php echo $row->id; ?></td>
      <td><?php echo $row->route_from;?> <b>To</b> <?php echo $row->route_to;?></td>
      <td><?php echo $row->vehicle_no;?></td>
      <td><?php echo $row->departure_time;?></td>
      <td><?php echo $row->yearly_fare;?></td>
      <td><?php echo $row->off_day;?></td>
      <td>
        <?php  edited($row->id);?>&nbsp;
        <?php  del(base_url('transport/delete_data/'.$row-> id));?>
      </td>
    </tr>
  <?php  endforeach; ?>
</tbody>
</table>

<!-- add new modal  -->
<div class="modal fade" id="addNotice" role="dialog">
 <div class="modal-dialog">
   <!-- Modal content-->
   <div class="modal-content">
     <?php echo form_open('transport/add_new');?> 
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title"><i class="fa fa-bus"></i>&nbsp; Nueva ruta</h4>
     </div>
     <div class="modal-body">
      <table  class="table dt-responsive zero-border">
       <tbody>
        <tr>
         <td>
          <div class="col-md-12 top-left-paddign">
            <div class="col-md-3">Ruta :</div>
            <div class="col-md-9 input-group left-right-paddign">
              <input type="text" class="form-control" id="route_from" name="route_from" placeholder="Desde *"/>
              <span class="input-group-addon"> A </span>
              <input type="text" class="form-control" id="route_to" name="route_to" placeholder="A *"/>
            </div>
          </div>
        </td>
      </tr>
      <tr>
       <td>
        <div class="col-md-12 top-left-paddign">
          <div class="col-md-3">Número de vehículo :</div>
          <div class="col-md-9">
            <input type="text" class="form-control" id="vehicle_no" name="vehicle_no" placeholder="Ej: 2"/>
          </div>
        </div>
      </td>
    </tr>
    <tr>
     <td>
       <div class="col-md-12 top-left-paddign">
        <div class="col-md-3">Hora de salida :</div>
        <div class="col-md-9">
          <input type="text" class="form-control" id="departure_time" name="departure_time" placeholder="Ej .: 9:00 AM, 9:30 AM "/>
        </div>
      </div>
    </td>
  </tr>
  <tr>
   <td>
     <div class="col-md-12 top-left-paddign">
      <div class="col-md-3">Tarifa anual :</div>
      <div class="col-md-9">
        <input type="text" class="form-control" id="yearly_fare" name="yearly_fare" placeholder="Ej: Ninguno / Monto ($ 100) "/>
      </div>
    </div>
  </td>
</tr>
<tr>
 <td>
   <div class="col-md-12 top-left-paddign">
    <div class="col-md-3">Día libre :</div>
    <div class="col-md-9">
      <select type="text" class="form-control" id="off_day" name="off_day">
        <option value="Ninguno">Ninguno</option>
        <option value="Domingo">Domingo</option>
        <option value="Lunes">Lunes</option>
        <option value="Martes">Martes</option>
        <option value="Miercoles">Miercoles</option>
        <option value="Jueves">Jueves</option>
        <option value="Viernes">Viernes</option>
        <option value="Sabado">Sabado</option>
      </select>
    </div>
  </div>
</td>
</tr>
</tbody>
</table>
</div>
<div class="modal-footer">
 <button type="submit" class="btn btn-default">Crear</button>
 <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>
<?php echo form_close()?>
</div>
</div>
</div>

<!--update modal-->
<div class="modal fade" id="dept_Update" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-envelope-o"></i></span>&nbsp; Aviso de actualización</h4>
      </div>

      <div class="modal-body">
       <table  class="table dt-responsive zero-border">
        <table  class="table dt-responsive zero-border">
         <tbody>
          <tr hidden="hidden">
           <td>
            <input type="text" class="form-control" id="e_id" name="e_id" disabled="true"/>
          </td>
        </tr>
        <tr>
         <td>
          <div class="col-md-12 top-left-paddign">
            <div class="col-md-3">Ruta :</div>
            <div class="col-md-9 input-group left-right-paddign">
              <input type="text" class="form-control" id="e_route_from" name="e_route_from" placeholder="From *"/>
              <span class="input-group-addon"> A </span>
              <input type="text" class="form-control" id="e_route_to" name="e_route_to" placeholder="To *"/>
            </div>
          </div>
        </td>
      </tr>
      <tr>
       <td>
        <div class="col-md-12 top-left-paddign">
          <div class="col-md-3">Número de vehículo :</div>
          <div class="col-md-9">
            <input type="text" class="form-control" id="e_vehicle_no" name="e_vehicle_no" placeholder="Ex: 2 "/>
          </div>
        </div>
      </td>
    </tr>
    <tr>
     <td>
       <div class="col-md-12 top-left-paddign">
        <div class="col-md-3">Hora de salida :</div>
        <div class="col-md-9">
          <input type="text" class="form-control" id="e_departure_time" name="e_departure_time" placeholder="Ex: 9:00AM, 9:30AM "/>
        </div>
      </div>
    </td>
  </tr>
  <tr>
   <td>
     <div class="col-md-12 top-left-paddign">
      <div class="col-md-3">Tarifa anual :</div>
      <div class="col-md-9">
        <input type="text" class="form-control" id="e_yearly_fare" name="e_yearly_fare" placeholder="Ex: None / Amount ($100) "/>
      </div>
    </div>
  </td>
</tr>
<tr>
 <td>
   <div class="col-md-12 top-left-paddign">
    <div class="col-md-3">Día libre :</div>
    <div class="col-md-9">
      <select type="text" class="form-control" id="e_off_day" name="off_day">
        <option value="Ninguno">Ninguno</option>
        <option value="Domingo">Domingo</option>
        <option value="Lunes">Lunes</option>
        <option value="Martes">Martes</option>
        <option value="Miercoles">Miercoles</option>
        <option value="Jueves">Jueves</option>
        <option value="Viernes">Viernes</option>
        <option value="Fotos">Fotos</option>
      </select>
    </div>
  </div>
</td>
</tr>
</tbody>
</table>
</div>
<div class="modal-footer">
  <button type="button" id="updateData" value="" class="btn btn-default editForNotice">Actualizar</button>
  <button type="button" class="btn btn-default" data-dismiss="modal" onClick="window.location.reload()">Cerrar</button>
</div>
</div>
</div>
</div>
</div>


<script type="text/javascript">

// update notice
$('.editActionButtonClick').click(function() {
  var getID = $(this).attr('id');

  if(getID != 'NULL' || getID != '') {
    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?=base_url('transport/retrive_data_for_update')?>",
      data: "getID=" + getID,
      dataType: "html",
      success: function(data) {
        var response = jQuery.parseJSON(data);
        console.log(response);
        if(response.confirmation == 'success') {
          $('#e_id').val(response.id);
          $('#e_route_from').val(response.route_from);
          $('#e_route_to').val(response.route_to);
          $('#e_vehicle_no').val(response.vehicle_no);
          $('#e_departure_time').val(response.departure_time);
          $('#e_yearly_fare').val(response.yearly_fare);
          $('#e_off_day').val(response.off_day);

          /*update script */
          $('.editForNotice').click(function() {
            var id = $('#e_id').val();
            var route_from = $('#e_route_from').val();
            var route_to = $('#e_route_to').val();
            var vehicle_no = $('#e_vehicle_no').val();
            var departure_time = $('#e_departure_time').val();
            var yearly_fare = $('#e_yearly_fare').val();
            var off_day = $('#e_off_day').val();
            $.ajax({
              type: 'POST',
              url: "<?=base_url('transport/data_update')?>",
              data: {'id' : id,'route_from' : route_from, 'route_to' : route_to, 'vehicle_no' : vehicle_no, 'departure_time' : departure_time,'yearly_fare' : yearly_fare,'off_day' : off_day,},
              dataType: "html",
              success: function(data){
                // if(data) {
                //   toastr.success(data, "Success");
                //   toastr.options = {
                //     "closeButton": false,
                //     "debug": false,
                //     "newestOnTop": false,
                //     "progressBar": true,
                //     "positionClass": "toast-bottom-right",
                //     "preventDuplicates": false,
                //     "onclick": null,
                //     "showDuration": "300",
                //     "hideDuration": "1000",
                //     "timeOut": "5000",
                //     "extendedTimeOut": "1000",
                //     "showEasing": "swing",
                //     "hideEasing": "linear",
                //     "showMethod": "fadeIn",
                //     "hideMethod": "fadeOut"
                //   }
                // }
                window.setTimeout(function(){location.reload()},0)
              }
            });
          });
        } else {
          $('#e_id').val('');
          $('#e_route_from').val('');
          $('#e_route_to').val('');
          $('#e_vehicle_no').val('');
          $('#e_departure_time').val('');
          $('#e_yearly_fare').val('');
          $('#e_off_day').val('');
        }
      }
    });
  }
});
</script>
