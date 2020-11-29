
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Play:400,700&subset=cyrillic,cyrillic-ext,greek,latin-ext" rel="stylesheet">

  <title></title>

  <style type="text/css">
  .stepwizard-step p {
    margin-top: 10px;
  }
  .stepwizard-row {
    display: table-row;
  }
  .stepwizard {
    display: table;
    width: 100%;
    position: relative;
  }
  .stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
  }
  .stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
  }
  .stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
  }
  .btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 10px;
  }
  .red-color{color:red;}

  .middie-position{
    -webkit-flexbox;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-flex-align: center;
    -ms-flex-align: center;
    -webkit-align-items: center;
    align-items: center;
    justify-content: center;
  }
</style>

</head>
<body>
  <?php
 
  $bTnCheckount       = 'btn-default';
  $bTnDatabase        = 'btn-default';
  $bTnSite            = 'btn-default';
  $bTnDone            = 'btn-default';
  $bTnPurchasekey     = 'btn-default';

  $dsCheckount       = 'disabled="disabled"';
  $dsDatabase        = 'disabled="disabled"';
  $dsSite            = 'disabled="disabled"';
  $dsDone            = 'disabled="disabled"';
  $dsPurchasekey     = 'disabled="disabled"';

  if($checkout == 1) {
    $bTnCheckount = 'btn-info';
    $dsCheckount ='';
  }

  if($purchasekey == 1) {
    $bTnPurchasekey = 'btn-info';
    $dsPurchasekey ='';
  }

  if($database == 1) {
    $bTnDatabase = 'btn-info';
    $dsDatabase = '';
  }

  if($site == 1) {
   $bTnSite    = 'btn-info';
   $dsSite = '';
 }

 if($done == 1) {
   $bTnDone    = 'btn-info';
   $dsDone = '';
 }


 ?>
 <div class="container"></br>
  <div class="row">
    <div class="col-md-6 col-sm-8 col-xs-11 col-center" >
      <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
          <div class="stepwizard-step">
            <a href="<?php if($checkout == 1) { echo base_url('install/index'); } else { echo '#'; }?>" type="button" class="btn btn-circle <?=$bTnCheckount?>" <?=$dsCheckount?> >1</a>
            <p>Paso 1</p>
          </div>
          <div class="stepwizard-step">
            <a href="<?php if($purchasekey == 1) { echo base_url('install/purchasekey'); } else { echo '#'; }?>" type="button" class="btn btn-circle <?=$bTnPurchasekey?>" <?=$dsPurchasekey?> >2</a>
            <p>Paso 2</p>
          </div>
          <div class="stepwizard-step">
            <a href="<?php if($database == 1) { echo base_url('install/database'); } else { echo '#'; }?>" type="button" class="btn btn-circle <?=$bTnDatabase?>" <?=$dsDatabase?> >3</a>
            <p>Paso 3</p>
          </div>
          <div class="stepwizard-step">
            <a href="<?php if($site == 1) { echo base_url('install/site'); } else { echo '#'; }?>" type="button" class="btn btn-circle <?=$bTnSite?>" <?=$dsSite?> >4</a>
            <p>Paso 4</p>
          </div>
          <div class="stepwizard-step">
            <a href="<?php if($done == 1) { echo base_url('install/done'); } else { echo '#'; }?>" type="button" class="btn btn-circle <?=$bTnDone?>" <?=$dsDone?> >5</a>
            <p>Paso 5</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  $this->load->view($subview);
  ?>
</div>
</body>
</html>
