
<?php $cdn=base_url().'assets/cdn/'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Rockdrill | Almacenes Virtuales</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $cdn; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo $cdn; ?>bower_components/select2/dist/css/select2.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $cdn; ?>bower_components/Ionicons/css/ionicons.min.css" >
  <link href="<?php echo base_url()?>/assets/plugins/file-input/fileinput.min.css"  rel="stylesheet" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $cdn; ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $cdn; ?>dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/logo-rock.ico" />

  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo $cdn; ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo $cdn; ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap.min.css" />
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <!-- Google Font  http://cdn.rockdrillgroup.net/admin-lte/-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" crossorigin="anonymous">

<!-- alertify -->
<link rel="stylesheet" href="<?php echo $cdn; ?>bower_components/alertify/css/alertify.min.css" />
<!-- include a theme -->
<link rel="stylesheet" href="<?php echo $cdn; ?>bower_components/alertify/css/themes/default.css" />
<!--  -->
  <?php if(!$this->session->userdata('acceso_id')){
      redirect(base_url().'Login');
  }?>


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url() ?>Contrato" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><?php echo substr($this->session->alm_cc,-3); ?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?php echo $this->session->alm_nombre ?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->

          <!-- Notifications: style can be found in dropdown.less -->

          <!-- Tasks: style can be found in dropdown.less -->

          <!-- User Account: style can be found in dropdown.less -->

          <li class="dropdown text-center">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="true">
                                <img alt="" src="<?php echo $cdn; ?>dist/img/avatar04.png" class="user-image img-circle" height='20px'>
                                <span class="username"><?php echo $this->session->user_nombre.' '.$this->session->user_apepat.' '.$this->session->user_apemat ?> </span> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
                               <?php if($this->session->acceso_submenu_1==1){ ?><li><a href="<?php echo base_url() ?>Contrato/Usuarios"><i class="fas fa-user-cog"></i>&nbsp; Usuarios</a></li><?php } ?>

                                <?php if($this->session->acceso_submenu_2==1){ ?><li><a href="<?php echo base_url() ?>Contrato/Almacenes"><i class="fas fa-warehouse"></i>&nbsp; Administrar Proyectos</a></li><?php } ?>

                                <?php if($this->session->acceso_submenu_3==1){ ?><li><a href="<?php echo base_url() ?>Contrato/Perfiles"><i class="fa fas fa-users"></i>Administrar Perfiles</a></li><?php } ?>

                                <li><a href="<?php echo base_url() ?>Login/logout"><i class="fa fa-sign-out"></i>Cerrar session</a></li>
                            </ul>
                        </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
    </nav>
  </header>
