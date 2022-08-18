<div class="row">
    <nav>
        <ol class="breadcrumb" style="background-color: rgba(255,255,255,0.0);">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Secciones</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col">
        <h2 class="text-center"><u>Secciones</u></h2>
    </div>
</div>
<br>
<br>
<div class="row">
    <div class="col">
        <div class="input-group">
            <select class="form-control" id="tipo" name="tipo" aria-placeholder="Tipo">
                <option value="x">Todos los niveles</option>
                <option value="B">Educación Básica</option>
                <option value="M">Educación Media</option>
            </select>
            <span class="input-group-btn">
                <button id="btn_busqueda" class="btn btn-default btn-fill" type="button" >
                    buscar
                </button>
            </span>
        </div>
    </div>
    <div class="col">
        <div class="row">
            <div class="col text-right">
                <a href="<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario" class="btn btn-primary">Volver</a>
                <a href="<?php echo base_url()?>index.php/GradosControlador/insertar" class="btn btn-warning">Agregar</a>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12" id="divTabla">
        <?php $this->load->view('grados/tabla_grados'); ?>
    </div>
</div>

<script>
    $(function(){
        $(document).on("click", "button[data-eliminar]", function (evt) {
            var id = $(this).data("eliminar");
            
            swal({
                title: "Eliminar",
                text: "¿Está seguro que desea eliminar el grado?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {                    
                    var data = {id: id};
                    $.post('<?php echo base_url()?>index.php/GradosControlador/eliminar',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/PerfilesControlador/VerGrados';
                        }
                    });
                }
            });
        });

        $('#btn_busqueda').click(function(){
            buscar();
        });

        function buscar(){
            var tipo = $('#tipo').val();
            $.post('<?php echo base_url()?>index.php/GradosControlador/buscar',{tipo:tipo}, function(response){
                $('#divTabla').html(response);
            });
        }
    });
</script>