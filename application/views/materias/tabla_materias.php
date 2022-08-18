<div class="row centrar">
    <?php foreach($ListaMaterias as $materia){?>
        <div class="card tarjeta-materias" style="width: 20rem; margin: 5px;">
            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <h3 class="card-title"><?php echo $materia->materia; ?></h3>
                    </div>
                </div>

                <br>
                
                <div class="text-right">
                    <a class="btn btn-warning btn-icon btn-sm" href="<?php echo base_url()?>index.php/MateriasControlador/editar/<?php echo $materia->idMateria; ?>" data-toggle="tooltip" data-placement="top" title="Editar">
                        <i class="material-icons">edit</i>
                    </a>
                    <button class="btn btn-danger btn-icon btn-sm" data-eliminar="<?php echo $materia->idMateria;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                        <i class="material-icons">delete</i>
                    </button>
                </div>
                
            </div>
        </div>
    <?php }?>
</div>
<p><?php if($ListaMaterias == null){ $this->load->view('mensajes/noelemento'); }?></p>