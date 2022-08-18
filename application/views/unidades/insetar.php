<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Asignar Unidades a <?php echo urldecode($NombreMateria);?></h3>
            <br>
            <div id="errors" class="alert alert-danger" role="alert" style="display:none;"></div>
            <input type="hidden" value="<?php echo $idProfesor;?>" id="$idProfesor">
            <input type="hidden" value="<?php echo $idAsignacion ?>" id="idMateriaNivel" name="idMateriaNivel">
			<div class="form-row">
                <div class="form-group col">
                    <label for="unidad">Unidad #</label>
                    <input type="text" class="form-control" id="unidad" name="unidad" placeholder="Numero de la Unidad">
                </div>
                <div class="form-group col">
                    <label for="nomUni">Nombre de la Unidad</label>
                    <input type="text" class="form-control" id="nomUni" name="nomUni" placeholder="Nombre de la Unidad">
                </div>
            </div>
        </div>
        <div class="col-md-8 offset-md-2 text-right">
            <a href="<?php echo base_url()?>index.php/AsignacionesControlador/VerUnidades/<?php echo $idAsignacion ?>/<?php echo $idProfesor;?>" class="btn btn-primary">Volver</a>
            <button type="submit" class="btn btn-warning">Guardar</button>
        </div>
    </div>  
</form>

<script type="text/javascript">
	$(function(){
		$('#frm').submit(function(e){
			e.preventDefault();
            $('#errors').hide();
            
            swal({
                title: "Guardar",
                text: "¿Está seguro que desea guardar la unidad?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    var unidad               = $('#unidad').val();
                    var nomUni              =$('#nomUni').val();
                    var idMateriaNivel              =$('#idMateriaNivel').val();
                    
                    var data = {idMateriaNivel: idMateriaNivel, unidad: unidad, nombreUnidad: nomUni};
                    console.log(data);
                    $.post('<?php echo base_url()?>index.php/UnidadesControlador/insertar/<?php echo $idAsignacion ?>/<?php echo $idProfesor;?>/<?php echo $NombreMateria;?>',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/AsignacionesControlador/VerUnidades/<?php echo $idAsignacion ?>/<?php echo $idProfesor;?>';
                        }else{
                            $('#errors').html(response);
                            $('#errors').show();
                        }
                    });
                }
            });

            
		});
	});
</script>