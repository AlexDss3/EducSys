<div class="table-responsive fondo-tabla">
  <table class="table">
    <thead>
        <tr>
            <th scope="col">Grado</th>
            <th scope="col">Materia</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($ListaAsignaciones as $asignacion){?>
        <tr>
            <th scope="row"><?php echo $asignacion->nivel."°"; ?></th>
            <td><?php echo $asignacion->materia; ?></td>
            <td>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/MNControlador/VerUnidades/<?php echo $asignacion->idMateriaNivel;?>" data-toggle="tooltip" data-placement="top" title="Ver unidades">
                    <i class="material-icons">list</i>
                </a>

                <a class="btn btn-warning btn-icon btn-sm" href="<?php echo base_url()?>index.php/MNControlador/editar/<?php echo $asignacion->idMateriaNivel;?>" data-toggle="tooltip" data-placement="top" title="Editar">
                    <i class="material-icons">edit</i>
                </a>

                <button class="btn btn-danger btn-icon btn-sm" data-eliminar="<?php echo $asignacion->idMateriaNivel;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                    <i class="material-icons">delete</i>
                </button>

            </td>
        </tr>
    <?php }?>
    </tbody>
  </table>
</div>
<div class="row">
<p><?php if($ListaAsignaciones == null){ $this->load->view('mensajes/noelemento'); }?></p>
</div>