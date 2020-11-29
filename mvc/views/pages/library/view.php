<div class="row well" style="border:0px solid">
  <span style="font-size:16px;"><i class="fa fa-book"></i>&nbsp;&nbsp; Biblioteca</span>
  <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Atras</span></a>
</div>

<div class="row well">
  <p class="well" style="padding:10px;">
    <span> <i class="fa fa-book"></i>&nbsp;&nbsp; Lista de libros </span>

    <a href="#" data-toggle="modal" data-target="#addbook"><span class="pull-right"> <i class="fa fa-plus-square"></i>&nbsp; Agregar libro</span></a>
  </p>

  <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th> Nombre </th>
        <th> Escritor </th>
        <th> Sub. código </th>
        <th> Edición </th>
        <th> Cantidad </th>
        <th> Rack </th>
        <th> Disponibilidad </th>
        <th> Acción </th>
      </tr>
    </thead>
    <tbody>
      <?php   foreach ($get_data as $row) { ?>
      <tr>
        <td><?php echo $row->id; ?></td>
        <td class="characterlimitation"><?php echo $row->book_name; ?></td>
        <td class="characterlimitation"><?php echo $row->writer_name; ?></td>
        <td><?php echo $row->subject_code; ?></td>
        <td><?php echo $row->edition;?></td>
        <td><?php echo $row->quantity;?></td>
        <td><?php echo $row->rack_no;?></td>
        <td><?php echo $count = $row->quantity - $row->issued;?></td>
        <td>
          <?php  view_notice($row->id);?>
          <?php  barCode($row->id)?>
          <?php  edited($row->id);?>
          <?php  del(base_url('library/delete_data/'.$row->id));?>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<!-- modal containt -->

<!-- Create book show popup   -->
<div class="modal fade" id="addbook" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <?php echo form_open('library/add_new');?> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-book"></i>&nbsp; Agregar libro</h4>
      </div>

      <div class="modal-body">
        <table  class="table dt-responsive zero-border">
          <tbody>
            <tr>
              <td>Nombre del libro</td>
              <td>:</td>
              <td>
                <input type="text" name="book_name" value="<?=set_value('book_name')?>" id="book_name" class="form-control" placeholder="Nombre del libro *" required="required"/>
              </td>
            </tr>
            <tr>
              <td>Nombre del escritor</td>
              <td>:</td>
              <td>
                <input type="text" name="writer_name" value="<?=set_value('writer_name')?>" id="writer_name" class="form-control" placeholder="Nombre del escritor *" required="required"/>
              </td>
            </tr>
            <tr>
              <td>Código de asunto</td>
              <td>:</td>
              <td>
                <input type="text" name="subject_code" value="<?=set_value('subject_code')?>" id="subject_code" class="form-control" placeholder="Código de asunto *" required="required"/>
              </td>
            </tr>
            <tr>
              <td>Edición</td>
              <td>:</td>
              <td>
                <input type="text" name="edition" value="<?=set_value('edition')?>" id="edition" class="form-control" placeholder="Edición"/>
              </td>
            </tr>
            <tr>
              <td>Año de edición</td>
              <td>:</td>
              <td>
                <input type="text" name="edition_year" value="<?=set_value('edition_year')?>" id="edition_year" class="form-control" placeholder="Año de edición" pattern="[0-9 ]+"/>
              </td>
            </tr>
            <tr>
              <td>Precio</td>
              <td>:</td>
              <td>
                <input type="text" name="price" value="<?=set_value('price')?>" id="price" class="form-control" placeholder="Precio *" required pattern="[0-9]+"/>
              </td>
            </tr>
            <tr>
              <td>Cantidad</td>
              <td>:</td>
              <td>
                <input type="text" name="quantity" value="<?=set_value('quantity')?>" id="quantity" class="form-control" placeholder="Cantidad *" required pattern="[0-9]+"/>
              </td>
            </tr>
            <tr>
              <td>Rack no.</td>
              <td>:</td>
              <td>
                <input type="text" name="rack_no" value="<?=set_value('rack_no')?>" id="rack_no" class="form-control" placeholder="Rack no. *" required="required"/>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-default">Create</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      <!-- </div> -->
      <?php echo form_close()?>
    </div>
  </div>
</div>


<!-- View book show popup   -->
<div class="modal fade" id="view_notice" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-book"></i>&nbsp;Book Details</h4>
      </div>

      <div class="modal-body">
        <table  class="table dt-responsive table-bordered">
          <tbody id="showData">
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- notice update modal-->
<div class="modal fade" id="dept_Update" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-book"></i></span>&nbsp; Actualizar la información del libro</h4>
      </div>

      <div class="modal-body">
        <table  class="table dt-responsive zero-border">
          <tbody>
            <tr hidden="hidden">
              <td>
                <input type="text" name="id" id="e_id" class="form-control" disabled="true" />
              </td>
            </tr>
            <tr>
              <td>Nombre del libro</td>
              <td>:</td>
              <td>
                <input type="text" name="book_name" id="book_name_up" class="form-control" />
                <span class="red" id="book_message_error"></span>
              </td>
            </tr>
            <tr>
              <td>Nombre del escritor</td>
              <td>:</td>
              <td>
                <input type="text" name="writer_name" id="writer_name_up" class="form-control"/>
                <span class="red" id="writer_message_error"></span>
              </td>
            </tr>
            <tr>
              <td>Código de asunto</td>
              <td>:</td>
              <td>
                <input type="text" name="subject_code" id="subject_code_up" class="form-control"/>
                <span class="red" id="code_message_error"></span>
              </td>
            </tr>
            <tr>
              <td>Edición</td>
              <td>:</td>
              <td>
                <input type="text" name="edition" id="edition_up" class="form-control"/>
                <span class="red" id="edition_message_error"></span>
              </td>
            </tr>
            <tr>
              <td>Año de edición</td>
              <td>:</td>
              <td>
                <input type="text" name="edition_year" id="edition_year_up" class="form-control"/>
                <span class="red" id="edition_yr_message_error"></span>
              </td>
            </tr>
            <tr>
              <td>Precio</td>
              <td>:</td>
              <td>
                <input type="text" name="price" id="price_up" class="form-control"/>
                <span class="red" id="price_message_error"></span>
              </td>
            </tr>
            <tr>
              <td>Cantidad</td>
              <td>:</td>
              <td>
                <input type="text" name="quantity" id="quantity_up" class="form-control"/>
                <span class="red" id="quantity_message_error"></span>
              </td>
            </tr>
            <tr>
              <td>Estante no.</td>
              <td>:</td>
              <td>
                <input type="text" name="rack_no" id="rack_no_up" class="form-control"/>
                <span class="red" id="rack_message_error"></span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" id="updateData" value="" class="btn btn-default editForBook">Actualizar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!-- View barcode   -->
<div class="modal fade" id="barCode" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-barcode"></i>&nbsp; Código de barras</h4>
      </div>

      <div class="modal-body">
        <table  class="table dt-responsive zero-border" id='print_areas'>
          <tbody id="showBarCode">
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button onclick="javascript:prints('print_areas')" class="btn btn-sm btn-info" id="get_print"><span class="glyphicon glyphicon-print"></span>&nbsp;Impresión</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
// for text limitation script
$(document).ready(function() {
  $(".characterlimitation").each(function(i){
    len=$(this).text().length;
    if(len>20)
    {
      $(this).text($(this).text().substr(0,45)+' ...');
    }
  });
});
// barcode script
$('.viewBarCode').click(function() {
  var getID = $(this).attr('id');

  if(getID != 'NULL' || getID != '') {
    $.ajax({
      type: 'POST',
      // dataType: "json",
      url: "<?=base_url('library/getBarcode')?>",
      data: "getID=" + getID,
      dataType: "html",
      success: function(data) {
        console.log(data);
        $("#showBarCode").html("<div class='col-sm-3 barcode-padding'><img class='barcodePadding' src="+data+" /></div><div class='col-sm-3 barcode-padding'><img class='barcodePadding' src="+data+" /></div><div class='col-sm-3 barcode-padding'><img class='barcodePadding' src="+data+" /></div><div class='col-sm-3 barcode-padding'><img class='barcodePadding' src="+data+" /></div><div class='col-sm-3 barcode-padding'><img class='barcodePadding' src="+data+" /></div><div class='col-sm-3 barcode-padding'><img class='barcodePadding' src="+data+" /></div><div class='col-sm-3 barcode-padding'><img class='barcodePadding' src="+data+" /></div><div class='col-sm-3 barcode-padding'><img class='barcodePadding' src="+data+" /></div><div class='col-sm-3 barcode-padding'><img class='barcodePadding' src="+data+" /></div><div class='col-sm-3 barcode-padding'><img class='barcodePadding' src="+data+" /></div><div class='col-sm-3 barcode-padding'><img class='barcodePadding' src="+data+" /></div><div class='col-sm-3 barcode-padding'><img class='barcodePadding' src="+data+" /></div>");
      }
  });
}
});
// show book details
$('.viewNotice').click(function() {
  var getID = $(this).attr('id');
  if(getID != 'NULL' || getID != '') {
    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?=base_url('Library/retrive_data')?>",
      data: {'getID' : getID},
      dataType: "html",
      success: function(data) {
        $('#showData').html(data);
      }
    });
  }  
});
// update script
$('.editActionButtonClick').click(function() {
  var getID = $(this).attr('id');
  if(getID != 'NULL' || getID != '') {
    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?=base_url('library/retrive_data_for_update')?>",
      data: "getID=" + getID,
      dataType: "html",
      success: function(data) {
        var response = jQuery.parseJSON(data);
        console.log(response);

        if(response.confirmation == 'success') {
          $('#e_id').val(response.id);
          $('#book_name_up').val(response.book_name);
          $('#writer_name_up').val(response.writer_name);
          $('#subject_code_up').val(response.subject_code);
          $('#edition_up').val(response.edition);
          $('#edition_year_up').val(response.edition_year);
          $('#price_up').val(response.price);
          $('#quantity_up').val(response.quantity);
          $('#rack_no_up').val(response.rack_no);

          /*update script */
          $('.editForBook').click(function() {
            var id = $('#e_id').val();
            var book_name = $('#book_name_up').val();
            var writer_name = $('#writer_name_up').val();
            var subject_code = $('#subject_code_up').val();
            var edition = $('#edition_up').val();
            var edition_year = $('#edition_year_up').val();
            var price = $('#price_up').val();
            var quantity = $('#quantity_up').val();
            var rack_no = $('#rack_no_up').val();
            $.ajax({
              dataType: "json",
              type: 'POST',
              url: "<?=base_url('library/book_update')?>",
              data: {
                'id' : id,
                'book_name' : book_name,
                'writer_name' : writer_name,
                'subject_code' : subject_code,
                'edition' : edition,
                'edition_year' : edition_year,
                'price' : price,
                'quantity' : quantity,
                'rack_no' : rack_no
              },
              dataType: "html",
              success: function(data){
                var response = jQuery.parseJSON(data);
                console.log(data);
                if(response.confirmation == 'error') {
                  $('#book_message_error').html(response.validations['book_name']);
                  $('#writer_message_error').html(response.validations['writer_name']);
                  $('#code_message_error').html(response.validations['subject_code']);
                  $('#edition_message_error').html(response.validations['edition']);
                  $('#edition_yr_message_error').html(response.validations['edition_year']);
                  $('#price_message_error').html(response.validations['price']);
                  $('#quantity_message_error').html(response.validations['quantity']);
                  $('#rack_message_error').html(response.validations['rack_no']);
                } else {
                  window.location.reload();
                }
              }
            });
          });
        } 
        else {
          $('#e_id').val('');
          $('#book_name_up').val('');
          $('#writer_name_up').val('');
          $('#subject_code_up').val('');
          $('#edition_up').val('');
          $('#edition_year_up').val('');
          $('#price_up').val('');
          $('#quantity_up').val('');
          $('#rack_no_up').val('');
        }
      }
    });
  }
});

// for print 
function prints(divID) {
    //Get the HTML of div
    var divElements = document.getElementById(divID).innerHTML;
    //Get the HTML of whole page
    var oldPage = document.body.innerHTML;
    //Reset the page's HTML with div's HTML only
    document.body.innerHTML = 
    "<html>"+
    "<head>"+
    "<title></title>"+
    "</head>"+
    "<body>" + 
    divElements + "</body>";

    //Print Page
    window.print();
    //Restore orignal HTML
    document.body.innerHTML = oldPage;
}
</script>