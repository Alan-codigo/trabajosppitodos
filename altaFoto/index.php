<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="foto.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
        function verificarSesion() {
            $.get('../login/verificar_sesion.php', function(data) {
                if (data == 'true') {
                    // El usuario tiene una sesión abierta
                } else {
                    // El usuario no tiene una sesión abierta
                    window.location.href = '../login/login.php';
                }
            });
        }

    $(document).ready(function() {

        verificarSesion();

        // Capturar el evento de envío del formulario
        $('form').submit(function(event) {
            // Prevenir que se envíe el formulario de manera convencional
            event.preventDefault();

            // Obtener los valores de los campos del formulario
            var nombre = $('#nombre').val();
            var apellido = $('#apellido').val();
            var correo = $('#correo').val();
            var password = $('#password').val();
            var rol = $('#rol').val();
            var foto = $('#foto').val();

            // Crear un objeto FormData para enviar los datos al servidor
            var formData = new FormData();
            formData.append('nombre', nombre);
            formData.append('apellido', apellido);
            formData.append('correo', correo);
            formData.append('password', password);
            formData.append('rol', rol);
            formData.append('foto', $('#foto')[0].files[0]);

            // Realizar la petición Ajax
            $.ajax({
                url: 'altaFoto.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Procesar la respuesta del servidor
                    console.log(response);
                    window.location.href = '../b2/';

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });

        });
    });


    function correCheck() {
        var correo = $('#correo').val();

    }
</script>

</head>
<body>

<div class="opcionesContenedor">

<a href="http://localhost/alanphp/bppi/ppi/login/bienvenido.php" class="opcion">INICIO</a>
<a href="http://localhost/alanphp/bppi/ppi/b2/" class="opcion">EMPLEADOS</a>
<a href="http://localhost/alanphp/bppi/ppi/backProductos/listado/" class="opcion">PRODUCTO</a>
<a href="http://localhost/alanphp/bppi/ppi/backPedidos/listado/" class="opcion">PEDIDOS</a>
<a href="http://localhost/alanphp/bppi/ppi/backBanners/listado/" class="opcion">BANNERS</a>

</div>
    
<div>
    DAR DE ALTA A USUARIO CON FOTO 
</div>

<form>

    <label for="nombre">Nombre:</label><br>
    <input type="text" id="nombre" name="nombre"><br>

    <label for="apellido">Apellido:</label><br>
    <input type="text" id="apellido" name="apellido"><br>

    <label for="correo">Correo electrónico:</label><br>
    <input type="email" id="correo" name="correo" onblur="correCheck()"><br>
    
    <label for="password">Contraseña:</label><br>
    <input type="password" id="password" name="password"><br>

    <label for="rol">Rol:</label><br>
    <select id="rol" name="rol">
        <option value="1">Gerente</option>
        <option value="0">Ejecutivo</option>
    </select><br>

    <label for="foto">Foto:</label>
    <input type="file" id="foto" name="foto" accept="image/*">
    
    <input type="submit" value="Enviar">
</form> 

    <div id="mensaje-enviado" style="display: none;">POR FAVOR LLENA TODOS LOS DATOS!!!!!</div>
    <div id="emailNo" style="display: none;">Correo existente!!!!!</div>
    
    <div class="contenedorBoton">
        <a href="http://localhost/alanphp/bppi/ppi/b2/">
            
            <button>Regresar a listado</button>

        </a>
    </div>

</body>
</html>