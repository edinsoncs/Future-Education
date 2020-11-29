<div class="row well" style="border:0px solid">
  <span style="font-size:16px;"><i class="fa fa-users"></i> &nbsp;&nbsp; Agregar nuevo estudiante</span>
  <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Atras</span></a>
</div>

<div class="row well" style="border:0px solid">

  <form method="POST">
    <table class="table dt-responsive zero-border input-cus select-cus">
      <tbody>
        <tr hidden="hidden">
         <td>
           <label>Display ID :</label>
         </td>
         <td>
           <input type="text" id="display_id" name="display_id" class="form-control" value="<?php echo maxUserID()?>"/>
         </td>
       </tr>
       <tr>
         <td>
           <label>DNI :</label>
         </td>
         <td>
           <input type="text" id="std_id" name="std_id" class="form-control" placeholder="Número de DNI *" value="<?=set_value('std_id')?>"/>
         </td>
       </tr>
       <tr>
        <td>
          <label> Nombre completo :</label>
        </td>
        <td>
          <input type="text" id="std_name" name="std_name" class="form-control capitalize" placeholder="Nombre completo *" value="<?=set_value('std_name')?>"/>
        </td>
      </tr>
      <tr>
        <td>
          <label>Departamento :</label>
        </td>
        <td>
          <select name='std_dept' id="std_dept" class="form-control uppercase" >
           <?php foreach($get_dept as $row) { ?>
           <option class="uppercase" value="<?=$row->dept_sort_name?>"><?=$row->dept_sort_name?></option>
           <?php } ?>
         </select>
       </td>
     </tr>
     <tr>
      <td>
        <label>Batch :</label>
      </td>
      <td>
        <input type="text" id="std_batch" name="std_batch" class="form-control" placeholder="Batch *" value="<?=set_value('std_batch')?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label>Sección :</label>
      </td>
      <td>
        <select name='std_section' id="std_section" class="form-control uppercase" >
         <option value="Dia">Día</option>
         <option value="Tarde">Tarde</option>
         <option value="Noche">Noche</option>
       </select>
     </td>
   </tr>
   <tr>
    <td>
      <label>Crédito requerido :</label>
    </td>
    <td>
      <input type="text" id="required_credit" name="required_credit" class="form-control" placeholder="Crédito requerido *" value="<?=set_value('required_credit')?>"/>
    </td>
  </tr>
  <tr>
    <td>
      <label>Estado:</label>
    </td>
    <td>
      <select name='std_status' id="std_status" class="form-control" >
       <option value="1">Regular</option>
       <option value="2">Irregular</option>
     </select>

   </td>
 </tr>
 <tr>
  <td>
    <label>Genero :</label>
  </td>
  <td>
    <select name='std_gender' id="std_gender" class="form-control" >
      <option value="0">Seleccione género</option>
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
    <select name='std_religion' id="std_religion" class="form-control" >
      <option value="0">Selecciona lugar</option>
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
    <input type="text" id="std_email_address" name="std_email_address" placeholder="Email Address *" class="form-control"  value="<?=set_value('std_email_address')?>"/>
  </td>
</tr>
<tr>
  <td>
    <label>Contacto :</label>
  </td>
  <td>
    <input type="text" id="std_contact_no" name="std_contact_no" class="form-control" placeholder="Contact No. *"  value="<?=set_value('std_contact_no')?>"/>
  </td>
</tr>
</tbody>
</table>

<button type="submit" class="btn btn-default insertAuthorityUser" ><span class="glyphicon glyphicon-save"></span> &nbsp; Guardar </button>
</form>
<br>
<p class="note">nótese bien Por primera vez, la identificación de usuario y la contraseña son las mismas que la identificación del estudiante
</p>
</div>







<!-- insert Authority user script module  -->
