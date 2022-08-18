<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Agregar Grado Académico</h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <br>
            <div class="form-row">
                <div class="form-group col">
                    <label for="tipo">Tipo</label>
                    <select class="form-control" id="tipo" name="tipo" aria-placeholder="Tipo" required>
                        <option value="">Elegir tipo...</option>
                        <option value="B">Educación Básica</option>
                        <option value="M">Educación Media</option>
                    </select>
                    <small id="TipoAyuda" class="invalid-feedback"></small>
                </div>
                <div class="form-group col">
                    <label for="nivel">Nivel</label>
                    <select class="form-control" id="nivel" name="nivel" aria-placeholder="Nivel" required>
                        <option value="">Elegir nivel...</option>
                    </select>
                    <small id="NivelAyuda" class="invalid-feedback"></small>
                </div>
            </div>
            <div class="form-group">
                <label for="seccion">Sección</label>
                <input type="text" class="form-control" id="seccion" name="seccion" placeholder="Primer Grado A" required>
                <small id="SeccionAyuda" class="invalid-feedback"></small>
                <small id="SeccionExiste" class="invalid-feedback"></small>
            </div>
        </div>
        <div class="col-md-8 offset-md-2 text-right">
            <a href="<?php echo base_url()?>index.php/PerfilesControlador/VerGrados" class="btn btn-primary">Volver</a>
            <button type="submit" class="btn btn-warning">Guardar</button>
        </div>
    </div>
</form>

<script type="text/javascript">
	$(function(){
        $('#errors').hide();
        const input = document.querySelector('input');
        const log = document.getElementById('seccion');
        var sec;
        const selec = document.querySelector("#nivel");

        input.addEventListener('input', updateValue);

        function updateValue(e) {
            log.textContent = e.srcElement.value;
            sec = log.textContent;
        }

        /* ELEGIR EL TIPO DE NIVEL EDUCATIVO */
        $("#tipo").click(function(){

            /* COMPROBAMOS QUE SE ELIJA UNA DE LAS DOS OPCIONES */
            if ($("#tipo").val() == "B") {
                
                /* LIMPIAMOS EL NIVEL ANTERIOR */
                for (let j = 10; j <= 12; j++) {
                    $("#nivel option[value="+j+"]").remove();
                }

                /* MOSTRAMOS LOS NIVELES PARA B */
                for (let i = 1; i <= 9; i++) {
                    $("#nivel").append($('<option value="'+i+'">'+i+'°</option>'));
                }
                
                /* LIMPIAMOS NIVELES REPETIDOS EN CASO DE VOLVER A ABRIR EL SELECT */
                if (selec.option.lenght > 9) {
                    for (let k = 1; k <= 9; k++) {
                        $("#nivel option[value="+k+"]").remove();
                    }
                }

            }else if($("#tipo").val() == "M"){

                /* LIMPIAMOS EL NIVEL ANTERIOR */
                for (let j = 1; j <= 9; j++) {
                    $("#nivel option[value="+j+"]").remove();
                }

                /* MOSTRAMOS LOS NIVELES PARA M */
                for (let i = 10; i <= 12; i++) {
                    $("#nivel").append($('<option value="'+i+'">'+i+'°</option>'));
                }

                /* LIMPIAMOS NIVELES REPETIDOS EN CASO DE VOLVER A ABRIR EL SELECT */
                if (selec.option.lenght > 3) {
                    for (let k = 10; k <= 12; k++) {
                        $("#nivel option[value="+k+"]").remove();
                    }
                }
            }
        });

        /* PARA VALIDAR EL FORMULARIO */
        const formulario = $('#frm');
        const inputs = document.querySelectorAll('#frm input');

        const expresiones = {
            seccion: /^[a-zA-ZÀ-ÿ0-9_,.\s]{14,50}$/
        }

        const campos = {
            seccion: false
        }

        const validarFormulario = (e) => {
            switch(e.target.name){
                case "seccion":
                    if(expresiones.seccion.test(e.target.value)){
                        $('#seccion').css('border', '2px solid #1ed12d');
                        $('#SeccionAyuda').hide();
                        campos['seccion'] = true;
            
                        var dato = {seccion: sec};
                        
                        $.post('<?php echo base_url()?>index.php/GradosControlador/BuscaSeccion',dato,function(response) {
                            if(response == 'ok'){
                                $('#seccion').css('border', '2px solid #bb2929');
                                $('#SeccionExiste').html('La sección: '+sec+' ya existe!');
                                $('#SeccionExiste').show();
                                campos['seccion'] = false;
                            }else{
                                $('#seccion').css('border', '2px solid #1ed12d');
                                $('#SeccionExiste').hide();
                            }
                        });

                    }else{
                        $('#seccion').css('border', '2px solid #bb2929');
                        $('#SeccionAyuda').html('Pocos caracteres para una sección');
                        $('#SeccionAyuda').show();
                        campos['seccion'] = false;
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

            if (campos.seccion) {
                swal({
                    title: "Guardar",
                    text: "¿Está seguro que desea guardar el Grado?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    if (result) {
                        var nivel       = $('#nivel').val();
                        var tipo        = $('#tipo').val();
                        var seccion     = $('#seccion').val();
                        
                        var data = {nivel: nivel, tipo: tipo, seccion: seccion};
                        $.post('<?php echo base_url()?>index.php/GradosControlador/insertar',data,function(response){
                            if(response == 'ok'){
                                window.location = "<?php echo base_url()?>index.php/PerfilesControlador/VerGrados";
                            }else{
                                $('#errors').html("Hubo un error al momento de guardar");
                                $('#errors').show();
                            }
                        });
                    }
                });
            }
		});
	});
</script>