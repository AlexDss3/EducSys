<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Agregar Asignación</h3>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <div class="form-group col">
                <input type="hidden" class="form-control" name="idUsuario" id="idUsuario" value="<?php echo $idProfesor;?>">
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="materia">Materia a Asignar</label>
                    <select class="form-control" name="idMateriaNivel" id="idMateriaNivel">
                        <option value="0">Seleccionar Materia</option>
                        <?php foreach($materias as $mat){ ?>
                            <option value="<?php echo $mat->idMateriaNivel;?>"><?php echo $mat->materia." - Grado: ".$mat->nivel."°";?></option>
                        <?php }?>
                    </select>
                    <small id="AsignacionObligatorio" class="invalid-feedback"></small>
                </div>
                <div class="form-group col">
                    <label for="materia">Sección a Asignar</label>
                    <select class="form-control" name="idGrado" id="idGrado">
                        <option value="0">Seleccionar Sección</option>
                        <?php foreach($secciones as $res){ ?>
                            <option value="<?php echo $res->idGrado;?>"><?php echo $res->seccion;?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <small id="AsignacionExiste" class="invalid-feedback"></small>
                </div>
            </div>
        </div>
        <div class="col-md-8 offset-md-2 text-right">
            <a href="<?php echo base_url()?>index.php/ProfesoresControlador/VerAsignaciones/<?php echo $idProfesor;?>" class="btn btn-primary">Volver</a>
            <button type="submit" class="btn btn-warning">Guardar</button>
        </div>
    </div>
</form>

<script type="text/javascript">
	$(function(){
        const campos = {
            asignado: true
        }
        
        $('#frm').submit(function(e){
            e.preventDefault();
            $('#errors').hide();

            // DATOS PARA COMPROBAR EXISTENCIA
            const idusu = $('#idUsuario').val();
            const idmn = $('#idMateriaNivel').val();
            const idgrad = $('#idGrado').val();

            if (idmn == 0 || idgrad == 0) {
                $('#idMateriaNivel').css('border', '2px solid #bb2929');
                $('#idGrado').css('border', '2px solid #bb2929');
                $('#AsignacionObligatorio').html('Campos obligatorios!');
                $('#AsignacionObligatorio').show();
                campos['asignado'] = false;
            }else if (idmn > 0 || idgrad > 0){
                $('#idMateriaNivel').css('border', '2px solid #1ed12d');
                $('#idGrado').css('border', '2px solid #1ed12d');
                $('#AsignacionObligatorio').hide();
            }

            var dato = {idMateriaNivel: idmn, idGrado: idgrad};

            $.post('<?php echo base_url()?>index.php/AsignacionesControlador/BuscaAsignacionIgual',dato,function(response) {
                if(response == 'ok'){
                    $('#idMateriaNivel').css('border', '2px solid #1ed12d');
                    $('#idGrado').css('border', '2px solid #1ed12d');
                    $('#AsignacionExiste').hide();
                    campos['asignado'] = true;
                    
                    var dato = {idUsuario: idusu, idMateriaNivel: idmn, idGrado: idgrad};
            
                    $.post('<?php echo base_url()?>index.php/AsignacionesControlador/BuscaAsignacion',dato,function(response) {
                        if(response == 'ok'){
                            $('#idMateriaNivel').css('border', '2px solid #bb2929');
                            $('#idGrado').css('border', '2px solid #bb2929');
                            $('#AsignacionExiste').html('La Asignación ya existe!');
                            $('#AsignacionExiste').show();
                            campos['asignado'] = false;
                        }else{
                            $('#idMateriaNivel').css('border', '2px solid #1ed12d');
                            $('#idGrado').css('border', '2px solid #1ed12d');
                            $('#AsignacionExiste').hide();
                            campos['asignado'] = true;
                        }
                    });
                }else{
                    $('#idMateriaNivel').css('border', '2px solid #bb2929');
                    $('#idGrado').css('border', '2px solid #bb2929');
                    $('#AsignacionExiste').html('Los grados son diferentes, debe escoger grados iguales');
                    $('#AsignacionExiste').show();
                }
            });
            
            if (campos.asignado) {
                swal({
                    title: "Guardar",
                    text: "¿Está seguro que desea guardar la Asignación?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    if (result) {
                        var idUsuario            = $('#idUsuario').val();
                        var idMateriaNivel       = $('#idMateriaNivel').val();
                        var idGrado              = $('#idGrado').val();
                        
                        var data = {idUsuario: idUsuario, idMateriaNivel: idMateriaNivel, idGrado: idGrado};
                        
                        $.post('<?php echo base_url()?>index.php/AsignacionesControlador/insertar/<?php echo $idProfesor;?>',data,function(response){
                            if(response == 'ok'){
                                window.location = '<?php echo base_url()?>index.php/ProfesoresControlador/VerAsignaciones/<?php echo $idProfesor;?>';
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