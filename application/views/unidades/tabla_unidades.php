<div class="row centrar">
<?php foreach($ListaUnidades->result() as $unidades){?>
    <div class="card tarjeta-materianivel" style="width: 23rem; margin: 5px;">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h3 class="card-title"><b>Unidad <?php echo $unidades->unidad; ?></b></h3>
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                    <h5><?php echo $unidades->nombreUnidad; ?></h5>
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                    <h6>Sección a cargo: <?php echo $unidades->seccion; ?></h6>
                    <h6>Profesor guía: <?php echo $unidades->nombre." ".$unidades->apellido; ?></h6>
                </div>
            </div>

            <br>

            <div class="row">
                <?php if($rol == "Profesor"){ ?>
                <div class="col">
                    <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/UnidadesControlador/VerContenidos/<?php echo $unidades->idUnidad;?>/<?php echo $idMateriaNivel;?>/<?php echo $idProfesor;?>" data-toggle="tooltip" data-placement="top" title="Contenidos">
                        <i class="material-icons">list</i>
                    </a>
                </div>
                <div class="col">
                    <a class="btn btn-warning btn-icon btn-sm" href="<?php echo base_url()?>index.php/UnidadesControlador/editar/<?php echo $unidades->idUnidad;?>/<?php echo $idMateriaNivel; ?>/<?php echo $idProfesor; ?>" data-toggle="tooltip" data-placement="top" title="Editar">
                        <i class="material-icons">edit</i>
                    </a>
                    <button class="btn btn-danger btn-icon btn-sm" data-idasig="<?php echo $idMateriaNivel; ?>" data-eliminar="<?php echo $unidades->idUnidad;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                        <i class="material-icons">delete</i>
                    </button>
                </div>
                <?php }else if($rol == "Director"){ ?>
                <div class="col">
                    <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/UnidadesControlador/VerContenidos/<?php echo $unidades->idUnidad;?>/<?php echo $idMateriaNivel;?>/<?php echo $unidades->idUsuario;?>" data-toggle="tooltip" data-placement="top" title="Contenidos">
                        <i class="material-icons">list</i>
                    </a>
                </div>
                    <div class="col"></div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php }?>
</div>

<div class="row">
<p><?php if($ListaUnidades->result() == null){ $this->load->view('mensajes/noelemento'); }?></p>
</div>
