<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Editar Datos Generales del contenido</h3>
            <input type="hidden" value="<?php echo $idUnidad ?>" id="idUnidad" name="idUnidad">
            <div class="form-group">
                <label for="correlativo">Correlativo:</label>
                <input type="text" class="form-control" value="<?php echo $contenido->correlativo; ?>" id="correlativo" name="correlativo" placeholder="Número del tema">
            </div>
 			<div class="form-group">
                <label for="tema">Nombre del tema:</label>
                <input type="text" class="form-control" value="<?php echo $contenido->tema; ?>" id="tema" name="tema" placeholder="Nombre del tema">
            </div>
            </div>
			
            <div class="col-md-8 offset-md-2 text-right">
                <a href="<?php echo base_url()?>index.php/UnidadesControlador/VerContenidos/<?php echo $idUnidad; ?>/<?php echo $idMateriaNivel;?>/<?php echo $idProfesor;?>" class="btn btn-primary">volver</a>
                <button type="submit" class="btn btn-warning">Guardar</button>
            </div>
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
                text: "¿Está seguro que desea editar el tema?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
    				var unidad               = $('#idUnidad').val();
                    var correlativo               = $('#correlativo').val();
                    var tema              =$('#tema').val();
                    
                    var data = {idUnidad: unidad, correlativo: correlativo, tema:tema};
                    $.post('<?php echo base_url()?>index.php/ContenidosControlador/editar/<?php echo $id;?>/<?php echo $idUnidad; ?>/<?php echo $idMateriaNivel;?>/<?php echo $idProfesor;?>',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/UnidadesControlador/VerContenidos/<?php echo $idUnidad; ?>/<?php echo $idMateriaNivel;?>/<?php echo $idProfesor;?>';
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