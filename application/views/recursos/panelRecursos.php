<div class="row centrar">
<?php
    $director = "director";
    $profesor = "profesor";
    // CONVERTIMOS LA CADENA DEL ROL EN MINÚSCULAS
    $Nrol = strtolower($rol);

?>

<?php foreach($ListaRecursos->result() as $recurso){?>
    <?php 
        /* SABER SI ES URL */
        $url = "http";
        $buscaUrl = strpos($recurso->recurso, $url);
        /* SABER SI ES ARCHIVO */
        $archivo = "uploads/";
        $buscaArchivo = strpos($recurso->recurso, $archivo);

        /* OBTENER SOLO EL NOMBRE DEL ARCHIVO */
        $nombreArchivo = substr($recurso->recurso,8);

        /* OBTENER LA EXTENSIÓN PDF */
        $tiPDF = "pdf";
        $extenPDF = strpos($recurso->recurso, $tiPDF);

        /* OBTENER LA EXTENSIÓN PNG */
        $tiPNG = "png";
        $extenPNG = strpos($recurso->recurso, $tiPNG);
    ?>
    <div class="card tarjeta-planificaciones" style="width: 23rem; margin: 5px;">
        <div class="card-body">

            <h5 class="card-title">Tipo de recurso:</h5>
            <div class="row">
                <div class="col">
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $recurso->tipo; ?></h6>
                </div>
            </div>

            <h5 class="card-title">Recurso:</h5>
            <div class="row">
                <div class="col">
                    <p class="card-text">
                        <?php if($buscaUrl !== FALSE){ ?>
                            <a class="stretched-link text-danger" target="_blank" href="<?php echo $recurso->recurso; ?>"><?php echo $recurso->recurso; ?></a>
                        <?php }else if($buscaArchivo !== FALSE) { ?>
                            <!-- ACCEDER AL RECURSO -->
                            <!-- Si es pdf mostrar esto -->
                            <?php if($extenPDF !== FALSE){ ?>
                                <a class="btn btn-dark" target="_blank" href="<?php echo base_url().$recurso->recurso; ?>"><?php echo $nombreArchivo;?></a>
                            <?php }else if($extenPNG !== FALSE){ ?>
                                <!-- si es tipo imagen mostrar esto -->
                                <a class="btn btn-success" target="_blank" href="<?php echo base_url().$recurso->recurso; ?>"><?php echo $nombreArchivo; ?></a>
                            <?php }else{ ?>
                                <!-- si es otro tipo de archivo mostrar esto -->
                                <a class="btn btn-success" target="_blank" href="<?php echo base_url().$recurso->recurso; ?>"><i class="material-icons">download</i><?php echo $nombreArchivo; ?></a>
                            <?php } ?>
                        <?php } ?>
                    </p>
                </div>
            </div>
            <?php if ($Nrol == $director) {?>
                <div></div>
            <?php }else if($Nrol == $profesor){?>
                <button class="btn btn-danger btn-icon btn-sm" data-eliminar="<?php echo $recurso->idRecurso;?>" data-quitar="<?php echo $recurso->recurso; ?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                    <i class="material-icons">delete</i>
                </button>
            <?php }?>
        </div>
    </div>
<?php }?>
<p><?php if($ListaRecursos->result() == null){ $this->load->view('mensajes/noelemento'); }?></p>
</div>