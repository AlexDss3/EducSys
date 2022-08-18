<div class="row centrar">
<?php foreach($ListaProfesores as $profesor){?>
    <?php if ($profesor->rol != $rol) {?>
        <div class="card tarjeta-profesor" style="width: 20rem; margin: 10px;">
            <div class="card-body">
                <h4 class="card-title">Nombre: <?php echo $profesor->nombre." ".$profesor->apellido; ?></h4>
                <br>
                <div class="row">
                    <div class="col">
                        <h6 class="card-subtitle mb-2 text-muted">Correo: </h6>
                    </div>
                    <div class="col">
                        <p class="card-text"><?php echo $profesor->correo; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h6 class="card-subtitle mb-2 text-muted">Telefono: </h6>
                    </div>
                    <div class="col">
                        <p class="card-text" id="h"><?php echo $profesor->telefono ? $profesor->telefono: "N/A"; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-left">
                        <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/ProfesoresControlador/VerPlanificaciones/<?php echo $profesor->idUsuario;?>" data-toggle="tooltip" data-placement="top" title="Planificaciones">
                            <i class="material-icons">list</i>
                        </a>
                        <a class="btn btn-success btn-icon btn-sm" href="<?php echo base_url()?>index.php/ProfesoresControlador/VerAsignaciones/<?php echo $profesor->idUsuario;?>" data-toggle="tooltip" data-placement="top" title="Asignaciones">
                            <i class="material-icons">checklist</i>
                        </a>
                    </div>
                    
                    <div class="col text-right">
                        <a class="btn btn-warning btn-icon btn-sm" href="<?php echo base_url()?>index.php/ProfesoresControlador/Editar/<?php echo $profesor->idUsuario; ?>" data-toggle="tooltip" data-placement="top" title="Editar">
                            <i class="material-icons">edit</i>
                        </a>
                        <button class="btn btn-danger btn-icon btn-sm" data-eliminar="<?php echo $profesor->idUsuario;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                            <i class="material-icons">delete</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>
<?php }?>
<p><?php if($profesor->idUsuario <= 1){ $this->load->view('mensajes/noelemento'); }?></p>
</div>

