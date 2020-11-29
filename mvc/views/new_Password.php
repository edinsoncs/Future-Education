<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset = "utf-8">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title><?php echo getSite()->name;?> | Create New Password</title>
  <link rel="shortcut icon" href="<?php echo base_url(getSite()->site_logo);?>"/>
  <meta name="generator" content="Bootply" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css";>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/custom.css";>
  <link href="https://fonts.googleapis.com/css?family=Play:400,700&subset=cyrillic,cyrillic-ext,greek,latin-ext" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/toastr/build/toastr.min.css" rel="stylesheet" type="text/css">
  <script type='text/javascript' src="<?php echo base_url('assets/js/jquery-1.12.0.min.js');?>"> </script>
  <script type='text/javascript' src="<?php echo base_url();?>assets/toastr/build/toastr.min.js"></script>

</head>
<body>
  <div class="container">
      <div class="row  middie-position">
          <div class='col-md-3'></div>
          <div class="col-md-4"><br>
            <h2 class="middie-position">
              <img style="height: 50px; width: 50px;" src="<?php echo base_url( getSite()->site_logo);?>" /> &nbsp;<?php echo getSite()->name; ?>
            </h2>
              <div class="login-box gm">
                <?php echo form_open(base_url('login/new_password'));?>
                    <legend>Cambiar Contraseña</legend>
                    <div class="form-group">
                        <label for="password1">Nueva Contraseña</label>
                        <?php
                        $password1 = array(
                        'id' => 'password1',
                        'name' => 'password1',
                        'type' => 'password',
                        'placeholder' => 'Nueva Contraseña',
                        'class' => 'form-control',
                        'required' => 'required',
                        );
                        echo form_input($password1);
                        ?>
                        <?php echo form_error('password1','<div class="error">','</div>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="password2">Confirmar Contraseña</label>
                        <?php
                        $password2 = array(
                        'id' => 'password2',
                        'name' => 'password2',
                        'type' => 'password',
                        'placeholder' => 'Confirmar Contraseña',
                        'class' => 'form-control',
                        'required' => 'required',
                        );
                        echo form_input($password2);
                        ?>
                        <?php echo form_error('password2','<div class="error">','</div>'); ?>
                    </div>
                     <?php echo form_hidden('code', $code) ; ?>
                    <div class="form-group">
                        <input type="submit" class="btn btn-default btn-login-submit btn-block" value="Cambiar" />
                    </div>
                  <?php echo form_close();?>
              </div>
          </div>
          <div class='col-md-3'></div>
      </div>
  </div>
<footer class="col-sm-12"><br><br><br><br><br><br><br><br><br><br><br>
  <p class="pull-right">Powered by Morning Sun IT</p>
</footer>
<!-- Success notification  -->
<?php if($this->session->flashdata('errors')): ?>
<script type="text/javascript">
toastr.error("<?=$this->session->flashdata('errors');?>","Errors");
toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
</script>
<?php endif ?>
</body>
</html>
