<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Editar datos del Profesor<?php echo ": ".$profesor[0]->nombre." ".$profesor[0]->apellido;?></h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <div class="form-group">
                <input type="hidden" class="form-control" value="<?php echo $profesor[0]->idUsuario; ?>" id="idUsuario" name="idUsuario" placeholder="idUsuario" readonly>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="nombre">Nombre: </label>
                    <input type="text" class="form-control" value="<?php echo $profesor[0]->nombre; ?>" id="nombre" name="nombre" placeholder="Nombre">
                    <small id="NombreAyuda" class="invalid-feedback"></small>
                </div>
                <div class="form-group col">
                    <label for="apellido">Apellido: </label>
                    <input type="text" class="form-control" value="<?php echo $profesor[0]->apellido; ?>" id="apellido" name="apellido" placeholder="Apellido">
                    <small id="ApellidoAyuda" class="invalid-feedback"></small>
                </div>
            </div>
			<div class="form-group">
                <label for="correo">Correo</label>
                <input type="text" class="form-control" value="<?php echo $profesor[0]->correo; ?>" id="correo" name="correo" placeholder="Correo">
                <small id="CorreoAyuda" class="invalid-feedback"></small>
            </div>
			<div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" value="<?php echo $profesor[0]->telefono; ?>" id="telefono" name="telefono" placeholder="Teléfono">
                <small id="TelefonoAyuda" class="invalid-feedback"></small>
            </div>
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" class="form-control" value="<?php echo $profesor[0]->usuario; ?>" id="usuario" name="usuario" placeholder="Usuario">
                <small id="UsuarioAyuda" class="invalid-feedback"></small>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="editarC">Editar contraseña?</label>
                        <select class="form-control" name="editarC" id="editarC">
                            <option value="1" selected>No</option>
                            <option value="2">Sí</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="clave">Clave</label>
                        <input type="password" class="form-control" id="clave" name="clave" placeholder="************" value="">
                        <small id="ClaveAyuda" class="invalid-feedback"></small>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" name="idRol" id="idRol" value="2">
            </div>
        </div>
        <div class="col-md-4 offset-md-6">
            <div class="row justify-content-end">
                <div class="col-md-auto text-right">
                    <a href="<?php echo base_url()?>index.php/PerfilesControlador/VerProfesores" class="btn btn-primary">Volver</a>
                </div>
                <div class="col-sm-4 text-right">
                    <button type="submit" class="btn btn-warning">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function(){
        // Inicia el campo de contraseña desactivado
        $("#clave").prop('disabled', true);

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
                        $('#NombreAyuda').html('El campo es obligatorio, debe tener más de 4 caracteres y sin caracteres especiales');
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
                        $('#ApellidoAyuda').html('El campo es obligatorio, debe tener más de 4 caracteres y sin caracteres especiales');
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
                        campos['clave'] = false;
                    }
                    break;
            }
        }

        inputs.forEach((input) => {
            input.addEventListener('blur', validarFormulario);
            input.addEventListener('keyup', validarFormulario);
        });

        // Elegimos cómo ocultarlo
        $("#editarC").click(function(){
            if($("#editarC").val() == 1){
                
                $("#clave").prop('disabled', true);

                // ENVIAMOS LOS DATOS EDITADOS MENOS LA CLAVE
                $(function(){
                    $('#frm').submit(function(e){
                        e.preventDefault();
                        $('#errors').hide();
                        
                        if(campos.nombre && campos.apellido && campos.correo && campos.telefono && campos.usuario){
                            swal({
                                title: "Guardar",
                                text: "¿Está seguro que desea editar el Profesor?",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            }).then((result) => {
                                if (result) {
                                    var idUsuario           = $('#idUsuario').val();
                                    var nombre              = $('#nombre').val();
                                    var apellido            = $('#apellido').val();
                                    var correo              = $('#correo').val();
                                    var telefono            = $('#telefono').val();
                                    var usuario             = $('#usuario').val();
                                    var idRol               = $('#idRol').val();
                                    
                                    var data = {idUsuario: idUsuario, nombre: nombre, apellido: apellido, correo: correo, telefono: telefono, usuario: usuario, idRol: idRol};

                                    $.post('<?php echo base_url()?>index.php/ProfesoresControlador/Editar/<?php echo $id;?>',data,function(response){
                                        if(response == 'ok'){
                                            window.location = '<?php echo base_url()?>index.php/PerfilesControlador/VerProfesores';
                                        }else{
                                            $('#errors').html("Error al momento de insertar los datos");
                                            $('#errors').show();
                                        }
                                    });
                                }
                            });
                        }
                        
                    });
                });

            }else if($("#editarC").val() == 2){
                
                $("#clave").prop('disabled', false);

                // ENVIAMOS LA CLAVE EDITADA
                $(function(){
                    $('#frm').submit(function(e){
                        e.preventDefault();
                        $('#errors').hide();
                        
                        if(campos.nombre && campos.apellido && campos.correo && campos.telefono && campos.usuario && campos.clave){
                            swal({
                                title: "Guardar",
                                text: "¿Está seguro que desea editar el Profesor?",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            }).then((result) => {
                                if (result) {
                                    var idUsuario           = $('#idUsuario').val();
                                    var nombre              = $('#nombre').val();
                                    var apellido            = $('#apellido').val();
                                    var correo              = $('#correo').val();
                                    var telefono            = $('#telefono').val();
                                    var usuario             = $('#usuario').val();
                                    var clave               = $('#clave').val();
                                    var idRol               = $('#idRol').val();
                                    
                                    var data = {idUsuario: idUsuario, nombre: nombre, apellido: apellido, correo: correo, telefono: telefono, usuario: usuario, clave: clave, idRol: idRol};

                                    $.post('<?php echo base_url()?>index.php/ProfesoresControlador/Editar/<?php echo $id;?>',data,function(response){
                                        if(response == 'ok'){
                                            window.location = '<?php echo base_url()?>index.php/PerfilesControlador/VerProfesores';
                                        }else{
                                            $('#errors').html("Error al momento de insertar los datos");
                                            $('#errors').show();
                                        }
                                    });
                                }
                            });
                        }
                        
                    });
                });
                
            }
        });
    });
	
</script>