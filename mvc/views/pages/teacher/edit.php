<div class="row well" style="border:0px solid">
  <span style="font-size:16px;"><i class="fa fa-user"></i>&nbsp; &nbsp; Actualizar información de los maestros</span>
  <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i><span>&nbsp; Back</a>
</div>

<div class="row well" style="border:0px solid">

  <?php foreach($teachers_edit_info as $row):
  echo form_open('teachers/teacher_update_info/'.$row-> display_id);?>

  <table class="table dt-responsive zero-border input-cus select-cus">
    <tbody>
     <tr>
      <td>
        <label>Nombre completo *:</label>
      </td>
      <td>
        <input type="text" id="user_full_name" name="user_full_name" class="form-control capitalize" value="<?php echo $row-> teacher_name; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label>Designacion *:</label>
      </td>
      <td>
        <input type="text" id="teacher_designation" name="teacher_designation" class="form-control capitalize" value="<?php echo $row-> teacher_designation; ?>"/>
      </td>
    </tr>
    <tr>
     <td>
       <label>Departamento *:</label>
     </td>
     <td>
       <select id="teacher_department" name='teacher_department' class="form-control uppercase" style="border:0px;" >
         <option value="<?php echo $row->teacher_department; ?>"><?php echo $row->teacher_department; ?></option>
         <option disabled="disabled">---------</option>
         <?php foreach ($dept as $rows) {?>
         <option value="<?php echo $rows->dept_sort_name;?>"><?php echo $rows->dept_sort_name;?></option>
         <?php } ?>

       </select>
     </td>
   </tr>
   <tr>
      <td>
        <label>Fecha de ingreso :</label>
      </td>
      <td>
        <input type="text" id="date_of_join" name="date_of_join" class="form-control" placeholder="Fecha de ingreso *" value="<?php echo $row-> date_of_join;?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label>Genero :</label>
      </td>
      <td>
        <select name='teacher_gender' id="teacher_gender" class="form-control" >
          <option value="<?php echo $row->teacher_gender; ?>"><?php echo $row->teacher_gender; ?></option>
          <option disabled="disabled">---------</option>
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
      <label>Email *:</label>
    </td>
    <td>
      <input type="text" id="authorEmailAddress" name="email_address" class="form-control" value="<?php echo $row-> email_address; ?>"/>
    </td>
  </tr>
  <tr>
    <td>
      <label>Nº de contacto *:</label>
    </td>
    <td>
      <input maxlength="14" type="text" id="authorContactNo" name="contact_no" class="form-control" value="<?php echo $row-> contact_no; ?>"/>
    </td>
  </tr>
</tbody>

</table>
<hr>

<h4>Información Entrar</h4>
<h5><input type="checkbox" id="checkbox" name="checkbox"/> &nbsp; Cambia tu contraseña
</h5>
<table class="table dt-responsive zero-border input-cus select-cus" >

  <tbody>

    <tr>
      <td >
        <label>Nombre de usuario *:</label>
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
        <input type="Password" id="authorPassword" name="user_pass" class="form-control" placeholder="Nueva contraseña " />
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

<button type="submit" class="btn btn-default" ><span class="glyphicon glyphicon-save"></span>&nbsp; Update </button>
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
$(document).ready(function() {
  $("#date_of_join").datepicker();
});
</script>
