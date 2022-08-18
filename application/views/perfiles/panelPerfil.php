<?php foreach($profesor as $p){ ?>
    <?php $p->idUsuario; ?>
<?php } ?>

<?php
    $director = "director";
    $profesor = "profesor";
    // CONVERTIMOS LA CADENA DEL ROL EN MINÚSCULAS
    $Nrol = strtolower($rol);
?>
<div class="row centrar" style="padding-top: 2em;">
<?php if ($Nrol == $director) {?>

    <div class="col">
        <div class="card tarjeta-materias">
            <div class="card-body">
                <h3 class="card-title h3">Materias</h3>
                <br>
                <p class="card-text">Lista de materias registradas en el sistema.</p>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/PerfilesControlador/VerMaterias " data-toggle="tooltip" data-placement="top" title="Ver Materias">
                    <i class="material-icons">book</i>
                </a>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card tarjeta-grados">
            <div class="card-body">
                <h3 class="card-title h3">Secciones</h3>
                <br>
                <p class="card-text">Lista de grados académicos registrados en el sistema.</p>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/PerfilesControlador/VerGrados" data-toggle="tooltip" data-placement="top" title="Ver Grados">
                    <i class="material-icons">sort</i>
                </a>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card tarjeta-materianivel">
            <div class="card-body">
                <h3 class="card-title h3">Asignaciones de Materias</h3>
                <br>
                <p class="card-text">Lista de grados académicos que tienen una materia asignada.</p>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/PerfilesControlador/VerMateriasNivel " data-toggle="tooltip" data-placement="top" title="Ver Materias por Grado">
                    <i class="material-icons">checklist</i>
                </a>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card tarjeta-profesor">
            <div class="card-body">
                <h3 class="card-title h3">Profesores</h3>
                <br>
                <p class="card-text">Lista de profesores registrados en el sistema.</p>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/PerfilesControlador/VerProfesores " data-toggle="tooltip" data-placement="top" title="Ver profesores">
                    <i class="material-icons">person</i>
                </a>
            </div>
        </div>
    </div>

<?php }else if($Nrol == $profesor){?>

    <div class="col">
        <div class="card tarjeta-asignaciones">
            <div class="card-body">
                <h3 class="card-title">Asignaciones</h3>
                <br>
                <p class="card-text">Mis asignaciones.</p>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/PerfilesControlador/VerMisAsignaciones/<?php echo $p->idUsuario;?>" data-toggle="tooltip" data-placement="top" title="Ver mis asignaciones">
                    <i class="material-icons">list</i>
                </a>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card tarjeta-planificaciones" >
            <div class="card-body">
                <h3 class="card-title">Planificaciones</h3>
                <br>
                <p class="card-text">Mis planificaciones realizadas.</p>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/PerfilesControlador/VerMisPlanificaciones/<?php echo $p->idUsuario;?>" data-toggle="tooltip" data-placement="top" title="Ver mis planificaciones">
                    <i class="material-icons">list</i>
                </a>
            </div>
        </div>
    </div>
    
<?php }?>
</div>