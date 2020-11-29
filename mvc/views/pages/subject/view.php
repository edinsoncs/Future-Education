<div class="row well">
    <span style="font-size:16px;"><i class="fa fa-book"></i> &nbsp;&nbsp; Informaciones de los sujetos</span>
    <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Atras</span></a>
</div>

<div class="row well">
    <p class="well" style="padding:10px;">
      <span> <i class="fa fa-book"></i> Sujetos </span>

      <a href="#" data-toggle="modal" data-target="#addSub"><span class="pull-right"> <i class="fa fa-plus-square"></i> Agregar nuevo</span></a>
    </p>

    <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
      <thead>

            <tr>
                <th>ID</th>
                <th> Código </th>
                <th> Nombre </th>
                <th> Departamento </th>
                <th> Crédito </th>
                <th> Acción </th>
            </tr>
        </thead>

            <tbody>
              <?php foreach($get_data as $row) { ?>
              <tr>
                  <td><?php echo $row-> id; ?></td>
                  <td class="uppercase"><?php echo $row-> subject_code; ?></td>
                  <td class="capitalize"><?php echo $row-> subject_name; ?></td>
                  <td class="uppercase"><?php echo $row-> subject_dept; ?></td>
                  <td ><?php echo $row-> subject_credit; ?></td>
                  <td>
                    <?php  sub_edit($row->id);?> &nbsp;
                    <?php  del(base_url('subject/delete_data/'.$row-> id));?>
                  </td>
              </tr>
              <?php } ?>

             </tbody>

    </table>

</div>
<!-- add subject info popup   -->
<div class="modal fade" id="addSub" role="dialog">
   <div class="modal-dialog">
     <!-- Modal content-->
     <div class="modal-content">
       <?php echo form_open('subject/add_subject');?>
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title"><i class="fa fa-book"></i>&nbsp; Añadir tema</h4>
         </div>

         <div class="modal-body">

           <table  class="table dt-responsive zero-border">
               <tbody>
                 <tr hidden="hidden">
                     <td>ID</td>
                     <td>:</td>
                     <td>
                       <input type="text" name="id" id="id" class="form-control" disabled="true"/>
                     </td>
                 </tr>
                 <tr>
                     <td> código *</td>
                     <td>:</td>
                     <td>
                       <input type="text" name="subject_code" value="" id="subject_code" class="form-control uppercase" placeholder="Ej: 0001 o código de departamento - 001"  />
                     </td>
                 </tr>
                 <tr>
                     <td> Nombre *</td>
                     <td>:</td>
                     <td>
                       <input type="text" name="subject_name" value="" id="subject_name" class="form-control capitalize" placeholder="Ej: nombre del asunto o tema"  />
                     </td>
                 </tr>
                 <tr>
                     <td>Departamento *</td>
                     <td>:</td>
                     <td>
                       <select name='subject_dept' id="subject_dept" class="form-control uppercase" >
                        <option class="uppercase" value="General">General</option>
                        <?php foreach($get_dept as $row) { ?>
                        <option class="uppercase" value="<?=$row->dept_sort_name?>"><?=$row->dept_sort_name?></option>
                        <?php } ?>
                        </select>
                      <!-- <input type="text" name="dept_sort_name" value="" id="dept_sort_name" class="form-control uppercase" placeholder="Ex: CSE" /> -->
                     </td>
                 </tr>
                 <tr>
                     <td>Crédito *</td>
                     <td>:</td>
                     <td>
                      <input type="text" name="subject_credit" value="" id="subject_credit" class="form-control uppercase" placeholder="Ej: 3 o 1,5" />
                     </td>
                 </tr>

                </tbody>
           </table>

         </div>

         <div class="modal-footer">
           <button type="submit" class="btn btn-default">Agregar nuevo</button>
           <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
         </div>
     <!-- </div> -->
     <?php echo form_close()?>
   </div>
 </div>
</div>

