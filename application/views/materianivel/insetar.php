<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Agregar Asignación</h3>
            <br>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="materia">Materia a Asignar</label>
                    <select class="form-control" name="idMateria" id="materia" required>
                        <option value="0">Seleccionar Materia</option>
                        <?php foreach($materias->result() as $res){ ?>
                            <option value="<?php echo $res->id;?>"><?php echo $res->nombre;?></option>
                        <?php }?>
                    </select>
                    <small id="AsignacionObligatorio" class="invalid-feedback"></small>
                </div>
                <div class="form-group col">
                    <label for="grado">Grado</label>
                    <select class="form-control" name="nivel" id="nivel" required>
                        <option value="0">Seleccionar Nivel</option>
                        <?php foreach($grados->result() as $res){ ?>
                            <option value="<?php echo $res->nivel;?>"><?php echo $res->nivel."°";?></option>
                        <?php }?>
                    </select>
                    <small id="AsignacionObligatorio" class="invalid-feedback"></small>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <small id="AsignacionExiste" class="invalid-feedback"></small>
                </div>
            </div>
        </div>
        <div class="col-md-8 offset-md-2 text-right">
            <a href="<?php echo base_url()?>index.php/PerfilesControlador/VerMateriasNivel" class="btn btn-primary">Volver</a>
            <button type="submit" class="btn btn-warning">Guardar</button>
        </div>
    </div>
</form>

<script type="text/javascript">
	$(function(){

        const campos = {
            asignado: false
        }

		$('#frm').submit(function(e){
			e.preventDefault();
            $('#errors').hide();

            // DATOS PARA COMPROBAR EXISTENCIA
            const niv = $('#nivel').val();
            const mat = $('#materia').val();

            var dato = {nivel: niv, idMateria: mat};

            
            
            $.post('<?php echo base_url()?>index.php/MNControlador/BuscaMateriaAsignada',dato,function(response) {
                if (niv == 0 && mat == 0) {
                    $('#materia').css('border', '2px solid #bb2929');
                    $('#nivel').css('border', '2px solid #bb2929');
                    $('#AsignacionObligatorio').html('Campos obligatorios!');
                    $('#AsignacionObligatorio').show();
                    campos['asignado'] = false;
                }else if (niv > 0 && mat > 0){
                    $('#materia').css('border', '2px solid #1ed12d');
                    $('#nivel').css('border', '2px solid #1ed12d');
                    $('#AsignacionObligatorio').hide();
                    
                    if(response == 'ok'){
                        $('#materia').css('border', '2px solid #bb2929');
                        $('#nivel').css('border', '2px solid #bb2929');
                        $('#AsignacionExiste').html('La Asignación ya existe!');
                        $('#AsignacionExiste').show();
                    }else{
                        $('#materia').css('border', '2px solid #1ed12d');
                        $('#nivel').css('border', '2px solid #1ed12d');
                        $('#AsignacionExiste').hide();
                        campos['asignado'] = true;
                    }
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
                        var materia             = $('#materia').val();
                        var nivel               = $('#nivel').val();
                        
                        var data = {nivel: nivel, idMateria: materia};
                        console.log(data);
                        $.post('<?php echo base_url()?>index.php/MNControlador/insertar',data,function(response){
                            if(response == 'ok'){
                                window.location = '<?php echo base_url()?>index.php/PerfilesControlador/VerMateriasNivel';
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