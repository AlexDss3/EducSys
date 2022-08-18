<br>
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
                <li class="breadcrumb-item active" aria-current="page">Asignaciones del Profesor <?php echo $NombreProfesor[0]->nombre." ".$NombreProfesor[0]->apellido;?></li>
            </ol>
        </nav>
    </div>
<?php }else if($Nrol == $profesor){ ?>
    <div class="row">
        <nav>
            <ol class="breadcrumb" style="background-color: rgba(255,255,255,0.0);">
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mis Asignaciones</li>
            </ol>
        </nav>
    </div>
<?php } ?>

<div class="row">
    <div class="col">
        <h2 class="text-center">Asignaciones</h2>
    </div>
</div>
<br>
<div class="row">
    <div class="col"></div>
    <?php if ($Nrol == $director) {?>
        <div class="col-sm-12 col-md-4 text-right">
            <a href="<?php echo base_url()?>index.php/PerfilesControlador/VerProfesores" class="btn btn-primary">Volver</a>
            <a href="<?php echo base_url()?>index.php/AsignacionesControlador/insertar/<?php echo $idProfesor;?>" class="btn btn-warning">Agregar</a>
        </div>
    <?php }else if($Nrol == $profesor){?>
        <div class="col-sm-12 col-md-4 text-right">
            <a href="<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario" class="btn btn-primary">Volver</a>
        </div>
    <?php }?>
</div>
<br>
<div class="row">
    <div class="col-12" id="divTabla">
        <?php $this->load->view('asignaciones/tabla_asignaciones'); ?>
    </div>
</div>

<script>
    $(function(){
        $(document).on("click", "button[data-eliminar]", function (evt) {
            var id = $(this).data("eliminar");
            
            swal({
                title: "Eliminar",
                text: "¿Está seguro que desea eliminar el Profesor?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {                    
                    var data = {id: id};
                    $.post('<?php echo base_url()?>index.php/AsignacionesControlador/eliminar',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/ProfesoresControlador/VerAsignaciones/<?php echo $idProfesor;?>';
                        }
                    });
                }
            });
        });
    });
</script>