<!-- for update modal  -->
<div class="modal fade" id="sub_Update" role="dialog">
   <div class="modal-dialog">
     <!-- Modal content-->
     <div class="modal-content">

         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title"><i class="fa fa-book"></i>&nbsp; Actualizar asunto</h4>
         </div>

         <div class="modal-body">

           <table  class="table dt-responsive zero-border">
               <tbody>
                 <tr>
                     <td>Código *</td>
                     <td>:</td>
                     <td>
                       <input type="text" name="edit_subject_code" value="" id="edit_subject_code" class="form-control" placeholder="Ej .: 0001"  />
                     </td>
                 </tr>
                 <tr>
                     <td> Nombre *</td>
                     <td>:</td>
                     <td>
                       <input type="text" name="edit_subject_name" value="" id="edit_subject_name" class="form-control capitalize" placeholder="Ej: nombre del sujeto"  />
                     </td>
                 </tr>
                 <tr>
                     <td>Departmento *</td>
                     <td>:</td>
                     <td>

                       <select name='edit_subject_dept' id="edit_subject_dept" class="form-control uppercase" value="">

                        <!-- <option disabled="disabled">---------</option> -->
                        <option class="uppercase" value="General">General</option>
                        <?php foreach($get_dept as $row) { ?>
                        <option class="uppercase" value="<?=$row->dept_sort_name?>"><?=$row->dept_sort_name?></option>
                        <?php } ?>
                        </select>
                      <!-- <input type="text" name="edit_subject_dept" value="" id="edit_subject_dept" class="form-control uppercase" placeholder="Ex: CSE" /> -->
                     </td>
                 </tr>
                 <tr>
                     <td>Credito *</td>
                     <td>:</td>
                     <td>
                      <input type="text" name="edit_subject_credit" value="" id="edit_subject_credit" class="form-control uppercase" placeholder="Ej: 3 o 1,5" />
                     </td>
                 </tr>

                </tbody>
           </table>

         </div>

         <div class="modal-footer">
           <button type="button" id="updateData" class="btn btn-default updateForSubject">Actualizar</button>
           <button type="button" class="btn btn-default" data-dismiss="modal" onClick="window.location.reload()">Cerrar</button>
         </div>


   </div>
 </div>
</div>



 <script type="text/javascript">
 $('.subEditActionButton').click(function() {
     var subjectID = $(this).attr('id');
     if(subjectID != 'NULL' || subjectID != '') {
       $.ajax({
           type: 'POST',
           dataType: "json",
           url: "<?=base_url('subject/retrive_data')?>",
           data: "subjectID=" + subjectID,
           dataType: "html",
           success: function(data) {
               var response = jQuery.parseJSON(data);
               console.log(response);
               if(response.confirmation == 'success') {

                 $('#id').val(response.id);
                 $('#edit_subject_code').val(response.subject_code);
                 $('#edit_subject_name').val(response.subject_name);
                 $('#edit_subject_dept').val(response.subject_dept);
                 $('#edit_subject_credit').val(response.subject_credit);

                 /*update script */
                 $('.updateForSubject').click(function() {
                   var id = $('#id').val();
                   var subject_code = $('#edit_subject_code').val();
                   var subject_name = $('#edit_subject_name').val();
                   var subject_dept = $('#edit_subject_dept').val();
                   var subject_credit = $('#edit_subject_credit').val();

                   $.ajax({
                       type: 'POST',
                       url: "<?=base_url('subject/subject_update')?>",
                       data: {'id' : id, 'subject_code' : subject_code, 'subject_name' : subject_name, 'subject_dept' : subject_dept, 'subject_credit' : subject_credit },
                       dataType: "html",
                       success: function(data) {
                             window.location.reload()
                       }
                   });
                 });

               } else {
                 $('#id').val('');
                 $('#edit_subject_code').val('');
                 $('#edit_subject_name').val('');
                 $('#edit_subject_dept').val('');
                 $('#edit_subject_credit').val('');
               }

           }
       });
     }
 });

 </script>
