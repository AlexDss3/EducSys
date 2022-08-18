<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Agregar materia</h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <br>
            <div class="form-group">
                <label for="materia">Materia:</label>
                <input type="text" class="form-control" id="materia" name="materia" placeholder="Matemática...">
                <small id="MateriaAyuda" class="invalid-feedback"></small>
                <small id="MateriaExiste" class="invalid-feedback"></small>
            </div>
        </div>
        <div class="col-md-8 offset-md-2 text-right">
            <a href="<?php echo base_url()?>index.php/PerfilesControlador/VerMaterias" class="btn btn-primary">Volver</a>
            <button type="submit" class="btn btn-warning">Guardar</button>
        </div>
    </div>
</form>

<script type="text/javascript">
	$(function(){
        $('#errors').hide();
        const input = document.querySelector('input');
        const log = document.getElementById('materia');
        var mater;

        input.addEventListener('input', updateValue);

        function updateValue(e) {
            log.textContent = e.srcElement.value;
            mater = log.textContent;
        }

        /* PARA VALIDAR EL FORMULARIO */
        const formulario = $('#frm');
        const inputs = document.querySelectorAll('#frm input');

        const expresiones = {
            materia: /^[a-zA-ZÀ-ÿ_.,\s]{4,100}$/
        }

        const campos = {
            materia: false
        }

        const validarFormulario = (e) => {
            switch(e.target.name){
                case "materia":
                    if(expresiones.materia.test(e.target.value)){
                        $('#materia').css('border', '2px solid #1ed12d');
                        $('#MateriaAyuda').hide();
                        campos['materia'] = true;
            
                        var dato = {materia: mater};
                        
                        $.post('<?php echo base_url()?>index.php/MateriasControlador/BuscaMateria',dato,function(response) {
                            if(response == 'ok'){
                                $('#materia').css('border', '2px solid #bb2929');
                                $('#MateriaExiste').html("La materia: "+mater+" ya existe!");
                                $('#MateriaExiste').show();
                                campos['materia'] = false;
                            }else{
                                $('#materia').css('border', '2px solid #1ed12d');
                                $('#MateriaExiste').hide();
                            }
                        });

                    }else{
                        $('#materia').css('border', '2px solid #bb2929');
                        $('#MateriaAyuda').html('El campo es obligatorio y debe tener más de 4 caracteres');
                        $('#MateriaAyuda').show();
                        campos['materia'] = false;
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
            
            if(campos.materia){
                swal({
                    title: "Guardar",
                    text: "¿Está seguro que desea guardar la Materia?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    if (result) {
                        var materia     = $('#materia').val();
                        
                        var data = {materia: materia};
                        $.post('<?php echo base_url()?>index.php/MateriasControlador/insertar',data,function(response){
                            if(response == 'ok'){
                                window.location = '<?php echo base_url()?>index.php/PerfilesControlador/VerMaterias';
                            }else{
                                $('#errors').html("Hubo un error al guardar los datos");
                                $('#errors').show();
                            }
                        });
                    }
                });
            }

            
		});
	});
</script>