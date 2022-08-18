<div class="row justify-content-md-center" style="padding-top: 0.2em;">
    <div class="col-md-auto">
        <div class="col-md-auto">
            <img src="./assets/img/logoedusys.png" class="logo-sistema" alt="...">
        </div>
        <form class="form" method="post" id="form">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h3>Iniciar sesión</h3>
                    <br>
                    <div class="alert alert-danger" role="alert" style="display:none;" id="error"></div>
                    <div class="form-group">
                        <label for="usuario">Usuario asignado:</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="John" required="">
                    </div>
                    <div class="form-group">
                        <label for="clave">Contraseña:</label>
                        <input type="password" class="form-control" id="clave" name="clave" placeholder="*********" required="">
                    </div>
                </div>
                <div class="col-md-8 offset-md-2 text-right">
                    <!--<a href="<?php echo base_url()?>index.php/InicioControlador/Secreto" class="btn btn-primary">registrar</a>-->
                    <button type="submit" class="btn btn-warning">Acceder</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(function(){
        $('#error').hide();
        const input = document.querySelector('input');
        const log = document.getElementById('usuario');

        input.addEventListener('input', updateValue);

        function updateValue(e) {
            log.textContent = e.srcElement.value;
            usuar = log.textContent;
        }
        
        $(document).on("change", $("#usuario"), function (evt) {
            var dato = {usuario: usuar};
            
            $.post('<?php echo base_url()?>index.php/InicioControlador/BuscaUsuario',dato,function(response) {
                if(response == 'ok'){
                    $('#error').hide();
                }else{
                    $('#error').html("usuario incorrecto");
                    $('#error').show();
                }
            });
        });

        $('#form').submit(function(e){
			e.preventDefault();
            $('#error').hide();
            
            var usuario         = $('#usuario').val();
            var clave           = $('#clave').val();
            
            var data = {usuario: usuario, clave: clave};
            
            $.post('<?php echo base_url()?>index.php/InicioControlador/InicioSesion',data,function(response){
                if(response == 'ok'){
                    window.location = '<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario';
                }else{
                    $('#error').html('contraseña incorrecta');
                    $('#error').show();
                }
            });
		});
    });
</script>