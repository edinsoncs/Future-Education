<div class="row well" style="border:0px solid">
    <span style="font-size:16px;"><i class="fa fa-file-archive-o"></i> &nbsp;&nbsp;Archivo del semestre
</span>
    <a class="pull-right" href="javascript:window.history.go(-1);"><span class="pull-right"><i class="fa fa-long-arrow-left" title="Back"></i> atrás</span></a>
</div>

<div class="row well" style="border:0px solid">
    <p class="well" style="padding:10px;">
      <span> <i class="fa fa-book"></i>&nbsp; Archivo Semester Wise
</span>
  </p>

  <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
     <thead>
        <tr>
            <th>ID</th>
            <th> Semestre </th>
            <th> Lote </th>
            <th> Sección </th>
            <th> Subj. Código </th>
            <th> Nombre </th>
            <th> Crédito </th>
            <th> Nombre de los profesores </th>
            <th> Alternativo </th>
            <th> Acción </th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($get_all_data as $row) { ?>
        <tr>
            <td><?=$row->id;?></td>
            <td><?=$row->semester_code;?></td>
            <td class="uppercase"><?=$row->std_batch;?></td>
            <td class="uppercase"><?=$row->std_section;?></td>
            <td class="uppercase"><?=$row->sub_code;?></td>
            <td class="capitalize limitationCharacters"><?=$row->sub_name;?></td>
            <td><?=$row->sub_credit;?></td>
            <td class="capitalize namelength"><?=$row->assign_teacher;?></td>
            <td class="capitalize namelength"><?=$row->alternative_teacher;?></td>
            <td>
              <?php view(base_url('semesterArchive/viewdetails/'.$row-> id));?>
          </td>
      </tr>
      <?php } ?>
  </tbody>

</table>

</div>
<script type="text/javascript">
// for text limitation script
$(document).ready(function() {
  $(".limitationCharacters").each(function(i){
    len=$(this).text().length;
    if(len>20)
    {
      $(this).text($(this).text().substr(0,20)+' ...');
      }
    });
  $(".namelength").each(function(i){
    len=$(this).text().length;
    if(len>15)
    {
      $(this).text($(this).text().substr(0,15)+' ...');
      }
    });
});
</script>