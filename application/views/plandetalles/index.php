<?php
    $director = "director";
    $profesor = "profesor";
    // CONVERTIMOS LA CADENA DEL ROL EN MINÚSCULAS
    $Nrol = strtolower($rol);

    // REEMPLAZAMOS LOS CARACTERES ESPECIALES QUE SE AGREGARON EN LA URl Y DE ESTA MANERA PASAR EL VAROL EXACTO
    $Nmateria = urldecode($materia);
?>

<?php if($Nrol == $director){ ?>
    <div class="row">
        <nav>
            <ol class="breadcrumb" style="background-color: rgba(255,255,255,0.0);">
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/PerfilesControlador/VerProfesores">Profesores</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/ProfesoresControlador/VerPlanificaciones/<?php echo $idProfesor;?>">Profesor <?php echo $NombreProfesor[0]->nombre." ".$NombreProfesor[0]->apellido;?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $Nmateria;?></li>
            </ol>
        </nav>
    </div>
<?php }else if($Nrol == $profesor){ ?>
    <div class="row">
        <nav>
            <ol class="breadcrumb" style="background-color: rgba(255,255,255,0.0);">
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/ProfesoresControlador/VerPlanificaciones/<?php echo $idProfesor;?>">Planificaciones</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $Nmateria;?></li>
            </ol>
        </nav>
    </div>
<?php } ?>

<div class="row">
    <div class="col-sm-12">
        <h3>Planificaciones para <?php echo $Nmateria;?></h3>
        <br>
    </div>
    <div class="col-xs-10 col-md-8">
        <div class="input-group">
        <input type="hidden" id="idPlanificacion" value="<?php echo $idPlanificacion;?>">
        <input type="hidden" id="idAsignacion" value="<?php echo $idAsignacion;?>">
        <input type="hidden" id="anio" value="<?php echo $anio;?>">
            <div class="form-group">
                <select id="tema" class="form-control">
                    <option value="">Tema...</option>
                    <?php foreach($ListaPlanDetalles as $plandetalle){?>
                        <option value="<?php echo $plandetalle->tema;?>"><?php echo $plandetalle->tema;?></option>
                    <?php }?>
                </select>
            </div>
            <span class="input-group-btn">
                <button id="btn_busqueda" class="btn btn-default btn-fill" type="button" >
                    Buscar
                </button>
            </span>
        </div>
    </div>
    <?php if ($Nrol == $director) {?>
        <div class="col-sm-12 col-md-4 text-right">
            <a href="<?php echo base_url()?>index.php/ProfesoresControlador/VerPlanificaciones/<?php echo $idProfesor;?>" class="btn btn-primary">Volver</a>
        </div>
    <?php }else if($Nrol == $profesor){?>
        <div class="col-sm-12 col-md-4 text-right">
            <a href="<?php echo base_url()?>index.php/ProfesoresControlador/VerPlanificaciones/<?php echo $idProfesor;?>" class="btn btn-primary">Volver</a>
            <a target="_blank" href="<?php echo base_url()?>index.php/PlanDetallesControlador/Exportar/<?php echo $idProfesor;?>/ <?php echo $Nmateria;?>/<?php echo $idPlanificacion;?>/<?php echo $idAsignacion;?>/<?php echo $anio;?>" class="btn btn-dark">Exportar a PDF</a>
            <a href="<?php echo base_url()?>index.php/PlanDetallesControlador/Insertar/<?php echo $idProfesor;?>/<?php echo $idPlanificacion;?>/<?php echo $idAsignacion;?>/<?php echo $anio;?>/<?php echo $Nmateria;?>" class="btn btn-warning">Agregar</a>
        </div>
    <?php }?>
</div>
<br>
<div class="row">
    <div class="col-12" id="divTabla">
        <?php $this->load->view('plandetalles/panelPlandetalles'); ?>
    </div>
</div>

<script>
    $(function(){
        $(document).on("click", "button[data-eliminar]", function (evt) {
            var id = $(this).data("eliminar");
            
            swal({
                title: "Eliminar",
                text: "¿Está seguro que desea eliminar el registro de la planificación?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {                    
                    var data = {id: id};
                    $.post('<?php echo base_url()?>index.php/PlanDetallesControlador/Eliminar',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/PlanificacionesControlador/VerDetalles/<?php echo $idProfesor;?>/<?php echo $idPlanificacion;?>/<?php echo $idAsignacion;?>/<?php echo $anio;?>/<?php echo $materia;?>';
                        }
                    });
                }
            });
        });

        $('#btn_busqueda').click(function(){
            buscar();
        });

        function buscar(){
            var idPlanificacion     = $('#idPlanificacion').val();
            var idAsignacion        = $('#idAsignacion').val();
            var anio                = $('#anio').val();
            var tema                = $('#tema').val();
            
            $.post('<?php echo base_url()?>index.php/PlanDetallesControlador/Buscar',{idPlanificacion:idPlanificacion, idAsignacion:idAsignacion, anio:anio, tema:tema, fecha:fecha}, function(response){
                $('#divTabla').html(response);
            });
        }
    });
</script>