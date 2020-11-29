<div class="row well" style="border:0px solid">
  <span style="font-size:16px;"><i class="fa fa-book"></i>&nbsp;&nbsp; Biblioteca</span>
  <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Atras</span></a>
</div>

<div class="row well">
  <p class="well" style="padding:10px;">
    <span> <i class="fa fa-exchange"></i>&nbsp;&nbsp; Lista de libros de problemas </span>

    <a href="#" data-toggle="modal" data-target="#issueBooks"><span class="pull-right"> <i class="fa fa-plus-square"></i>&nbsp; LIBRO DE EDICIONES</span></a>
  </p>

  <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th> DNI Estudiante </th>
        <th> libro </th>
        <th> Fecha de emisión </th>
        <th> Fecha límite </th>
        <th> Estado </th>
        <th> Bien </th>
        <th> Acción </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($issue_book as $row){  if (($row->return_type) != 1) { ?>
      <tr>
        <td><?php echo $row->id; ?></td>
        <td><?php echo $row->std_id; ?></td>
        <td class="characterlimitation"><?php echo $row->book_name; ?></td>
        <td><?php echo $row->issue_date; ?></td>
        <td><?php echo $row->due_date;?></td>
        <td>
          <?php
          $last_date=strtotime(date($row->due_date));
          $current_date = strtotime(date("d-m-Y"));
          if ($last_date < $current_date) {
            echo "<span class='sm-due'>OVER DUE</span>";
          }?>
        </td>
        <td><?php if ($row->fine_paid == 1) { ?>
                <strike><?php echo $row->library_fine; ?></strike>
              <?php }else {
              echo $row->library_fine;} ?>
          </td>
        <td>
          <?php
          $last_date=strtotime(date($row->due_date));
          $current_date = strtotime(date("d-m-Y"));
          if ($last_date < $current_date) { ?>
            <?php  fine($row->id);?>
          <?php } ?>
          <?php  edited($row->id);?>
          <?php  ret(base_url('library/return_data/'.$row-> id));?>

          <!-- payment btn -->
              <?php if (($row->library_fine) != 0 && ($row->fine_paid) != 1) {  ?>
                <?php  paid(base_url('library/paid_data/'.$row-> id));?>
              <?php } ?>
        </td>
      </tr>
      <?php } }  ?>
      
    </tbody>
  </table>
</div>


<!-- Create book issue popup   -->
<div class="modal fade" id="issueBooks" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <?php echo form_open('library/add_issue_book');?> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-book"></i>&nbsp; Issue Book</h4>
      </div>

      <div class="modal-body">
        <table  class="table dt-responsive zero-border">
          <tbody>
            <tr>
              <td>DNI Estudiante</td>
              <td>:</td>
              <td>
                <div class="input-group">
                  <input type="text" name="std_id" value="<?=set_value('std_id')?>" id="std_id" class="form-control" placeholder="DNI Estudiante *"/>
                  <span class="input-group-btn">
                    <button class="btn btn-default getStudentID" type="button">VERIFICAR !</button>
                  </span>
                </div>
                <span class="red" id="stdID_message_error"></span>
              </td>
            </tr>
            <tr>
              <td>ID del libro</td>
              <td>:</td>
              <td>
                <div class="input-group">
                  <input type="text" class="form-control book_id" id="book_id" placeholder="Libro ID *"/>
                  <span class="input-group-btn">
                    <button class="btn btn-default getbookID" type="button">VERIFICAR !</button>
                  </span> 
                </div>
                <span class="red" id="bookID_message_error"></span>
              </td>
            </tr>
            <tr hidden>
              <td>ID del libro</td>
              <td>:</td>
              <td>
                <input type="text" name="get_book_id" value="<?=set_value('get_book_id')?>" id="get_book_id" class="form-control" disable/>
              </td>
            </tr>
            <tr>
              <td>Nombre del libro</td>
              <td>:</td>
              <td>
                <input type="text" name="book_name" value="<?=set_value('book_name')?>" id="book_name" class="form-control" placeholder="Book Name *" readonly/>
                <span class="red" id="book_message_error"></span>
              </td>
            </tr>
            <tr>
              <td>Nombre del escritor</td>
              <td>:</td>
              <td>
                <input type="text" name="writer_name" value="<?=set_value('writer_name')?>" id="writer_name" class="form-control" placeholder="Writer Name *" readonly/>
                <span class="red" id="writer_message_error"></span>
              </td>
            </tr>
            <tr>
              <td>Fecha de vencimiento</td>
              <td>:</td>
              <td>
                <input type="text" name="due_date" value="<?=set_value('due_date')?>" id="due_date" class="form-control" placeholder="Due Date*" readonly/>
                <span class="red" id="date_message_error"></span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default creatissuebook">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
      <!-- </div> -->
      <?php echo form_close()?>
    </div>
  </div>
</div>

<!-- due date update modal-->
<div class="modal fade" id="dept_Update" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-book"></i></span>&nbsp; Actualizar</h4>
      </div>
      <div class="modal-body">
        <table  class="table dt-responsive zero-border">
          <tbody>
            <tr hidden="hidden">
              <td></td>
              <td></td>
              <td>
                <input type="text" name="id" id="e_id" class="form-control" disabled="true" />
              </td>
            </tr>
            <tr>
              <td>Fecha de vencimiento</td>
              <td>:</td>
              <td>
                <input type="text" name="due_date" id="due_date_up" class="form-control" placeholder="Due Date*" readonly/>
                <span class="red" id="due_date_error"></span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" id="updateData" value="" class="btn btn-default updateForDueDate">Actualizar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onClick="window.location.reload()">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- add fine modal-->
