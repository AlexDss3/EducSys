<br>
<?php
    $director = "director";
    $profesor = "profesor";
    // CONVERTIMOS LA CADENA DEL ROL EN MINÚSCULAS
    $Nrol = strtolower($rol);

    // REEMPLAZAMOS LOS CARACTERES ESPECIALES QUE SE AGREGARON EN LA URl Y DE ESTA MANERA PASAR EL VAROL EXACTO
    $materia = urldecode($Nmateria);
?>

<?php if($Nrol == $director){ ?>
    <div class="row">
        <nav>
            <ol class="breadcrumb" style="background-color: rgba(255,255,255,0.0);">
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/PerfilesControlador/VerProfesores">Profesores</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/ProfesoresControlador/VerPlanificaciones/<?php echo $idProfesor;?>">Profesor <?php echo urldecode($NombreProfe);?></a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/PlanificacionesControlador/VerDetalles/<?php echo $idProfesor;?>/<?php echo $idPlanificacion;?>/<?php echo $idAsignacion;?>/<?php echo $anio; ?>/<?php echo $materia;?>"><?php echo $materia;?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Recursos</li>
            </ol>
        </nav>
    </div>
<?php }else if($Nrol == $profesor){ ?>
    <div class="row">
        <nav>
            <ol class="breadcrumb" style="background-color: rgba(255,255,255,0.0);">
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/ProfesoresControlador/VerPlanificaciones/<?php echo $idProfesor;?>">Planificaciones</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/PlanificacionesControlador/VerDetalles/<?php echo $idProfesor;?>/<?php echo $idPlanificacion;?>/<?php echo $idAsignacion;?>/<?php echo $anio; ?>/<?php echo $materia;?>"><?php echo $materia;?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Recursos</li>
            </ol>
        </nav>
    </div>
<?php } ?>

<div class="row">
    <div class="col-sm-12">
        <h3>Recursos</h3>
    </div>
    <div class="col"></div>
    <?php if ($Nrol == $director) {?>
        <div class="col-sm-12 col-md-4 text-right">
            <a href="<?php echo base_url()?>index.php/PlanificacionesControlador/VerDetalles/<?php echo $idProfesor;?>/<?php echo $idPlanificacion;?>/<?php echo $idAsignacion;?>/<?php echo $anio; ?>/<?php echo $materia;?>" class="btn btn-primary">Volver</a>
        </div>
    <?php }else if($Nrol == $profesor){?>
        <div class="col-sm-12 col-md-4 text-right">
            <a href="<?php echo base_url()?>index.php/PlanificacionesControlador/VerDetalles/<?php echo $idProfesor;?>/<?php echo $idPlanificacion;?>/<?php echo $idAsignacion;?>/<?php echo $anio; ?>/<?php echo $materia;?>" class="btn btn-primary">Volver</a>
            <a href="<?php echo base_url()?>index.php/RecursosControlador/Insertar/<?php echo $idPlanDetalle;?>/<?php echo $NombreProfe;?>/<?php echo $Nmateria;?>/<?php echo $idProfesor;?>/<?php echo $idPlanificacion;?>/<?php echo $idAsignacion;?>/<?php echo $anio;?>" class="btn btn-warning">Agregar</a>
        </div>
    <?php }?>
</div>
<br>
<div class="row">
    <div class="container-fluid" id="divTabla">
        <?php $this->load->view('recursos/panelRecursos'); ?>
    </div>
</div>

<div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;">
  <div id="notificar" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
    <div class="toast-header alert-success" style="color: white;">
      <img src="" class="rounded mr-2" alt="">
      <strong class="mr-auto">EduSys</strong>
      <small>hace 0.3 segundos</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      Se eliminó correctamente.
    </div>
  </div>
</div>

<script>
    $(function(){
        $(document).on("click", "button[data-eliminar]", function (evt) {
            var id = $(this).data("eliminar");
            var URl = $(this).data("quitar");
            $('.toast').toast();
            
            swal({
                title: "Eliminar",
                text: "¿Está seguro que desea eliminar el recurso?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {                    
                    var data = {id: id, URl: URl};
                    $.post('<?php echo base_url()?>index.php/RecursosControlador/eliminar',data,function(response){
                        if(response == 'ok'){
                            $('#notificar').toast('show');
                            window.location = '<?php echo base_url()?>index.php/PlanDetallesControlador/VerRecursos/<?php echo $idPlanDetalle;?>/<?php echo $NombreProfe;?>/<?php echo $Nmateria;?>/<?php echo $idProfesor;?>/<?php echo $idPlanificacion;?>/<?php echo $idAsignacion;?>/<?php echo $anio;?>';
                        }else{
                            $('#notificar').html('salió mal');
                            $('#notificar').toast('show');
                        }
                    });
                }
            });
        });

        $('#btn_busqueda').click(function(){
            buscar();
        });

        $('#txt_busqueda').keyup(function(e){
            if(e.key == 'Enter'){
                buscar();
            }
        });

        function buscar(){
            var criterio = $('#txt_busqueda').val() == "" ? 'all': $('#txt_busqueda').val();
            $.post('<?php echo base_url()?>index.php/PlanDetallesControlador/buscar',{criterio:criterio}, function(response){
                $('#divTabla').html(response);
            });
        }
    });
</script>