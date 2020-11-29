<div class="row well" style="border:0px solid">
  <span style="font-size:16px;"><i class="fa fa-sitemap"></i> &nbsp;&nbsp; Agregar autoridad</span>
  <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Atras</span></a>
</div>

<div class="row well" style="border:0px solid">
  <form method="POST">
    <table class="table dt-responsive zero-border input-cus select-cus">
      <tbody>
        <tr hidden="hidden">
         <td>
           <label>DNI :</label>
         </td>
         <td>
           <input type="text" id="user_id" name="user_id" class="form-control" value="<?php echo maxUserID()?>"/>
         </td>
       </tr>

       <tr>
        <td>
          <label>Nombre completo:</label>
        </td>
        <td>
          <input type="text" id="fullName" name="user_full_name" class="form-control" placeholder="Nombre completo *" value="<?=set_value('user_full_name')?>"/>
        </td>
      </tr>
      <tr>
        <td>
          <label>Email :</label>
        </td>
        <td>
          <input type="text" id="authorEmailAddress" name="email_address" class="form-control" placeholder="Email *" value="<?=set_value('email_address')?>"/>
        </td>
      </tr>
      <tr>
        <td>
          <label>Nº de contacto. :</label>
        </td>
        <td>
          <input maxlength="14" type="text" id="authorContactNo" name="contact_no" class="form-control" placeholder="Nº de contacto * "value="<?=set_value('contact_no')?>"/>
        </td>
      </tr>
      <tr>
        <td>
          <label>Access type :</label>
        </td>
        <td>
          <select id="accesssType" class="form-control" style="border:0px;" name='access_type' value="<?=set_value('access_type')?>">
            <option value="0">Seleccione el tipo de acceso *</option>
            <option disabled>______________________</option>
            <option value="2">Autoridad</option>
            <option value="5">Bibliotecario</option>
          </select>
          <!-- <input type="text" class="form-control" id="usr"> -->
        </td>
      </tr>
    </tbody>
  </table>
  <hr>
  <h4>Información Entrar</h4>
  <table class="table dt-responsive zero-border input-cus select-cus">
    <tbody>
      <tr>
        <td >
          <label>Nombre de usuario :</label>
        </td>
        <td >
          <input type="text" id="authorUserName" name="user_name" class="form-control" placeholder="Nombre de usuario *" value="<?=set_value('user_name')?>"/>
          <span id="name_status"></span>
        </td>
      </tr>

      <tr>
        <td>
          <label>Contraseña :</label>
        </td>
        <td>
          <input type="Password" id="authorPassword" name="user_pass" class="form-control" placeholder="Contraseña *" value="<?=set_value('user_pass')?>" />
        </td>
      </tr>
      <tr>
        <td>
          <label>Confirmar contraseña :</label>
        </td>
        <td>
          <input type="Password" id="authorConfirmPassword" name="rp_user_pass" class="form-control" placeholder="Confirmar contraseña *" value="<?=set_value('rp_user_pass')?>"/>
        </td>
      </tr>
    </tbody>
  </table>

  <button type="submit" class="btn btn-default" ><span class="glyphicon glyphicon-save"></span> &nbsp; Guardar </button>
</form>
</div>



<!-- insert Authority user script module  -->
