<div class="row">
    <nav>
        <ol class="breadcrumb" style="background-color: rgba(255,255,255,0.0);">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Asignar Materias a Grados</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col">
        <h2 class="text-center"><u>Materias por Grados</u></h2>
    </div>
</div>
<br>
<br>
<div class="row">
    <div class="col">
        <div class="form-inline">
            <div class="form-group">
                <select class="form-control" name="nivel" id="nivel">
                    <option value="0">Nivel</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="idMateria" id="idMateria">
                    <option value="0">Materia</option>
                    <?php foreach($materias as $res){ ?>
                        <option value="<?php echo $res->idMateria;?>"><?php echo $res->materia;?></option>
                    <?php }?>
                </select>
            </div>
            <span class="form-group-btn">
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
                <a href="<?php echo base_url()?>index.php/MNControlador/insertar" class="btn btn-warning">Asignar</a>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col" id="divTabla">
        <?php $this->load->view('materianivel/tabla_mn'); ?>
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
                    $.post('<?php echo base_url()?>index.php/MNControlador/eliminar',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/PerfilesControlador/VerMateriasNivel';
                        }
                    });
                }
            });
        });

        $('#btn_busqueda').click(function(){
            buscar();
        });

        function buscar(){
            var nivel       = $('#nivel').val();
            var idMateria   = $('#idMateria').val();

            $.post('<?php echo base_url()?>index.php/MNControlador/buscar',{nivel: nivel, idMateria: idMateria}, function(response){
                $('#divTabla').html(response);
            });
        }
    });
</script>