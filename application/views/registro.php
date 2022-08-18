<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Demo CodeIgniter con Bootstrap</title>

    <!-- Bootstrap CSS
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     -->
     
    <!--https://getbootstrap.com/docs/4.4/getting-started/introduction/-->
    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" />
    
    <!--https://demos.creative-tim.com/now-ui-kit/docs/1.0/getting-started/introduction.html-->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/paper-kit.css">

    
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/modalizar.css">
    
    <!--Scripts-->
    <!--https://sweetalert.js.org/docs/-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!--   Core JS Files   -->
    <script src="<?php echo base_url()?>assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/js/core/bootstrap.min.js" type="text/javascript"></script>

    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="<?php echo base_url()?>assets/js/plugins/bootstrap-switch.js"></script>

    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="<?php echo base_url()?>assets/js/plugins/nouislider.min.js" type="text/javascript"></script>

    <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
    <script src="<?php echo base_url()?>assets/js/plugins/moment.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>

    <!-- Control Center for Paper Kit: parallax effects, scripts for the example pages etc -->
    <script src="<?php echo base_url()?>assets/js/paper-kit.min.js" type="text/javascript"></script>
    
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

    .logo-sistema{
        width: 30em;
    }
</style>

</head>

<body>
    <form class="needs-validation" method="post" id="frm">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h3>Registrar Director</h3>
                <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
                <br>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Miguel" required>
                        <small id="NombreAyuda" class="invalid-feedback"></small>
                    </div>
                    <div class="form-group col">
                        <label for="nombre">Apellido:</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Velasquez">
                        <small id="ApellidoAyuda" class="invalid-feedback"></small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nombre">Correo:</label>
                    <input type="text" class="form-control" id="correo" name="correo" placeholder="mvelasquez@mail.com">
                    <small id="CorreoAyuda" class="invalid-feedback"></small>
                </div>
                <div class="form-group">
                    <label for="nombre">Telefono:</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="75453431">
                    <small id="TelefonoAyuda" class="invalid-feedback"></small>
                </div>
                <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Mv">
                    <small id="UsuarioAyuda" class="invalid-feedback"></small>
                </div>
                <div class="form-group">
                    <label for="clave">Contraseña:</label>
                    <input type="password" class="form-control" id="clave" name="clave" placeholder="**********">
                    <small id="ClaveAyuda" class="invalid-feedback"></small>
                </div>
                <div class="form-group">
                    <input type="hidden" name="idRol" id="idRol" value="1">
                </div>
            </div>
            <div class="col-md-8 offset-md-2 text-right">
                <a href="<?php echo base_url()?>" class="btn btn-primary">Volver</a>
                <button type="submit" class="btn btn-warning">Guardar</button>
            </div>
        </div>
    </form>
</body>

