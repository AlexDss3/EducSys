<?php
foreach($materias->result() as $res){ 
    $res->id;
    $res->nombre;
}
$nombreU = $res->nombre;
?>

<div class="row">
    <nav>
        <ol class="breadcrumb" style="background-color: rgba(255,255,255,0.0);">
        <?php if($rol == "Profesor"){ ?>
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario">Inicio</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/PerfilesControlador/VerMisAsignaciones/<?php  echo $idProfesor;?>">Mis Asignaciones</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/AsignacionesControlador/VerUnidades/<?php echo $idMateriaNivel;?>/<?php echo $idProfesor;?>"><?php echo $res->nombre; ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $res->nombre; ?></li>
        <?php }else if($rol == "Director"){ ?>
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario">Inicio</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/PerfilesControlador/VerMateriasNivel">Asignar Materias a Grados</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/MNControlador/VerUnidades/<?php echo $res->id; ?>"><?php print_r($materiaUnidad->result()[0]->nombre); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $res->nombre; ?></li>
        <?php } ?>
        </ol>
    </nav>
</div>

<h3>Temas de: <?php echo $nombreU; ?></h3><br>
<div class="row">
    <div class="col"></div>
    <div class="form-group-btn">
        <?php if($rol == "Profesor"){ ?>
            <a href="<?php echo base_url()?>index.php/AsignacionesControlador/VerUnidades/<?php echo $idMateriaNivel;?>/<?php echo $idProfesor;?>" class="btn btn-primary">volver</a>
            <a href="<?php echo base_url()?>index.php/ContenidosControlador/insertar/<?php echo $idUnidad; ?>/<?php echo $idMateriaNivel;?>/<?php echo $idProfesor;?>" class="btn btn-warning">Agregar</a>
        <?php }else if($rol == "Director"){ ?>
            <a href="<?php echo base_url()?>index.php/MNControlador/VerUnidades/<?php echo $res->id; ?>" class="btn btn-primary">volver</a>
        <?php } ?>
    </div>
</div>

<br>
<div class="row">
    <div class="col-12" id="divTabla">
        <?php $this->load->view('contenido/tabla_contenido'); ?>
    </div>
</div>

<script>
    $(function(){
        $(document).on("click", "button[data-eliminar]", function (evt) {
            var id = $(this).data("eliminar");
            var idUni = $(this).data("idUni");

            swal({
                title: "Eliminar",
                text: "¿Está seguro que desea eliminar el Profesor?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {                    
                    var data = {id: id};
                    $.post('<?php echo base_url()?>index.php/ContenidosControlador/eliminar',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/UnidadesControlador/VerContenidos/<?php echo $idUnidad; ?>/<?php echo $idMateriaNivel;?>/<?php echo $idProfesor;?>';
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
            $.post('<?php echo base_url()?>index.php/ContenidosControlador/buscar',{nivel:nivel,materia:materia, unidad:unidad}, function(response){
                $('#divTabla').html(response);
            });
        }
    });
</script>