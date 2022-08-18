<?php 
    foreach($materias->result() as $res){
        $res->nombre; 
    }
?>
<div class="row">
    <nav>
        <ol class="breadcrumb" style="background-color: rgba(255,255,255,0.0);">
        <?php if($rol == "Profesor"){ ?>
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario">Inicio</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/PerfilesControlador/VerMisAsignaciones/<?php echo $idProfesor; ?>">Mis Asignaciones</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $res->nombre; ?></li>
        <?php }else if($rol == "Director"){ ?>
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario">Inicio</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/PerfilesControlador/VerMateriasNivel">Asignar Materias a Grados</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $res->nombre; ?></li>
        <?php } ?>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col">
        <h2>Unidades de la materia: <?php echo $res->nombre; ?></h2>
    </div>
</div>
<br>
<br>
<div class="row">
    <div class="col"></div>
    <div class="form-group-btn">
        <?php if($rol == "Profesor"){ ?>
            <a href="<?php echo base_url()?>index.php/PerfilesControlador/VerMisAsignaciones/<?php echo $idProfesor; ?>" class="btn btn-primary">Volver</a>
            <a href="<?php echo base_url()?>index.php/UnidadesControlador/insertar/<?php echo $idMateriaNivel; ?>/<?php echo $idProfesor; ?>/<?php  echo $res->nombre; ?>" class="btn btn-warning">Agregar</a>
        <?php }else if($rol == "Director"){ ?>
            <a href="<?php echo base_url()?>index.php/PerfilesControlador/VerMateriasNivel" class="btn btn-primary">Volver</a>
        <?php } ?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12" id="divTabla">
        <?php $this->load->view('unidades/tabla_unidades'); ?>
    </div>
</div>

<script>
    $(function(){
        $(document).on("click", "button[data-eliminar]", function (evt) {
            var id = $(this).data("eliminar");
            var idAsig = $(this).data("idasig");
                        
            swal({
                title: "Eliminar",
                text: "¿Está seguro que desea eliminar la unidad seleccionada?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {                    
                    var data = {id: id};
                    $.post('<?php echo base_url()?>index.php/UnidadesControlador/eliminar',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/AsignacionesControlador/VerUnidades/'+idAsig+'/<?php echo $idProfesor; ?>';
                        }
                    });
                }
            });
        });

        $('#btn_busqueda').click(function(){
            buscar();
        });

        $('#txt_busqueda').keyup(function(e){
            if(e.key == 'Enter'){
                buscar();
            }
        });

        function buscar(){
            var nivel = $('#nivel').val();
            var materia = $('#materia').val();
            var unidad = $('#unidad').val();
            $.post('<?php echo base_url()?>index.php/UnidadesControlador/buscar',{nivel:nivel,materia:materia, unidad:unidad}, function(response){
                $('#divTabla').html(response);
            });
        }
    });
</script>