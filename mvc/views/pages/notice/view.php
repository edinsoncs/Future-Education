
<div class="row well" style="border:0px solid">
  <span style="font-size:16px;"><i class="fa fa-envelope-o"></i>&nbsp;&nbsp; Novedades</span>
  <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Back</span></a>
</div>

<div class="row well">
  <p class="well" style="padding:10px;">
    <span> <i class="fa fa-envelope-o"></i>&nbsp;&nbsp; Novedades </span>

    <a href="#" data-toggle="modal" data-target="#addNotice"><span class="pull-right"> <i class="fa fa-plus-square"></i>&nbsp; Crear novedades</span></a>
  </p>

  <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
   <thead>

    <tr>
      <th>#</th>
      <th> Aviso No. </th>
      <th> Asunto </th>
      <th> Fecha de publicación </th>
      <th> Aviso </th>
      <th> Acción </th>
    </tr>
  </thead>
  <tbody>

    <?php   foreach ($get_data as $row) { ?>
    <tr>
      <td><?php echo $row->id; ?></td>
      <td><?php echo $row->note_no; ?></td>
      <td class="limitationSubject"><?php echo $row->note_subject; ?></td>
      <td><?php echo $row->publish_date; ?></td>
      <td class="limitationCharacters"><?php echo $row->note_message; ?></td>
      <td>
        <?php  view_notice($row->id);?>&nbsp;
        <?php  edited($row->id);?>&nbsp;
        <?php  del(base_url('notice/delete_data/'.$row-> id));?>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>

<!-- Create Notice show popup   -->
<div class="modal fade" id="addNotice" role="dialog">
 <div class="modal-dialog">
   <!-- Modal content-->
   <div class="modal-content">
     <?php echo form_open('notice/new_notice');?> 
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title"><i class="fa fa-envelope-o"></i>&nbsp; Crear aviso</h4>
     </div>

     <div class="modal-body">
       <table  class="table dt-responsive zero-border">
         <tbody>
          <tr>
           <td>
            <input type="text" name="note_no" value="" id="note_no" class="form-control" placeholder="Número de aviso *" required="required"/>
          </td>
        </tr>
      <tr>
       <td>
        <input type="text" name="note_subject" value="" id="note_subject" class="form-control" placeholder="Sujeto *" required="required"/>
      </td>
    </tr>
    <tr>
     <td>
       <textarea type="text" name="note_message" value="" id="note_message" rows="10" class="form-control jqte-test" placeholder="Tipo de aviso *" required="required"></textarea>
     </td>
   </tr>
 </tbody>
</table>
</div>

<div class="modal-footer">
 <button type="submit" class="btn btn-default">Crear</button>
 <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>
<!-- </div> -->
<?php echo form_close()?>
</div>
</div>
</div>

<!-- View Notice show popup   -->
<div class="modal fade" id="view_notice" role="dialog">
 <div class="modal-dialog">
   <!-- Modal content-->
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title"><i class="fa fa-envelope-o"></i>&nbsp; Ver aviso</h4>
     </div>

     <div class="modal-body">
       <table  class="table dt-responsive zero-border">
         <tbody id="showData">
         </tbody>
       </table>
     </div>
     <div class="modal-footer">
      <!-- <button type="submit" class="btn btn-default">Create</button> -->
      <button type="button" class="btn btn-default" data-dismiss="modal" onClick="window.location.reload()">Cerrar</button>
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
        <h4 class="modal-title"><i class="fa fa-envelope-o"></i></span>&nbsp; Aviso de actualización</h4>
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
           <td>
            <input type="text" name="e_note_no" value="" id="e_note_no" class="form-control" placeholder="Número de aviso *" required="required"/>
          </td>
        </tr>
      <tr>
        <td>
         <input type="text" name="note_subject"  id="e_note_subject" class="form-control" placeholder="Sujeto" />
       </td>
     </tr>
     <tr>
      <td>
        <textarea type="text" name="note_message" value="" id="e_note_message" rows="10" class="form-control jqte-test" placeholder="Tipo de aviso *" required="required"></textarea>
      </td>
    </tr>

  </tbody>
</table>
</div>
<div class="modal-footer">
  <button type="button" id="updateData" value="" class="btn btn-default editForNotice">Actualizar</button>
  <button type="button" class="btn btn-default" data-dismiss="modal" onClick="window.location.reload()">Cerrar</button>
</div>
</div>
</div>
</div>
</div>


<script type="text/javascript">
// for text limitation script
$(document).ready(function() {
  $(".limitationSubject").each(function(i){
    len=$(this).text().length;
    if(len>25)
    {
      $(this).text($(this).text().substr(0,25)+' ...');
    }
  });
  $(".limitationCharacters").each(function(i){
    len=$(this).text().length;
    if(len>45)
    {
      $(this).text($(this).text().substr(0,45)+' ...');
    }
  });
});
// close text limitation script


// jquery text editor
$('.jqte-test').jqte();
  // settings of status
  var jqteStatus = true;
  $(".status").click(function()
  {
    jqteStatus = jqteStatus ? false : true;
    $('.jqte-test').jqte({"status" : jqteStatus})
  });
// close jquery text editor


// show notice 
$('.viewNotice').click(function() {
  var noticeID = $(this).attr('id');
  var sessionID = $('#sessionID').html();
   
  if(noticeID != 'NULL' || noticeID != '') {
    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?=base_url('notice/retrive_data')?>",
      data: {'noticeID' : noticeID, 'sessionID' : sessionID},
      dataType: "html",
      success: function(data) {
       $('#showData').html(data);
     }
   });
  }  
});
// update notice
$('.editActionButtonClick').click(function() {
  var noticeID = $(this).attr('id');

  if(noticeID != 'NULL' || noticeID != '') {
    $.ajax({
      type: 'POST',
      dataType: "json",
      url: "<?=base_url('notice/retrive_data_for_update')?>",
      data: "noticeID=" + noticeID,
      dataType: "html",
      success: function(data) {
        var response = jQuery.parseJSON(data);
        console.log(response);
        if(response.confirmation == 'success') {
          $('#e_id').val(response.id);
          $('#e_note_no').val(response.note_no);
          $('#e_note_subject').val(response.note_subject);
          $('.jqte_editor').html(response.note_message);

          /*update script */
          $('.editForNotice').click(function() {
            var id = $('#e_id').val();
            var note_no = $('#e_note_no').val();
            var note_subject = $('#e_note_subject').val();
            var note_message = $('#e_note_message').val();
            $.ajax({
              type: 'POST',
              url: "<?=base_url('notice/notice_update')?>",
              data: {'id' : id,'note_no' : note_no,'note_subject' : note_subject, 'note_message' : note_message, },
              dataType: "html",
              success: function(data){
                window.setTimeout(function(){location.reload()},0)
              }
            });
          });
        } else {
          $('#e_id').val('');
          $('#e_note_subject').val('');
          $('#e_note_message').val('');
        }

      }
    });
}
});

</script>
