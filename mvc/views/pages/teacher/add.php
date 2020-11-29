<div class="row well" style="border:0px solid">
  <span style="font-size:16px;"><i class="fa fa-user"></i> &nbsp;&nbsp; Agregar nuevos maestros</span>
  <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Atras</span></a>
</div>

<div class="row well" style="border:0px solid">

  <form method="POST">
    <table class="table dt-responsive zero-border input-cus select-cus">
      <tbody>
        <tr>
         <td>
           <label>Display ID :</label>
         </td>
         <td hidden="hidden">
           <input type="text" id="user_id" name="user_id" class="form-control" value="<?php echo maxUserID()?>"/>
         </td>
         <td>
           <input type="text" id="userId" name="userId" class="form-control" value="<?php echo maxUserID()?>" disabled="disabled"/>
         </td>
       </tr>

       <tr>
        <td>
          <label>Nombre completo :</label>
        </td>
        <td>
          <input type="text" id="fullName" name="user_full_name" class="form-control capitalize" placeholder="Nombre completo *" value="<?=set_value('user_full_name')?>"/>
        </td>
      </tr>
      <tr>
       <td>
         <label>Designacion :</label>
       </td>
       <td>
         <input type="text" id="teacher_designation" name="teacher_designation" class="form-control capitalize" placeholder="Designacion *" value="<?=set_value('teacher_designation')?>"/>
       </td>
     </tr>
     <tr>
      <td>
        <label>Departmento :</label>
      </td>
      <td>
        <select type="text" id="teacher_department" name="teacher_department" class="form-control uppercase" placeholder="Departmento *">
          <?php foreach ($dept as $row) { ?>
          <option value="<?= $row->dept_sort_name?>"><?= $row->dept_sort_name?></option>
          <?php } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>
        <label>Fecha de ingreso :</label>
      </td>
      <td>
        <input type="text" id="date_of_join" name="date_of_join" class="form-control" placeholder="Fecha de ingreso *" value="<?=set_value('date_of_join')?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label>Género :</label>
      </td>
      <td>
        <select name='teacher_gender' id="teacher_gender" class="form-control">
          <option value="0">Sexo</option>
          <option value="Hombre">Hombre</option>
          <option value="Mujer">Mujer</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>
        <label>Nacimiento :</label>
      </td>
      <td>
        <select name='teacher_religion' id="teacher_religion" class="form-control" >
          <option value="Amazonas">Amazonas</option>
          <option value="Ancash">Ancash</option>
          <option value="Apurímac">Apurímac</option>
          <option value="Arequipa">Arequipa</option>
          <option value="Ayacucho">Ayacucho</option>
          <option value="Cajamarca">Cajamarca</option>
          <option value="Callao">Callao</option>
          <option value="Cuzco">Cuzco </option>
          <option value="Huancavelica">Huancavelica</option>
          <option value="Huánuco">Huánuco</option>
          <option value="Ica">Ica</option>
          <option value="Junín">Junín</option>
          <option value="La_Libertad">La Libertad</option>
          <option value="Lambayeque">Lambayeque</option>
          <option value="Lima">Lima</option>
          <option value="Loreto">Loreto</option>
          <option value="Madre_de_Dios">Madre de Dios</option>
          <option value="Moquegua">Moquegua</option>
          <option value="Pasco">Pasco</option>
          <option value="Piura">Piura</option>
          <option value="Puno">Puno</option>
          <option value="San_Martín">San Martín</option>
          <option value="Tacna">Tacna</option>
          <option value="Tumbes">Tumbes</option>
          <option value="Ucayali">Ucayali</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>
        <label>Email :</label>
      </td>
      <td>
        <input type="text" id="authorEmailAddress" name="email_address" class="form-control" placeholder="Email Address *" value="<?=set_value('email_address')?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label>Contacto :</label>
      </td>
      <td>
        <input maxlength="14" type="text" id="authorContactNo" name="contact_no" class="form-control" placeholder="Contacto *" value="<?=set_value('contact_no')?>"/>
      </td>
    </tr>
    <tr hidden="hidden">
      <td>
        <label>Tipo de acceso :</label>
      </td>
      <td>
        <input id="accesssType" class="form-control" style="border:0px;" name='access_type' value="Teacher" disabled="true"/>
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

<button type="submit" class="btn btn-default insertAuthorityUser" ><span class="glyphicon glyphicon-save"></span> &nbsp; Guardar </button>
</form>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $("#date_of_join").datepicker();
});
</script>