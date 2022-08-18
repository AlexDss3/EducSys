<?php
    $director = "director";
    $profesor = "profesor";
    // CONVERTIMOS LA CADENA DEL ROL EN MINÚSCULAS
    $Nrol = strtolower($rol);
?>

<div class="row">
<?php foreach($ListaAsignaciones as $asignacion){?>
    <div class="card tarjeta-asignaciones" style="width: 23rem; margin: 5px;">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h3 class="card-title"><b>Materia: <?php echo $asignacion->materia; ?></b></h3>
                    <br>
                    <h5>Sección: <?php echo $asignacion->seccion; ?></h5>
                </div>
                <p></p>
            </div>
            
            <div class="row">
                <?php if ($Nrol == $director) {?>
                <div class="col">
                    <a class="btn btn-warning btn-icon btn-sm" href="<?php echo base_url()?>index.php/AsignacionesControlador/editar/<?php echo $asignacion->idAsignacion;?>" data-toggle="tooltip" data-placement="top" title="Editar">
                        <i class="material-icons">edit</i>
                    </a>
                    <button class="btn btn-danger btn-icon btn-sm" data-eliminar="<?php echo $asignacion->idAsignacion;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                        <i class="material-icons">delete</i>
                    </button>
                </div>
                <?php }else if($Nrol == $profesor){?>
                    <div class="col">
                        <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/AsignacionesControlador/VerUnidades/<?php echo $asignacion->idMateriaNivel;?>/<?php echo $idProfesor;?>" data-toggle="tooltip" data-placement="top" title="Ver unidades">
                            <i class="material-icons">list</i>
                        </a>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
<?php }?>
<p><?php if($ListaAsignaciones == null){ $this->load->view('mensajes/noelemento'); }?></p>
</div>