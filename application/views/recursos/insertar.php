<form class="form" action="<?php echo base_url()?>index.php/RecursosControlador/Insertar/<?php echo $idPlanDetalle;?>/<?php echo $idPlanDetalle;?>/<?php echo $NombreProfe;?>/<?php echo $Nmateria;?>/<?php echo $idProfesor;?>/<?php echo $idPlanificacion;?>/<?php echo $idAsignacion;?>/<?php echo $anio;?>" method="post" id="frm" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Agregar Recurso</h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <br>
            <div class="form-group">
                <label for="tipo">Tipo de recurso:</label>
                <select class="form-control" name="tipo" id="tipo">
                    <option>Seleccionar tipo de recurso...</option>
                    <option value="1">Enlace</option>
                    <option value="2">Archivo</option>
                </select>
            </div>

            <div class="form-group">
                <input class="form-control" type="hidden" name="idPlanDetalle" id="idPlanDetalle" value="<?php echo $idPlanDetalle;?>">
            </div>

            <br>
            <p class="h5">Recurso a utilizar:</p>
			<div class="form-group">
                <label id="titulo-enlace" for="enlace">Enlace:</label>
                <input type="text" class="form-control" id="enlace" name="recurso" placeholder="Enlace del sitio web..." required>
                <small id="EnlaceAyuda" class="invalid-feedback"></small>
            </div>

            <div class="form-group">
                <label id="titulo-archivo" for="archivo">Archivo:</label>
                <input type="file" class="form-control-file" id="archivo" name="recurso" required>
            </div>
            <div>
                <input type="hidden" name="nombreProfe" value="<?php echo $NombreProfe;?>">
                <input type="hidden" name="nombreMateria" value="<?php echo urldecode($Nmateria);?>">
                <input type="hidden" name="idProfe" value="<?php echo $idProfesor;?>">
                <input type="hidden" name="idPlan" value="<?php echo $idPlanificacion;?>">
                <input type="hidden" name="idAsig" value="<?php echo $idAsignacion;?>">
                <input type="hidden" name="anio" value="<?php echo $anio;?>">
            </div>
        </div>
        <div class="col-md-8 offset-md-2 text-right">
            <a href="<?php echo base_url()?>index.php/PlanDetallesControlador/VerRecursos/<?php echo $idPlanDetalle;?>/<?php echo $NombreProfe;?>/<?php echo $Nmateria;?>/<?php echo $idProfesor;?>/<?php echo $idPlanificacion;?>/<?php echo $idAsignacion;?>/<?php echo $anio;?>" class="btn btn-primary">Volver</a>
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
            recurso: /^.{5,255}$/
        }

        const campos = {
            recurso: false
        }

        const validarFormulario = (e) => {
            switch(e.target.name){
                case "recurso":
                    if(expresiones.recurso.test(e.target.value)){
                        $('#enlace').css('border', '2px solid #1ed12d');
                        $('#EnlaceAyuda').hide();
                        campos['recurso'] = true;
                    }else{
                        $('#enlace').css('border', '2px solid #bb2929');
                        $('#EnlaceAyuda').html('El campo es obligatorio');
                        $('#EnlaceAyuda').show();
                        campos['recurso'] = false;
                    }
                    break;
            }
        }

        inputs.forEach((input) => {
            input.addEventListener('blur', validarFormulario);
            input.addEventListener('keyup', validarFormulario);
        });

        // Inician los dos deshabilitados
        $("#enlace").prop('disabled', true);
        $("#archivo").prop('disabled', true);

        // Ocultamos el input del archivo a insertar dependiendo de lo escogido
        $("#tipo").click(function(){
            if($("#tipo").val() == 1){
                // Mostramos título y elemento; lo habilitamos
                $("#enlace").show();
                $("#titulo-enlace").show();
                $("#enlace").prop('disabled', false);

                // Deshabilitamos el segundo elemento y lo ocultamos
                $("#archivo").hide();
                $("#titulo-archivo").hide();
                $("#archivo").prop('disabled', true);
            }else if($("#tipo").val() == 2){
                // Mostramos título y elemento; lo habilitamos
                $("#archivo").show();
                $("#titulo-archivo").show();
                $("#archivo").prop('disabled', false);

                // Deshabilitamos el primer elemento y lo ocultamos
                $("#enlace").hide();
                $("#titulo-enlace").hide();
                $("#enlace").prop('disabled', true);
            }
        });
    });
</script>
