<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>formulario b3</title>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            
        $(document).ready(function(){
        $('form').submit(function(event){
        
            event.preventDefault();
            var nombre = $('#nombre').val();
            var apellido = $('#apellidos').val();
            var correo = $('#correo').val();
            var password = $('#password').val();
            var rol = $('#rol').val();
            
            if(nombre === "" || apellido === "" || correo === "" || password === "" || rol === ""){
                alert("Por favor llene todos los campos");
                $('#mensaje-enviado').show();
                setTimeout(function(){
                    $('#mensaje-enviado').hide();
                },5000);
            }else{
            // Enviar una solicitud AJAX a validacion.php para verificar si el correo electrónico ya existe
                $.post("../b3/validacion.php", {correo: correo}, function(data){
                if (data != ""){
                    // El correo electrónico ya existe en la base de datos
                    // Aquí puedes agregar el código para manejar este caso
                    document.getElementById("emailNo").innerHTML = " No podemos mandar un formulario con este correo " + data;
                    $('#emailNo').show();
                    setTimeout(function(){
                    $('#emailNo').hide();
                    }, 5000);
                    alert(data);

                }else{
                    // El correo electrónico no existe en la base de datos
                    // Aquí puedes agregar el código para enviar el formulario
                    $.post("ingresa.php", {nombre: nombre, apellido: apellido, correo: correo, password: password, rol: rol}, function(data){
                        // Aquí puedes agregar el código para manejar la respuesta del servidor
                        alert("Formulario enviado");
                        window.location.href = "http://localhost/alanphp/bppi/ppi/";
                    });
                }
            });
        }
    });
});


            function correCheck() {
                // Obtener el valor del campo de entrada de correo electrónico
                var correo = document.getElementById("correo").value;
                // Enviar una solicitud POST a validacion.php con el valor del correo electrónico
                $.post("validacion.php", {correo: correo}, function(data) {
                // Si data no está vacío, significa que se encontró el correo electrónico
                if (data !== "") {
                    document.getElementById("emailNo").innerHTML = "Correo existente: " + data;
                    $('#emailNo').show();
                    setTimeout(function(){
                    $('#emailNo').hide();
                    }, 5000);
        }
    });
}

            </script>

</head>
<body>

<h1>ALTA DE EMPLEADOSS</h1>
    
    <form>
    <label for="nombre">Nombre:</label><br>
    <input type="text" id="nombre" name="nombre"><br>
    <label for="apellidos">Apellido:</label><br>
    <input type="text" id="apellidos" name="apellidos"><br>
    <label for="correo">Correo electrónico:</label><br>
    <input type="email" id="correo" name="correo" onblur="correCheck()"><br>
    <div id="emailNo" style="display: none;">
        Correo existente!!!!!
    </div>
    <label for="password">Contraseña:</label><br>
    <input type="password" id="password" name="password"><br>
    <label for="rol">Rol:</label><br>
    <select id="rol" name="rol">
        <option value="1">Gerente</option>
        <option value="0">Ejecutivo</option>
    </select><br><br>
    <input type="submit" value="Enviar">
    </form> 

    <div id="mensaje-enviado" style="display: none;">
        POR FAVOR LLENA TODOS LOS DATOS!!!!!
    </div>



    <a href="http://localhost/alanphp/bppi/ppi/">
        <button id="myButton">IR A LISTADO</button>
    </a>

</body>
</html>
