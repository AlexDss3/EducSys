<?php
    $mensaje = "<div class='col'><div class='alert alert-dark text-center' role='alert'><p class='display-4'>No hay elementos para mostrar</p></div></div>";
?>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Rol</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($ListaRoles->result() as $rol){?>
            <tr>
                <td><?php echo $rol->idRol; ?></td>
                <td><?php echo $rol->rol; ?></td>
                <td class="text-right">
                    <a class="btn btn-warning btn-icon btn-sm" href="<?php echo base_url()?>index.php/RolesControlador/editar/<?php echo $rol->idRol;?>" data-toggle="tooltip" data-placement="top" title="Editar">
                        <i class="material-icons">edit</i>
                    </a>
                    <button class="btn btn-danger btn-icon btn-sm" data-eliminar="<?php echo $rol->idRol;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                        <i class="material-icons">delete</i>
                    </button>
                </td>
            </tr>
        <?php }?>
        
<p><?php if($ListaRoles->result() == null){echo $mensaje;}?></p>
    </tbody>
</table>