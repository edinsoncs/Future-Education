<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset = "utf-8">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title><?php echo getSite()->name; ?> | Campus </title>
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
      <div class="col-md-4 col-sm-12"><br>
        <h2 class="middie-position">
          <img style="height: 50px; width: 50px;" src="<?php echo base_url( getSite()->site_logo);?>" /> &nbsp;<?php echo getSite()->name; ?>
        </h2>
        <div class="login-box gm ">
          <?php echo form_open();?>
          <legend>SISTEMA DE INGRESO</legend>

          <div class="form-group">
            <label for="username">Usuario</label>
            <?php
            $username = array(
              'id' => 'username_post',
              'name' => 'username_post',
              'type' => 'text',
              'placeholder' => 'Usuario',
              'class' => 'form-control',
              );
            echo form_input($username);
            ?>
            <?php echo form_error('username_post','<div class="error">','</div>'); ?>
          </div>
          <div class="form-group">
            <label for="password">Contraseña</label>
            <?php
            $password = array(
              'id' => 'password',
              'name' => 'password',
              'type' => 'password',
              'placeholder' => 'Contraseña',
              'class' => 'form-control',
              );
            echo form_password($password);
            ?>
            <?php echo form_error('password','<div class="error">','</div>');?>
          </div>
          <div class="input-group">
            <div class="checkbox">
              <label>
                <input id="login-remember" type="checkbox" name="remember" value="1"> Recordar
              </label>
            </div>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-default btn-login-submit btn-block" value="Ingresar" />
          </div>
          <?php echo form_close();?>
          <span class='text-center'><a href="<?php echo base_url('login/forgetPassword');?>" class="text-sm">Restablecer contraseña?</a></span>
        </div>
      </div>
      <div class='col-md-3'></div>
    </div>
  </div>
  <footer class="col-sm-12"><br><br><br>
    <p class="pull-right">ECS TEAM</p>
  </footer>
  <!-- Success notification  -->
  <?php if($this->session->flashdata('success')): ?>
  <script type="text/javascript">
  toastr.success("<?=$this->session->flashdata('success');?>","Success");
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
