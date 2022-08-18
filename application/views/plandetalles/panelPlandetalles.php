<div class="row">
<?php
    $director = "director";
    $profesor = "profesor";
    // CONVERTIMOS LA CADENA DEL ROL EN MINÚSCULAS
    $Nrol = strtolower($rol);
    
    $realizado = "<div class='text-center' role='alert' title='Realizada' style='padding: 0px; color: rgb(0,180,0);'><i class='material-icons'>check_circle</i></div>";
    $norealizado = "<div class='text-center' role='alert' title='Sin realizar' style='padding: 0px; color: rgb(180,0,0);'><i class='material-icons'>error</i></div>";

    // REEMPLAZAMOS LOS CARACTERES ESPECIALES QUE SE AGREGARON EN LA URl Y DE ESTA MANERA PASAR EL VAROL EXACTO
    $Nmateria = urldecode($materia);
    $NombreProfe = $NombreProfesor[0]->nombre." ".$NombreProfesor[0]->apellido;
?>

<div class="table-responsive fondo-tabla">
  <table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">UNIDAD</th>
            <th scope="col">TEMA</th>
            <th scope="col">DESDE</th>
            <th scope="col">HASTA</th>
            <th scope="col">FECHA DE EJECUCIÓN</th>
            <th scope="col">IFEA</th>
            <th scope="col">EJECUTADO</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($ListaPlanDetalles as $plandetalle){?>
        <tr>
            <td><?php echo $plandetalle->unidad; ?></td>
            <td><?php echo $plandetalle->nombreUnidad; ?></td>
            <td><?php echo $plandetalle->correlativo." ".$plandetalle->tema; ?></td>
            <td><?php echo $plandetalle->desde; ?></td>
            <td><?php echo $plandetalle->hasta; ?></td>
            <td><?php echo $plandetalle->ejecutado; ?></td>
            <td><?php echo $plandetalle->ifea; ?></td>
            <td><?php echo ($plandetalle->hecho == 1) ? $realizado : $norealizado;?></td>
            <td>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/PlanDetallesControlador/VerRecursos/<?php echo $plandetalle->idPlanDetalle;?>/<?php echo $NombreProfe;?>/<?php echo $materia;?>/<?php echo $idProfesor;?>/<?php echo $idPlanificacion; ?>/<?php echo $idAsignacion; ?>/<?php echo $anio; ?>" data-toggle="tooltip" data-placement="top" title="Recursos">
                    <i class="material-icons">folder</i>
                </a>
            </td>
            <td>
                <?php if ($Nrol == $director) {?>
                    <div></div>
                <?php }else if($Nrol == $profesor){?>
                    <a class="btn btn-warning btn-icon btn-sm" href="<?php echo base_url()?>index.php/PlanDetallesControlador/Editar/<?php echo $idProfesor;?>/<?php echo $plandetalle->idPlanDetalle;?>/<?php echo $idPlanificacion;?>/<?php echo $idAsignacion;?>/<?php echo $anio;?>/<?php echo $materia;?>" data-toggle="tooltip" data-placement="top" title="Editar">
                        <i class="material-icons">edit</i>
                    </a>
                    <button class="btn btn-danger btn-icon btn-sm" data-eliminar="<?php echo $plandetalle->idPlanDetalle;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                        <i class="material-icons">delete</i>
                    </button>
                <?php }?>
            </td>
        </tr>
    <?php }?>
    </tbody>
  </table>
    <p><?php if($ListaPlanDetalles == null){ $this->load->view('mensajes/noelemento'); }?></p>
</div>
