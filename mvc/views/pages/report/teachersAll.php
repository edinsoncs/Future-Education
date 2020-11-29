<html><head>
  <title>Informe de profesores</title>
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
    <h4 align="center"> Informe de profesores</h4>
  </div>
  <p><b>Departamento : </b>
    <?php if(isset($dept_fill_name)){
      if ($dept_fill_name != '') {
        echo $dept_fill_name->dept_name;
      }
    }
    ?>
  </p>
  <table class="table-bordered" width="100%">
    <thead style="font-size:12px;" >
      <tr>
        <th>ID</th>
        <th> ID de visualización </th>
        <th> Nombre </th>
        <th> Designación </th>
        <th> Departamento </th>
        <th> DOJ </th>
        <th> Correo electrónico </th>
        <th> Número de contacto </th>
      </tr>
    </thead>
    <tbody style="font-size:11px;" >
      <?php foreach ($teacher_info as $row) {
       if(($row->access_type)!=0){
         if(isset($dept_fill_name)){
           if ($dept_fill_name != '') {
             if(($dept_fill_name->dept_sort_name)==($row->teacher_department)){ ?>
             <tr>
              <td><?php echo $row->id; ?></td>
              <td><?php echo $row->display_id; ?></td>
              <td class="capitalize"><?php echo $row->teacher_name; ?></td>
              <td class="capitalize"><?php echo $row->teacher_designation; ?></td>
              <td class="uppercase"><?php echo $row->teacher_department; ?></td>
              <td><?php echo $row->date_of_join; ?></td>
              <td><?php echo $row->email_address; ?></td>
              <td><?php echo $row->contact_no; ?></td>
            </tr>
            <?php  } } }else { ?>
            <tr>
              <td><?php echo $row->id; ?></td>
              <td><?php echo $row->display_id; ?></td>
              <td class="capitalize"><?php echo $row->teacher_name; ?></td>
              <td class="capitalize"><?php echo $row->teacher_designation; ?></td>
              <td class="uppercase"><?php echo $row->teacher_department; ?></td>
              <td><?php echo $row->date_of_join; ?></td>
              <td><?php echo $row->email_address; ?></td>
              <td><?php echo $row->contact_no; ?></td>
            </tr>
        <?php } } } ?>
      </tbody>
    </table>
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



      
      
