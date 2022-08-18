<?php
    $director = "director";
    $profesor = "profesor";
    // CONVERTIMOS LA CADENA DEL ROL EN MINÚSCULAS
    $Nrol = strtolower($rol);
?>

<?php if($Nrol == $director){ ?>
    <div class="row">
        <nav>
            <ol class="breadcrumb" style="background-color: rgba(255,255,255,0.0);">
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/PerfilesControlador/VerProfesores">Profesores</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profesor <?php echo $NombreProfesor[0]->nombre." ".$NombreProfesor[0]->apellido;?></li>
            </ol>
        </nav>
    </div>
<?php }else if($Nrol == $profesor){ ?>
    <div class="row">
        <nav>
            <ol class="breadcrumb" style="background-color: rgba(255,255,255,0.0);">
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Planificaciones</li>
            </ol>
        </nav>
    </div>
<?php } ?>

<div class="row">
    <div class="col">
        <h2>Planificaciones del Profesor <?php echo $NombreProfesor[0]->nombre." ".$NombreProfesor[0]->apellido;?></h2>
    </div>
</div>

<br>

<div class="row">
    <div class="col">
        <div class="form-inline">
            <input type="hidden" id="profesor" value="<?php echo $idProfesor;?>">

            <select class="form-control" id="materia">
                <option value="0">Materia...</option>
                <?php foreach($Materias as $materias){?>
                    <option value="<?php echo $materias->idMateria;?>"><?php echo $materias->materia;?></option>
                <?php }?>
            </select>

            <select class="form-control" id="seccion">
                <option value="s">Sección...</option>
                <?php foreach($Secciones as $secciones){?>
                    <option value="<?php echo $secciones->seccion;?>"><?php echo $secciones->seccion;?></option>
                <?php }?>
            </select>

            <span class="form-group-btn">
                <button id="btn_busqueda" class="btn btn-default btn-fill" type="button" >
                    buscar
                </button>
            </span>

        </div>
    </div>
    <?php if ($Nrol == $director) {?>
        <a href="<?php echo base_url()?>index.php/PerfilesControlador/VerProfesores" class="btn btn-primary">Volver</a>
        <div></div>
    <?php }else if($Nrol == $profesor){?>
        <div class="col-sm-12 col-md-4 text-right">
            <a href="<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario" class="btn btn-primary">Volver</a>
            <a href="<?php echo base_url()?>index.php/PlanificacionesControlador/Insertar/<?php echo $idProfesor;?>" class="btn btn-warning">Agregar</a>
        </div>
    <?php }?>
</div>
<br>
<div class="row">
    <div class="col-12" id="divTabla">
        <?php $this->load->view('planificaciones/panelPlanificaciones'); ?>
    </div>
</div>

<script>
    $(function(){
        $(document).on("click", "button[data-eliminar]", function (evt) {
            var id = $(this).data("eliminar");
            
            swal({
                title: "Eliminar",
                text: "¿Está seguro que desea eliminar la Planificación?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {                    
                    var data = {id: id};
                    $.post('<?php echo base_url()?>index.php/PlanificacionesControlador/Eliminar',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/ProfesoresControlador/VerPlanificaciones/<?php echo $idProfesor;?>';
                        }
                    });
                }
            });
        });

        $(document).on("click", "button[data-duplicar]", function (evt) {
            var id = $(this).data("duplicar");
            
            swal({
                title: "Duplicar",
                text: "¿Está seguro que desea duplicar la Planificación?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {                    
                    var data = {id: id};
                    $.post('<?php echo base_url()?>index.php/PlanificacionesControlador/Duplicar',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/ProfesoresControlador/VerPlanificaciones/<?php echo $idProfesor;?>';
                        }
                    });
                }
            });
        });

        $('#btn_busqueda').click(function(){
            buscar();
        });

        function buscar(){
            var profesor = $('#profesor').val();
            var materia = $('#materia').val();
            var seccion = $('#seccion').val();

            $.post('<?php echo base_url()?>index.php/PlanificacionesControlador/Buscar/<?php echo $idProfesor;?>',{profesor:profesor, materia:materia, seccion:seccion}, function(response){
                $('#divTabla').html(response);
            });
        }
    });
</script>