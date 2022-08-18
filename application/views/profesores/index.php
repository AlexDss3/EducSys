<div class="row">
    <nav>
        <ol class="breadcrumb" style="background-color: rgba(255,255,255,0.0);">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profesores</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col">
        <h2 class="text-center"><u>Profesores</u></h2>
    </div>
</div>
<br>
<br>
<div class="row">
    <div class="col">
        <div class="input-group">
            <select class="form-control" id="profesor">
                <option value="0">Todos los profesores...</option>
                <?php foreach($ListaProfesores as $profesores){?>
                    <?php if ($profesores->rol != $rol) {?>
                        <option value="<?php echo $profesores->idUsuario;?>"><?php echo $profesores->nombre." ".$profesores->apellido;?></option>
                    <?php }?>
                <?php }?>
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
                <a href="<?php echo base_url()?>index.php/ProfesoresControlador/Insertar" class="btn btn-warning">Agregar</a>
            </div>
        </div>
    </div>
</div>

<br>

<div class="row">
    <div class="container-fluid" id="divTabla">
        <?php $this->load->view('profesores/profesoresListado'); ?>
    </div>
</div>


<script>
    $(function(){
        $(document).on("click", "button[data-eliminar]", function (evt) {
            var id = $(this).data("eliminar");
            //$('.toast').toast();
            
            swal({
                title: "Eliminar",
                text: "¿Está seguro que desea eliminar el Profesor?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {      

                    var data = {id: id};

                    $.post('<?php echo base_url()?>index.php/ProfesoresControlador/Eliminar',data,function(response){
                        if(response == 'ok'){
                            //$('#notificar').toast('show');
                            window.location = '<?php echo base_url()?>index.php/PerfilesControlador/VerProfesores';
                        }
                    });
                }
            });
        });

        $('#btn_busqueda').click(function(){
            buscar();
        });

        function buscar(){
            var profesor = $('#profesor').val();

            $.post('<?php echo base_url()?>index.php/ProfesoresControlador/Buscar',{profesor:profesor}, function(response){
                $('#divTabla').html(response);
            });
        }
    });
</script>