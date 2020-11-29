
<div class="row well" style="border:0px solid">
  <span style="font-size:16px;"><i class="fa fa-envelope-o"></i>&nbsp;&nbsp; Novedades</span>
  <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> Atras</span></a>
</div>
<p hidden='hidden' id="sessionID"><?php echo getLoginUserID();?></p>
<div class="row well">
  <p class="well" style="padding:10px;">
    <span> <i class="fa fa-envelope-o"></i>&nbsp;&nbsp; Novedades </span>
  </p>

  <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
   <thead>

    <tr>
      <th>ID</th>
      <th> Asunto </th>
      <th> Fecha de publicación </th>
      <th> Aviso </th>
      <th> Acción </th>
    </tr>
  </thead>
  <tbody>
    <?php  foreach ($get_data as $row){ ?>
    <tr>
      <td><?php echo $row->id; ?></td>
      <td class="limitationSubject"><?php echo $row->note_subject; ?></td>
      <td><?php echo $row->publish_date; ?></td>
      <td class="limitationCharacters"><?php echo $row->note_message; ?></td>
      <td>
        <?php  view_notice($row->id);?>&nbsp;
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>


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
</div>


<script type="text/javascript">
// for text limitation script
$(document).ready(function() {
  $(".limitationSubject").each(function(i){
    len=$(this).text().length;
    if(len>30)
    {
      $(this).text($(this).text().substr(0,30)+' ...');
    }
  });
  $(".limitationCharacters").each(function(i){
    len=$(this).text().length;
    if(len>80)
    {
      $(this).text($(this).text().substr(0,80)+' ...');
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

</script>
