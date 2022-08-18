<div class="table-responsive fondo-tabla">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Tema</th>
                <?php if($rol == "Profesor"){ ?>
                <th></th>
                <?php }else if($rol == "Director"){ ?>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
        <?php foreach($ListaContenido->result() as $contenido){?>
            <tr>
                <td><?php echo $contenido->correlativo; ?> <?php echo $contenido->tema; ?></td>
                <?php if($rol == "Profesor"){ ?>
                <td>
                    <a class="btn btn-warning btn-icon btn-sm" href="<?php echo base_url()?>index.php/ContenidosControlador/editar/<?php echo $contenido->idContenido;?>/<?php echo $idUnidad;?>/<?php echo $idMateriaNivel;?>/<?php echo $idProfesor;?>" data-toggle="tooltip" data-placement="top" title="Editar">
                        <i class="material-icons">edit</i>
                    </a>
                    <button class="btn btn-danger btn-icon btn-sm" data-idUni="<?php echo $idUnidad; ?>" data-eliminar="<?php echo $contenido->idContenido;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                        <i class="material-icons">delete</i>
                    </button>
                </td>
                <?php }else if($rol == "Director"){ ?>
                <?php } ?>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>
<div class="row">
<p><?php if($ListaContenido->result() == null){ $this->load->view('mensajes/noelemento'); }?></p>
</div>
