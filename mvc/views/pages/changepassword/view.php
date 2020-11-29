<div class="row well" style="border:0px solid">
    <span style="font-size:16px;"><i class="fa fa-exchange"></i> &nbsp;&nbsp; Cambia la contraseña
</span>
    <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Atras</span></a>
</div>

<div class="col-md-6 col-sm-8 col-xs-12 col-center" >
  <?php  echo form_open('changepassword/newpassword/'.$this->session->userdata('user_id'));?>

  <div>
     <table  class="table dt-responsive zero-border">
        <tbody>
          <tr>
              <td>contraseña actual</td>
              <td>:</td>
              <td><input type="password" class="form-control "  name='current_password' id="current_password"/></td>
          </tr>
          <tr>
              <td>Nueva contraseña</td>
              <td>:</td>
              <td><input type="password" class="form-control "  name='new_password' id="new_password"/></td>
          </tr>
          <tr>
              <td>Repita la nueva contraseña</td>
              <td>:</td>
              <td><input type="password" class="form-control "  name='rective_password' id="rective_password"/></td>
          </tr>
         </tbody>
      <?php echo form_close();?>
    </table>
  </div>
  <div class="pull-right">
    <button type="submit" class="btn btn-default">Cambio</button>
  </div>
</div>
