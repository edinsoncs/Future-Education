<html><head>
  <title>Informe del estudiante</title>
  <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
  <style type="text/css">
  table thead tr th{padding:5px 2px 5px 2px;}
  table tbody tr td{padding:9px 2px 9px 2px;}
  </style>
</head><body>
  <div class="col-sm-12" style="padding:0px;margin:0px;">
    <h6 align="right" style="margin:0px;">Imprimir por : <?php getLoginUserName(); ?></h6>
    <h6 align="right" style="margin-top:1px; margin:0px;">Fecha de impresion : <?php echo date("d-m-Y")?></h6>
  </div>
  <div class="container">
    <h3 align="center"><img style="height:50px; width:50px;" src="<?php echo base_url( getSite()->site_logo);?>" />&nbsp;<?php echo getSite()->name; ?></h3>
    <h4 align="center">Información básica del estudiante</h4>
  </div>

  <div class="col-center">
    <table class=" table table-bordered">
      <?php if (isset($std_info)) { ?>
      <tbody>
       <tr>
        <td width='40%'><b>ID</b></td>
        <td width='2'>:</td>
        <td><?php echo $std_info->std_id;?></td>
      </tr>
      <tr>
        <td><b>Nombre</b></td>
        <td>:</td>
        <td class="capitalize"><?php echo $std_info->std_name;?></td>
      </tr>
      <tr>
        <td><b>Departamento</b></td>
        <td>:</td>
        <td class="capitalize"><?php  if (isset($dept_fill_name)) { echo $dept_fill_name->dept_name ; }?></td>
      </tr>
      <tr>
        <td><b>Batch</b></td>
        <td>:</td>
        <td class="capitalize"><?php echo $std_info->std_batch ;?></td>
      </tr>
      <tr>
        <td><b>Sección</b></td>
        <td>:</td>
        <td><?php echo $std_info->std_section ;?></td>
      </tr>
      <tr>
        <td><b>Crédito requerido</b></td>
        <td>:</td>
        <td><?php echo $std_info->required_credit;?></td>
      </tr>
      <tr>
        <td><b>Estado</b></td>
        <td>:</td>
        <td>
          <?php
            if (($std_info->std_status)==1) {
              echo "REGULAR";
            }elseif (($std_info->std_status)==2) {
              echo "IRREGULAR";
            }else
            echo "COMPLETE";
          ?>
      </tr>
      <tr>
        <td><b>Género</b></td>
        <td>:</td>
        <td class="capitalize"><?php echo $std_info->std_gender;?></td>
      </tr>
      <tr>
        <td><b>Lugar</b></td>
        <td>:</td>
        <td class="capitalize"><?php echo $std_info->std_religion;?></td>
      </tr>
      <tr>
        <td><b>Email Address</b></td>
        <td>:</td>
        <td><?php echo $std_info->std_email_address ;?></td>
      </tr>
      <tr>
        <td><b>Contacto no</b></td>
        <td>:</td>
        <td><?php echo $std_info->std_contact_no ;?></td>
      </tr>
    </tbody>
    <?php }?>
  </table>
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
  $text = "Powered By Morning Sun IT";
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



















