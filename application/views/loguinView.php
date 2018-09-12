<?php $cdn=base_url().'assets/cdn/'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Rock Drill | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $cdn; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $cdn; ?>bower_components/font-awesome/css/font-awesome.min.css" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $cdn; ?>bower_components/Ionicons/css/ionicons.min.css" crossorigin="anonymous">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $cdn; ?>dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo $cdn; ?>plugins/iCheck/square/blue.css">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>assets/img/logo-rock.ico">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    Almacenes Virtuales <b>ROCKDRILL</b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingrese usando su DNI como usuario y clave</p>
      <div class="form-group">
        <div id="msg"></div>
      </div>
    <form   method="post" id="form-login">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Usuario" name="txtUsuario" id="txtUsuario">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Contraseña" name="txtClave">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <select name="contrato" id="contratos" class="form-control">


        </select>
      </div>
      <div class="row">

        <!-- /.col -->
        <div class="col-xs-4">
          <center><button type="button" class="btn btn-primary btn-block btn-flat" id="ingresar">Ingresar</button></center>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <br>

    <!-- /.social-auth-links -->



  </div>
  <!-- /.login-box-body -->
</div>

<script>
	var base_url="<?php echo base_url(); ?>";
</script>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo $cdn; ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $cdn; ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo $cdn; ?>plugins/iCheck/icheck.min.js"></script>

<script src="<?php echo base_url() ?>js/login.js"></script>
<script>

</script>

</body>
</html>