<script type="text/javascript">
	$(function(){

        /* PARA VALIDAR EL FORMULARIO */
        const formulario = $('#frm');
        const inputs = document.querySelectorAll('#frm input');

        const expresiones = {
            nombre: /^[a-zA-ZÀ-ÿ\s]{4,25}$/,
            apellido: /^[a-zA-ZÀ-ÿ\s]{4,25}$/,
            correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
            telefono: /^\d{8}$/,
            usuario: /^[a-zA-Z0-9\_\-]{3,16}$/,
            clave: /^.{6,20}$/
        }

        const campos = {
            nombre: false,
            apellido: false,
            correo: false,
            telefono: false,
            usuario: false,
            clave: false
        }

        const validarFormulario = (e) => {
            switch(e.target.name){
                case "nombre":
                    if(expresiones.nombre.test(e.target.value)){
                        $('#nombre').css('border', '2px solid #1ed12d');
                        $('#NombreAyuda').hide();
                        campos['nombre'] = true;
                    }else{
                        $('#nombre').css('border', '2px solid #bb2929');
                        $('#NombreAyuda').html('El campo es obligatorio y sin caracteres especiales');
                        $('#NombreAyuda').show();
                        campos['nombre'] = false;
                    }
                    break;
                case "apellido":
                    if(expresiones.apellido.test(e.target.value)){
                        $('#apellido').css('border', '2px solid #1ed12d');
                        $('#ApellidoAyuda').hide();
                        campos['apellido'] = true;
                    }else{
                        $('#apellido').css('border', '2px solid #bb2929');
                        $('#ApellidoAyuda').html('El campo es obligatorio y sin caracteres especiales');
                        $('#ApellidoAyuda').show();
                        campos['apellido'] = false;
                    }
                    break;
                case "correo":
                    if(expresiones.correo.test(e.target.value)){
                        $('#correo').css('border', '2px solid #1ed12d');
                        $('#CorreoAyuda').hide();
                        campos['correo'] = true;
                    }else{
                        $('#correo').css('border', '2px solid #bb2929');
                        $('#CorreoAyuda').html('El campo es obligatorio y el correo debe ser válido');
                        $('#CorreoAyuda').show();
                        campos['correo'] = false;
                    }
                    break;
                case "telefono":
                    if(expresiones.telefono.test(e.target.value)){
                        $('#telefono').css('border', '2px solid #1ed12d');
                        $('#TelefonoAyuda').hide();
                        campos['telefono'] = true;
                    }else{
                        $('#telefono').css('border', '2px solid #bb2929');
                        $('#TelefonoAyuda').html('El campo es obligatorio y solo debe contener números con un máximo de 8 caracteres');
                        $('#TelefonoAyuda').show();
                        campos['telefono'] = false;
                    }
                    break;
                case "usuario":
                    if(expresiones.usuario.test(e.target.value)){
                        $('#usuario').css('border', '2px solid #1ed12d');
                        $('#UsuarioAyuda').hide();
                        campos['usuario'] = true;
                    }else{
                        $('#usuario').css('border', '2px solid #bb2929');
                        $('#UsuarioAyuda').html('El campo es obligatorio y debe tener 3 caracteres como mínimo');
                        $('#UsuarioAyuda').show();
                        campos['usuario'] = false;
                    }
                    break;
                case "clave":
                    if(expresiones.clave.test(e.target.value)){
                        $('#clave').css('border', '2px solid #1ed12d');
                        $('#ClaveAyuda').hide();
                        campos['clave'] = true;
                    }else{
                        $('#clave').css('border', '2px solid #bb2929');
                        $('#ClaveAyuda').html('El campo es obligatorio y  debe tener de 6 a 20 caracteres');
                        $('#ClaveAyuda').show();
                        campos['clave'] = true;
                    }
                    break;
            }
        }

        inputs.forEach((input) => {
            input.addEventListener('blur', validarFormulario);
            input.addEventListener('keyup', validarFormulario);
        });

		$('#frm').submit(function(e){
			e.preventDefault();
            $('#errors').hide();

            if (campos.nombre && campos.apellido && campos.correo && campos.telefono && campos.usuario && campos.clave) {
                swal({
                title: "Guardar",
                text: "¿Está seguro que desea guardar el Profesor?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                }).then((result) => {
                    if (result) {
                        var nombre      = $('#nombre').val();
                        var apellido    = $('#apellido').val();
                        var correo      = $('#correo').val();
                        var telefono    = $('#telefono').val();
                        var usuario     = $('#usuario').val();
                        var clave       = $('#clave').val();
                        var idRol       = $('#idRol').val();
                        
                        var data = {nombre: nombre, apellido: apellido, correo: correo, telefono: telefono, usuario: usuario, clave: clave, idRol: idRol};

                        $.post('<?php echo base_url()?>index.php/ProfesoresControlador/Insertar',data,function(response){
                            if(response == 'ok'){
                                window.location = '<?php echo base_url()?>';
                            }else{
                                $('#errors').html(response);
                                $('#errors').show();
                            }
                        });
                    }
                });
            }

		});
	});
</script>

</html>