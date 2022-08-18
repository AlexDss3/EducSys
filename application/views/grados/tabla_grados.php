
<div class="table-responsive fondo-tabla">
  <table class="table">
    <thead>
        <tr>
            <th scope="col">Grado</th>
            <th scope="col">Nivel educativo</th>
            <th scope="col">Sección</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($ListaGrados as $grado){?>
        <tr>
            <th scope="row"><?php echo $grado->nivel."°";?></th>
            <td><?php if($grado->tipo == "B"){echo " Básica";}else if($grado->tipo == "M"){ echo " Bachillerato";}else{ echo "N/A";} ?></td>
            <td><?php echo $grado->seccion ? $grado->seccion : "N/A"; ?></td>
            <td>
                <a class="btn btn-warning btn-icon btn-sm" href="<?php echo base_url()?>index.php/GradosControlador/editar/<?php echo $grado->idGrado; ?>" data-toggle="tooltip" data-placement="top" title="Editar">
                    <i class="material-icons">edit</i>
                </a>
                <button class="btn btn-danger btn-icon btn-sm" data-eliminar="<?php echo $grado->idGrado;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                    <i class="material-icons">delete</i>
                </button>
            </td>
        </tr>
    <?php }?>
    </tbody>
  </table>
</div>
<div class="row">
<p><?php if($ListaGrados == null){ $this->load->view('mensajes/noelemento'); }?></p>
</div>