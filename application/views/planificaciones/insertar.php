<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Agregar Nueva Planificación</h3>
            <br>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="usuario">Seleccionar Asignación:</label>
                    <select class="form-control" name="idAsignacion" id="asignacion" required>
                        <option value="">Asignación...</option>
                        <?php foreach($asignados as $asig){ ?>
                            <option value="<?php echo $asig->idAsignacion;?>"><?php echo $asig->materia." - Grado: ".$asig->nivel."° - "; if($asig->tipo == "B"){ echo " [Básica]";}else if($asig->tipo == "M"){ echo " [Bachillerato]";} echo " ".$asig->seccion;?></option>
                        <?php }?>
                    </select>
                    <small id="AsignadoExiste" class="invalid-feedback"></small>
                </div>
                <div class="form-group col">
                    <label for="materia">Año en que se realizará:</label>
                    <input type="text" class="form-control" id="anio" name="anio" placeholder="año">
                    <small id="AnioAyuda" class="invalid-feedback"></small>
                </div>
            </div>
        </div>
        <div class="col-md-8 offset-md-2 text-right">
            <a href="<?php echo base_url()?>index.php/ProfesoresControlador/VerPlanificaciones/<?php echo $idProfesor;?>" class="btn btn-primary">Volver</a>
            <button type="submit" class="btn btn-warning">Guardar</button>
        </div>
    </div>
</form>

<script type="text/javascript">
	$(function(){

        /* PARA VALIDAR EL FORMULARIO */
        const formulario = $('#frm');
        const inputs = document.querySelectorAll('#frm input');

        const expresiones = {
            anio: /^\d{4}$/
        }

        const campos = {
            anio: false,
            asignacion: false
        }

        const validarFormulario = (e) => {
            switch(e.target.name){
                case "anio":
                    if(expresiones.anio.test(e.target.value)){
                        $('#anio').css('border', '2px solid #1ed12d');
                        $('#AnioAyuda').hide();
                        campos['anio'] = true;

                        var asig    = $("#asignacion").val();
                        var anio    = $("#anio").val();

                        var dato = {idAsignacion: asig, anio: anio};

                        $.post('<?php echo base_url()?>index.php/PlanificacionesControlador/BuscaAsignacion',dato,function(response) {
                            if(response == 'ok'){
                                $('#asignacion').css('border', '2px solid #bb2929');
                                $('#anio').css('border', '2px solid #bb2929');
                                $('#AsignadoExiste').html('La asignación: ya existe!');
                                $('#AsignadoExiste').show();
                                campos['asignacion'] = false;
                            }else{
                                $('#asignacion').css('border', '2px solid #1ed12d');
                                $('#AsignadoExiste').hide();
                                campos['asignacion'] = true;
                            }
                        });

                    }else{
                        $('#anio').css('border', '2px solid #bb2929');
                        $('#AnioAyuda').html('El campo es obligatorio y solo acepta números');
                        $('#AnioAyuda').show();
                        campos['anio'] = false;
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

            if (campos.anio && campos.asignacion) {
                
                swal({
                    title: "Guardar",
                    text: "¿Está seguro que desea guardar el Grado?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    if (result) {
                        var asignacion         = $('#asignacion').val();
                        var anio               = $('#anio').val();
                        
                        var data = {idAsignacion: asignacion, anio: anio};
                        
                        $.post('<?php echo base_url()?>index.php/PlanificacionesControlador/Insertar',data,function(response){
                            if(response == 'ok'){
                                window.location = '<?php echo base_url()?>index.php/ProfesoresControlador/VerPlanificaciones/<?php echo $idProfesor;?>';
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