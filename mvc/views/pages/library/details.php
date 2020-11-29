<br>
<div class="row">
  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
    <div class="well" style="min-height:134px;">
      <h3 align="center">Problema</h3>
      <h3 align="center">
        <b>
          <?php $total_sum=0; foreach ($issue_book as $count_issue) { $total_sum+=count($count_issue); } echo $total_sum; ?>
      </b>
    </h3>
    </div>
  </div>
  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
    <div class="well" style="min-height:134px;">
      <h3 align="center">Debido</h3>
      <h3 align="center">
        <b>
          <?php 
            $total_sum=0; 
            foreach ($issue_book as $count_due) {
            if (($count_due->return_type)!= 1) {
               $total_sum+=count($count_due);
             }
            }  
            echo $total_sum;
          ?>
        </b>
      </h3>
    </div>
  </div>
  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
    <div class="well" style="min-height:134px;">
      <h3 align="center">Multa</h3>
      <h3 align="center">
        <b>
          <?php 
            $total_sum=0; 
            foreach ($issue_book as $count_fine) {
            if (($count_fine->fine_paid)!= 1) {
               $total_sum+= $count_fine->library_fine;
             }
            }  
            echo $total_sum;
          ?>
        </b>
      </h3>
    </div>
  </div>
</div>


<div class="row well">
  <p class="well" style="padding:10px;">
    <span> <i class="fa fa-exchange"></i>&nbsp;&nbsp; Lista de libros de problemas </span>
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
      <?php foreach($issue_book as $row){  ?>
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
            }
          ?>
        </td>
        <td><?php if ($row->fine_paid == 1) { ?>
            <strike><?php echo $row->library_fine; ?></strike>
          <?php }else {
          echo $row->library_fine;} ?>
            
        </td>

        <td>
          <?php if (($row->return_type) != 1) { ?>
            <!-- fine btn -->
            <?php
            $last_date=strtotime(date($row->due_date));
            $current_date = strtotime(date("d-m-Y"));
            if ($last_date < $current_date) { ?>
              <?php  fine($row->id);?>
            <?php } ?>
            <!-- due date change btn -->
            <?php  edited($row->id);?>&nbsp;
            <!-- return btn -->
            <?php  ret(base_url('library/return_details_page/'.$row-> id));?>
          <?php } ?>

          <!-- payment btn -->
          <?php if (($row->library_fine) != 0 && ($row->fine_paid) != 1) {  ?>
            <?php  paid(base_url('library/paid_data/'.$row-> id));?>
          <?php } ?>

        </td>

      </tr>
      <?php } ?>
      
    </tbody>
  </table>
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
  $(document).ready(function() {
    $("#due_date_up").datepicker();
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