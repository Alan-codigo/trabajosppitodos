<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DARDEALTA</title>
</head>
<body>
    <form action="registro.php" method="post" onsubmit="validarCampos()">
        <label for="nombre"> NOMBRE</label>
        <input type="text" id="nombre">
        <br>
        <label for="apellido"> APELLIDO</label>
        <input type="text" id="apellido">
        <br>
        <label for="mail">MAIL</label>
        <input type="mail" id="mail">
        <br>
        <label for="contra">contrasenia</label>
        <input type="text" id="contra">
        <br>
        <select type="text" id="puesto" name="puesto">
            <option value="1">gerente</option>
            <option value="2">Ejecutivo</option>
        </select> 
        
        <br>
        <br>

        <button type="submit" value="enviar"></button>

    </form>

    <script >

            function validarCampos(){

                alert("hola");
                var nombre = document.getElementById("nombre").value;
                var puesto = document.getElementById("puesto").value;
                var apellido = document.getElementById("apellido").value;
                var mail = document.getElementById("mail").value;

                if (nombre == "" || puesto == "" || apellido == "" || mail == ""){
                    alert("Por favor complete todos los campos.");
                    return false;
                } else {
                    alert("pasamos a lo otro");
                document.forms[0].submit();
                }
        
            }

    </script>
</body>
</html>