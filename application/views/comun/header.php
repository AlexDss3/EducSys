<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EducSys</title>

    <!-- Bootstrap CSS
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     -->
     
    <!--https://getbootstrap.com/docs/4.4/getting-started/introduction/-->
    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" />
    
    <!--https://demos.creative-tim.com/now-ui-kit/docs/1.0/getting-started/introduction.html-->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/paper-kit.css">

    
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    
    <!--<link rel="stylesheet" href="<?php //echo base_url()?>assets/css/bootstrap.css">-->
    <!--<link rel="stylesheet" href="<?php //echo base_url()?>assets/css/bootstrap-grid.css">-->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap-grid.min.css">
    <!--<link rel="stylesheet" href="<?php //echo base_url()?>assets/css/bootstrap-reboot.css">-->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap-reboot.min.css">
    <!--<link rel="stylesheet" href="<?php //echo base_url()?>assets/css/bootstrap-utilities.css">-->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap-utilities.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/modalizar.css">
    
    <!--Scripts-->
    <!--https://sweetalert.js.org/docs/-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!--   Core JS Files   -->
    <script src="<?php echo base_url()?>assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <!--<script src="<?php //echo base_url()?>assets/js/core/bootstrap.bundle.js" type="text/javascript"></script>-->
    <script src="<?php echo base_url()?>assets/js/core/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/js/core/bootstrap.js" type="text/javascript"></script>
    <!--<script src="<?php //echo base_url()?>assets/js/core/bootstrap.esm.js" type="text/javascript"></script>-->
    <script src="<?php echo base_url()?>assets/js/core/bootstrap.esm.min.js" type="text/javascript"></script>

    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="<?php echo base_url()?>assets/js/plugins/bootstrap-switch.js"></script>

    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="<?php echo base_url()?>assets/js/plugins/nouislider.min.js" type="text/javascript"></script>

    <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
    <script src="<?php echo base_url()?>assets/js/plugins/moment.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>

    <!-- Control Center for Paper Kit: parallax effects, scripts for the example pages etc -->
    <script src="<?php echo base_url()?>assets/js/paper-kit.min.js" type="text/javascript"></script>

    <!-- Script para Jquery -->
    <script src="<?php echo base_url()?>assets/js/jquery-3.6.0.js" type="text/javascript"></script>

<!-- ESTILOS PERSONALIZADOS -->
<style>    
  .bmenu {
    overflow: hidden;
    background-color: #0033cc; 
  }

  .bmenu a {
    float: left;
    font-size: 16px;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
  }

  .submenu {
    float: left;
    overflow: hidden;
  }

  .submenu .submenubtn {
    font-size: 16px;  
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
  }

  .bmenu a:hover, .submenu:hover .submenubtn {
    background-color: #009933;
  }

  .submenu-content {
    display: none;
    position: absolute;
    left: 0;
    background-color: #009933;
    width: 100%;
    z-index: 1;
  }

  .submenu-content a {
    float: left;
    color: white;
    text-decoration: none;
  }

  .submenu-content a:hover {
    background-color: #33cc33;
    color: black;
  }

  .submenu:hover .submenu-content {
    display: block;
  }

  /* ESTILOS PERSONALIZADOS */

  /* TARJETAS */
  .tarjeta-profesor{
    background-color: #EED6B5;
    color: black;
    width: 18rem;
    margin-top: 2em;
  }

  .tarjeta-materias{
    background-color: #B4D1FF;
    color: black;
    width: 18rem;
    margin-top: 2em;
  }

  .tarjeta-grados{
    background-color: #FFBFBF;
    color: black;
    width: 18rem;
    margin-top: 2em;
  }
  
  .tarjeta-materianivel{
    background-color: #B5FFDB;
    color: black;
    width: 18rem;
    margin-top: 2em;
  }
  
  .tarjeta-planificaciones{
    background-color: #fecbab;
    color: black;
    width: 18rem;
    margin-top: 2em;
  }

  .tarjeta-asignaciones{
    background-color: #aaddff;
    color: black;
    width: 18rem;
    margin-top: 2em;
  }

  .centrar{
    padding-left: 4.7em;
  }

  .imagenes{
    width: 200px;
    opacity: 0.6;
  }

  .centrar-imagen{
    padding-left: 7.5em;
  }

  .logo{
    width: 120px;
    padding-bottom: 5px;
    padding-left: 5px;
  }

  .fondo{
    background-image: url('<?php echo base_url()?>assets/img/fondo.png');
    background-repeat: repeat;
    background-position: 50%;
    background-attachment: fixed;
    background-size: 75%;
  }

  .fondo-tabla{
    background-color: #fff;
  }
</style>

</head>

<body class="fondo">

<div class="navbar navbar-expand-sm navbar-light bg-light">

  <a href="<?php echo base_url().'index.php/InicioControlador/PerfilUsuario'; ?>" title="inicio">
    <img src="<?php echo base_url()?>assets/img/logoedusys.png" class="logo">
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse">
      
      <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">

        <li class="nav-item">
          <a class="nav-link" style="padding-bottom: 0px; padding-top: 15px;">
            <div class="row">
              <div class="col">
                <i class="material-icons"  style="color: black;">person</i>
              </div>
              <div class="col">
                <p style="color: black;"><?php echo $user;?></p>
              </div>
            </div>
          </a>
        </li>

        <li class="nav-item dropdown" style="padding-buttom: 2px;">
          <a class="nav-link dropdown-toggle"  style="padding-bottom: 0px; padding-top: 15px;" href="" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
            <div class="row">
              <div class="col">
                <i class="material-icons" style="color: black;">settings</i>
              </div>
              <div class="col">
                <p style="color:black;">Opciones</p>
              </div>
            </div>
          </a>
          
          <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">

            <li>
              <a class="dropdown-item" href="<?php echo base_url().'index.php/InicioControlador/PerfilUsuario'; ?>">
                <div class="row">
                  <div class="col" style="padding: 0px; margin: 0px;">
                    <i class="material-icons">home</i>
                  </div>
                  <div class="col" style="padding: 0px; margin: 0px;">
                    <p style="color: black;">Inicio</p>
                  </div>
                </div>
              </a>
            </li>

            <li>
              <a class="dropdown-item" href="<?php echo base_url().'index.php/Info/AcercaDe'?>">
                <div class="row">
                  <div class="col" style="padding: 2px; margin: 0px;">
                    <i class="material-icons">help</i>
                  </div>
                  <div class="col" style="padding: 2px; margin: 0px;">
                    <p style="color: black;">Acerca de</p>
                  </div>
                </div>
              </a>
            </li>

            <li>
              <a class="dropdown-item" href="<?php echo base_url().'index.php/InicioControlador/CerrarSesion'?>">
                <div class="row">
                  <div class="col" style="padding: 0px; margin: 0px;">
                    <i class="material-icons">logout</i>
                  </div>
                  <div class="col" style="padding: 0px; margin: 0px;">
                    <p style="color: black;">Cerrar Sesión</p>
                  </div>
                </div>
              </a>
            </li>

          </ul>

        </li>
      
      </ul>
  </div>

  

</div>

  <div class="container">
    
                
    