<div class="modal fade" id="fine" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-book"></i></span>&nbsp; Actualizar</h4>
      </div>
      <div class="modal-body">
        <table  class="table dt-responsive zero-border">
          <tbody>
            <tr hidden="hidden">
              <td></td>
              <td></td>
              <td>
                <input type="text" name="id" id="id" class="form-control" disabled="true" />
              </td>
            </tr>
            <tr>
              <td>Monto de la multa</td>
              <td>:</td>
              <td>
                <input type="text" name="fine_amount" id="fine_amount" class="form-control" placeholder="Fine Amount *"/>
                <span class="red" id="fine_amount_error"></span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" id="updateData" value="" class="btn btn-default addFineAmount">Añadir</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onClick="window.location.reload()">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
// datepicker
$(document).ready(function() {
  $("#due_date").datepicker();
  $("#due_date_up").datepicker();
});

// get student information
$('.getStudentID').click(function() {
  var studentID = $('#std_id').val();
  if(studentID !='' && studentID.length > 0) {
    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?=base_url('library/retrive_std_info')?>",
      data: "studentID=" + studentID,
      dataType: "html",
      success: function(data) {
        var response = jQuery.parseJSON(data);
        if(response.confirmation == 'success') {
          alert(response.std_name);
        } else {
          alert(response.message);
        }
      }
    });
  } else {
    alert('El campo de identificación del estudiante es obligatorio.');
  }
});
// get book infremation 
$('.getbookID').click(function() {
  var getbookID = $('#book_id').val();
  if(getbookID !='' && getbookID.length > 0) {
    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?=base_url('library/retrive_book_info')?>",
      data: "getbookID=" + getbookID,
      dataType: "html",
      success: function(data) {
        var response = jQuery.parseJSON(data);
        if(response.confirmation == 'success') {
          $('#get_book_id').val(response.id);
          $('#book_name').val(response.book_name);
          $('#writer_name').val(response.writer_name);
        } else {
          alert(response.message);
        }
      }
    });
  } else {
    alert('Seleccione ID de libro');
  }
});

// issue book script 
$('.creatissuebook').click(function() {
  var std_id = $('#std_id').val();
  var book_id = $('#get_book_id').val();
  var book_name = $('#book_name').val();
  var writer_name = $('#writer_name').val();
  var due_date = $('#due_date').val();
  $.ajax({
    dataType: "json",
    type: 'POST',
    url: "<?=base_url('library/creat_issue_book')?>",
    data: {
      'std_id' : std_id,
      'book_id' : book_id,
      'book_name' : book_name,
      'writer_name' : writer_name,
      'due_date' : due_date
    },
    dataType: "html",
    success: function(data){
      var response = jQuery.parseJSON(data);
      console.log(data);
      if(response.confirmation == 'error') {
        $('#stdID_message_error').html(response.validations['std_id']);
        $('#bookID_message_error').html(response.validations['book_id']);
        $('#book_message_error').html(response.validations['book_name']);
        $('#writer_message_error').html(response.validations['writer_name']);
        $('#date_message_error').html(response.validations['due_date']);
      } else {
        window.location.reload();
      }
    }
  });
});


// update script
$('.editActionButtonClick').click(function() {
  var getID = $(this).attr('id');
  if(getID != 'NULL' || getID != '') {
    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?=base_url('library/retrive_due_date_update')?>",
      data: "getID=" + getID,
      dataType: "html",
      success: function(data) {
        var response = jQuery.parseJSON(data);
        console.log(response);

        if(response.confirmation == 'success') {
          $('#e_id').val(response.id);
          $('#due_date_up').val(response.due_date);

          /*update script */
          $('.updateForDueDate').click(function() {
            var id = $('#e_id').val();
            var due_date = $('#due_date_up').val();
            $.ajax({
              dataType: "json",
              type: 'POST',
              url: "<?=base_url('library/due_date_update')?>",
              data: {
                'id' : id,
                'due_date' : due_date
              },
              dataType: "html",
              success: function(data){
                var response = jQuery.parseJSON(data);
                console.log(data);
                if(response.confirmation == 'error') {
                  $('#due_date_error').html(response.validations['due_date']);
                } else {
                  window.location.reload();
                }
              }
            });
          });
        } 
        else {
          $('#e_id').val('');
          $('#due_book_up').val('');
        }
      }
    });
  }
});


// add fine
$('.addFine').click(function(){
  var getID = $(this).attr('id');
  if(getID != 'NULL' || getID != '') {
    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?=base_url('library/retrive_due_date_update')?>",
      data: "getID=" + getID,
      dataType: "html",
      success: function(data) {
        var response = jQuery.parseJSON(data);
        console.log(response);

        if(response.confirmation == 'success') {
          $('#id').val(response.id);
          $('#fine_amount').val(response.library_fine);

          /*update script */

          $('.addFineAmount').click(function(){
            var id = $('#id').val();
            var fine_amount = $('#fine_amount').val();
            $.ajax({
              dataType: "json",
              type: 'POST',
              url: "<?=base_url('library/add_fine_amount')?>",
              data: {'id' : id,'library_fine' : fine_amount},
              dataType: "html",
              success: function(data){
                var response = jQuery.parseJSON(data);
                console.log(data);
                if(response.confirmation == 'error') {
                  $('#fine_amount_error').html(response.validations['library_fine']);
                } else {
                  window.location.reload();
                }
              }
            });   
          }); 
        } 
        else {
          $('#e_id').val('');
          $('#due_book_up').val('');
        }
      }
    });
  }
  
});
  



  

</script>