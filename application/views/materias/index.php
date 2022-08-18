<div class="row">
    <nav>
        <ol class="breadcrumb" style="background-color: rgba(255,255,255,0.0);">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Materias</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col">
        <h2 class="text-center"><u>Materias</u></h2>
    </div>
</div>
<br>
<div class="row">
    <div class="col-xs-10 col-md-8"></div>
    <div class="col-sm-12 col-md-4 text-right">
        <a href="<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario" class="btn btn-primary">Volver</a>
        <a href="<?php echo base_url()?>index.php/MateriasControlador/insertar" class="btn btn-warning">Agregar</a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12" id="divTabla">
        <?php $this->load->view('materias/tabla_materias'); ?>
    </div>
</div>

<script>
    $(function(){
        $(document).on("click", "button[data-eliminar]", function (evt) {
            var id = $(this).data("eliminar");
            
            swal({
                title: "Eliminar",
                text: "¿Está seguro que desea eliminar la materia?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {                    
                    var data = {id: id};
                    $.post('<?php echo base_url()?>index.php/MateriasControlador/eliminar',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/PerfilesControlador/VerMaterias';
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
            var criterio = $('#txt_busqueda').val() == "" ? 'all': $('#txt_busqueda').val();
            $.post('<?php echo base_url()?>index.php/MateriasControlador/buscar',{criterio:criterio}, function(response){
                $('#divTabla').html(response);
            });
        }
    });
</script>