<div class="row well" style="border:0px solid">
    <span style="font-size:16px;"><i class="fa fa-sitemap"></i>&nbsp; &nbsp; Actualizar información de autoridad
</span>
    <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i><span>&nbsp; Back</a>
</div>

<div class="row well" style="border:0px solid">

    <?php foreach($authority_info as $row):
        echo form_open('Settings/authority_update_info/'.$row-> id);?>

    <table class="table dt-responsive zero-border input-cus select-cus">
      <tbody>
         <tr>
              <td>
                <label>Nombre completo *:</label>
              </td>
              <td>
                <input type="text" id="fullName" name="user_full_name" class="form-control" value="<?php echo $row-> user_full_name; ?>"/>
              </td>
          </tr>
          <tr>
              <td>
                <label>Email *:</label>
              </td>
              <td>
                <input type="text" id="authorEmailAddress" name="email_address" class="form-control" value="<?php echo $row-> email_address; ?>"/>
              </td>
          </tr>
          <tr>
              <td>
                <label>Nº de Contacto. *:</label>
              </td>
              <td>
                  <input maxlength="14" type="text" id="authorContactNo" name="contact_no" class="form-control" value="<?php echo $row-> contact_no; ?>"/>
              </td>
          </tr>
          <tr>
              <td>
                <label>Tipo de acceso :</label>
              </td>
              <td>
                  <select id="accesssType" class="form-control" style="border:0px;" name='access_type'>

                    <option value="<?php echo $row-> access_type; ?>">
                      <?php
                          if(($row-> access_type)==1){
                            echo "Administrator";
                          }
                          elseif (($row-> access_type)==2) {
                            echo "Authority";
                          }elseif (($row-> access_type)==3) {
                            echo "Teacher";
                          }elseif (($row-> access_type)==5) {
                          echo "Librarian";
                          }else {
                          echo "Student";
                          }
                     ?>
                    </option>
                    <?php if (($row->id)!= 1) { ?>
                    <option disabled="disabled">---------</option>
                    <option value="2">Autoridad</option>
                    <option value="5">Bibliotecario</option>
                    <?php } ?>
                  </select>


              </td>
          </tr>
       </tbody>

  </table>
<hr>

  <h4>Informe de inicio de sesión</h4>
  <h5><input type="checkbox" id="checkbox" name="checkbox"/> &nbsp; Cambia tu contraseña</h5>
  <table class="table dt-responsive zero-border input-cus select-cus" >

      <tbody>

        <tr>
            <td >
              <label>Nombre de usuario :</label>
            </td>
            <td >
              <input type="text" id="authorUserName" name="user_name" class="form-control" value="<?php echo $row-> user_name; ?>"/>
            </td>
        </tr>
      </tbody>
    </table>
    <table id="autoUpdate" class="table dt-responsive zero-border input-cus select-cus" >

            <tbody>

          <tr>
              <td>
                <label>Nueva contraseña :</label>
              </td>
              <td>
                <input type="Password" id="authorPassword" name="user_pass" class="form-control" placeholder="Nueva Contraseña " />
              </td>
          </tr>
          <tr>
              <td>
                <label>Confirmar contraseña :</label>
              </td>
              <td>
                <input type="Password" id="authorConfirmPassword" name="rp_user_pass" class="form-control" placeholder="Confirmar contraseña"/>
              </td>
          </tr>
       </tbody>
  </table>

<button type="submit" class="btn btn-default" ><span class="glyphicon glyphicon-save"></span>&nbsp; Actualizar </button>
<?php echo form_close(); endforeach; ?>
</div>


<!-- insert Authority user script module  -->
<script type="text/javascript">

$(document).ready(function () {
  $("#autoUpdate").hide();
    $('#checkbox').change(function () {
      if($(this).is(":checked")){
           $('#autoUpdate').show('slow');
         }
        else
            $('#autoUpdate').hide('slow');
    });
});
</script>
