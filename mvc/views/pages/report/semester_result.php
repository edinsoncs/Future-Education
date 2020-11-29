<html><head>
  <title>Informe de resultados del semestre</title>
  <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
  <style type="text/css">
  table tbody tr td{padding:5px 2px 5px 2px;}
  </style>
</head><body>
  <div class="col-sm-12" style="padding:0px;margin:0px;">
    <h6 align="right" style="margin:0px;">Imprimir por : <?php getLoginUserName(); ?></h6>
    <h6 align="right" style="margin-top:1px; margin:0px;">Fecha de impresion : <?php echo date("d-m-Y")?></h6>
  </div>
  <div class="container">
    <h3 align="center"><img style="height:50px; width:50px;" src="<?php echo base_url( getSite()->site_logo);?>" />&nbsp;<?php echo getSite()->name; ?></h3>
    <h4 align="center">Hoja de resultados del semestre sabio</h4>
    <h5 align="center"><?php if (isset($get_seme_full_name)) { echo $get_seme_full_name->season_code ."-". $get_seme_full_name->year_code;}?> </h5>
  </div>
  <br>
  <table width="100%">
    <tr >
      <td><b>Departmento : </b>
        <?php if(isset($dept_fill_name)){
          if ($dept_fill_name != '') {
            echo $dept_fill_name->dept_name;
          }
        }
        ?>
      </td>
      <td><b>Batch : </b>
        <?php if(isset($batchInfo)){
          if ($batchInfo != '') {
            echo $batchInfo->std_batch;
          }
        }
        ?>
      </td>
      <td align="right"><b>Sección : </b>
        <?php if(isset($sectionInfo)){
          if ($sectionInfo != '') {
            echo $sectionInfo->std_section;
          }
        }
        ?>
      </td>
    </tr>
  </table>

  <div>

    <?php foreach ($get_std_id as $row) { ?>
    <div style="page-break-inside: avoid;">
      <div style="border:1px solid; padding:5px; ">
        <p><b>ID :</b> <?php echo $row->std_id; ?><br> <b>Nombre :</b> <?php echo $row->std_name; ?></p>
        <table style="width:100%" border="1">
          <tr align="center">
            <td><b>Código</b> </td>
            <td><b>Nombre</b> </td>
            <td><b>Crédito</b> </td>
            <td><b>Punto</b> </td>
            <td><b>GPA</b> </td>
          </tr>
          <?php foreach ($get_result as $re) {
            if (($row->std_id) == ($re->std_id)) {?>
            <tr align="center">
              <td class="uppercase"><?php echo $re->sub_code;?></td>
              <td class="capitalize"><?php echo $re->sub_name;?></td>
              <td><?php echo $re->sub_credit;?></td>
              <td><?php echo $re->gpa_point;?></td>
              <td class="uppercase"><?php echo $re->grade_point;?></td>
            </tr>
            <?php } } ?>
          </table>
          <p>
           <?php foreach($point_table as $mks) {
             if (($row->std_id) == ($mks->std_id)) {?>
             <b>Obtener credito:</b> <?php echo $mks->credit?>
             <?php }}?>&nbsp;&nbsp;
             <b>Gana crédito:</b>
             <?php foreach ($get_earn_point as $ec) {
               if($row->std_id == $ec->std_id){
                 echo $ec->credit;
               }}
               ?>&nbsp;&nbsp;
               <b>Punto GPA: </b>
               <?php foreach($point_table as $mks) {
                 if (($mks->action)!=0) {
                  if (($row->std_id) == ($mks->std_id)) {
                   $get_gpa =($mks->point)/($mks->credit);
                   echo $gpa = number_format($get_gpa, 3);
                 }
               }
             } ?>
           </p>
         </div>
       </div>
       <br>
       <?php } ?>
     </div>
     <script type="text/php">
     if ( isset($pdf) ) {
      $x = 540;
      $y = 18;
      $text = "{PAGE_NUM} of {PAGE_COUNT}";
      $font = $fontMetrics->get_font("helvetica", "bold");
      $size = 6;
      $color = array(0,0,0);
  $word_space = 0.0;  //  default
  $char_space = 0.0;  //  default
  $angle = 0.0;   //  default
  $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
}
if ( isset($pdf) ) {
  $x = 480;
  $y = 807;
  $text = "ECS TEAM";
  $font = $fontMetrics->get_font("helvetica", "bold");
  $size = 6;
  $color = array(0,0,0);
  $word_space = 0.0;  //  default
  $char_space = 0.0;  //  default
  $angle = 0.0;   //  default
  $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
}
</script>
</body></html>
