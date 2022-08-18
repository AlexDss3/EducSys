<form class="form" method="post" id="frm">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Agregar Temas</h3>
            <input type="hidden" value="<?php echo $idUnidad ?>" id="idUnidad" name="idUnidad">
			<div class="form-row">
                <div class="form-group col">
                <label for="correlativo">Correlativo</label>
                    <input type="text" class="form-control" id="correlativo" name="correlativo" placeholder="1.1">
                </div>
                <div class="form-group col">
                    <label for="tema">Nombre del tema</label>
                    <input type="text" class="form-control" id="tema" name="tema" placeholder="Nombre del tema">
                </div>
            </div>
        </div>
        <div class="col-md-8 offset-md-2 text-right">
            <a href="<?php echo base_url()?>index.php/UnidadesControlador/VerContenidos/<?php echo $idUnidad; ?>/<?php echo $idMateriaNivel;?>/<?php echo $idProfesor;?>" class="btn btn-primary">volver</a>
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
                text: "¿Está seguro que desea guardar el tema?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
    				var idUnidad         = $('#idUnidad').val();
                    var correlativo      = $('#correlativo').val();
                    var tema             =$('#tema').val();
                    
                    var data = {idUnidad: idUnidad, correlativo: correlativo, tema:tema};
                    console.log(data);
                    $.post('<?php echo base_url()?>index.php/ContenidosControlador/insertar/<?php echo $idUnidad; ?>/<?php echo $idMateriaNivel;?>/<?php echo $idProfesor;?>',data,function(response){
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