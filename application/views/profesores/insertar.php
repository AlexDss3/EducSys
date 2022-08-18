<form class="needs-validation" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Agregar Nuevo Profesor</h3>
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
                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Velasquez" required>
                    <small id="ApellidoAyuda" class="invalid-feedback"></small>
                </div>
            </div>
            <div class="form-group">
                <label for="nombre">Correo:</label>
                <input type="text" class="form-control" id="correo" name="correo" placeholder="mvelasquez@mail.com" required>
                <small id="CorreoAyuda" class="invalid-feedback"></small>
            </div>
            <div class="form-group">
                <label for="nombre">Telefono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="75453431" required>
                <small id="TelefonoAyuda" class="invalid-feedback"></small>
            </div>
			<div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Mv" required>
                <small id="UsuarioAyuda" class="invalid-feedback"></small>
            </div>
			<div class="form-group">
                <label for="clave">Contraseña:</label>
                <input type="password" class="form-control" id="clave" name="clave" placeholder="**********" required>
                <small id="ClaveAyuda" class="invalid-feedback"></small>
            </div>
			<div class="form-group">
                <input type="hidden" name="idRol" id="idRol" value="2">
            </div>
        </div>
        <div class="col-md-8 offset-md-2 text-right">
            <a href="<?php echo base_url()?>index.php/PerfilesControlador/VerProfesores" class="btn btn-primary">Volver</a>
            <button type="submit" class="btn btn-warning">Guardar</button>
        </div>
    </div>
</form>

<script type="text/javascript">
	$(document).ready(function(){

        /* PARA VALIDAR EL FORMULARIO */
        const formulario = $('#frm');
        const inputs = document.querySelectorAll('#frm input');

        const expresiones = {
            nombre: /^[a-zA-ZÀ-ÿ\s]{4,25}$/,
            apellido: /^[a-zA-ZÀ-ÿ\s]{4,25}$/,
            correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9]+$/,
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

                        const correo = $("#correo").val();

                        var dato = {correo: correo};
        
                        $.post('<?php echo base_url()?>index.php/ProfesoresControlador/BuscaCorreo',dato,function(response) {
                            if(response == 'cor'){
                                $('#correo').css('border', '2px solid #bb2929');
                                $('#CorreoAyuda').html('El correo: '+correo+', ya existe!');
                                $('#CorreoAyuda').show();
                                campos['correo'] = false;
                            }else{
                                $('#correo').css('border', '2px solid #1ed12d');
                                $('#CorreoAyuda').hide();
                            }
                        });

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
                        
                        const telefono = $("#telefono").val();
                        
                        var dato = {telefono: telefono};
                        
                        $.post('<?php echo base_url()?>index.php/ProfesoresControlador/BuscaTelefono',dato,function(response) {

                            if(response == 'tel'){
                                $('#telefono').css('border', '2px solid #bb2929');
                                $('#TelefonoAyuda').html('El teléfono: '+telefono+', ya existe!');
                                $('#TelefonoAyuda').show();
                                campos['telefono'] = false;
                            }else{
                                $().html();
                                $('#telefono').css('border', '2px solid #1ed12d');
                                $('#TelefonoAyuda').hide();
                            }
                        });

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

                        const usuario = $("#usuario").val();
                        
                        var dato = {usuario: usuario};
                        
                        $.post('<?php echo base_url()?>index.php/ProfesoresControlador/BuscaUsuario',dato,function(response) {

                            if(response == 'usu'){
                                $('#usuario').css('border', '2px solid #bb2929');
                                $('#UsuarioAyuda').html('El teléfono: '+usuario+', ya existe!');
                                $('#UsuarioAyuda').show();
                                campos['usuario'] = false;
                            }else{
                                $().html();
                                $('#usuario').css('border', '2px solid #1ed12d');
                                $('#UsuarioAyuda').hide();
                            }
                        });

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
                        campos['clave'] = false;
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
                                window.location = '<?php echo base_url()?>index.php/PerfilesControlador/VerProfesores';
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