<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>

        .contenedor-general-vd{

            color: white;
            background-color: #616161;

            border-color: black;
            margin-top: 5%;
            text-align: center;
            display: flex;
            justify-content: center;

            border-width: 3px;
            border-style: solid;
            border-color: black;


            border-radius: 5px;
        }

        .contenedorCeldas{

            background-color: #616161;
            width: 30%;

            margin-right: 10%;

        }

        .contenedorBoton{

            display: flex;
            align-items: center;
            justify-content: center;

        }

        .celda{

            background-color: #4CAF50;
            border-width: 1px;
            border-style: solid;
            border-color: black;

            margin-top: 3%;
            border-radius: 10px;
        }

        h1 {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
        }

        button {
            color: white;
            background-color: #388E3C;
            border-radius: 10px;
        }

        .tituloedicion{
            font-size: 400%;
            height: 20%;
            width: 100%;
            justify-content: center;
            text-align: center;
            color: green;
        }
        .conenedorabajo{
            
        }

    </style>

    <script>

$(document).ready(function() {
    detalleUno();
});



function detalleUno() {

    const urlParams = new URLSearchParams(window.location.search);
    const x = urlParams.get('id');

    $.ajax({
        url: '../verDetalle/obtenerUnEmpleado.php',
        type: 'POST',
        data: { id: x },
        success: function(data) {
            console.log(data);
            let jsonData = JSON.parse(data);
            mostrarJson(jsonData);
        }
    });
}


function mostrarJson(info){
    
//    let muestra = document.getElementById("muestra");
    
    let id =document.getElementById("id-muestra");
    let nombre =document.getElementById("nombre");
    let apellido =document.getElementById("apellido");
    let email =document.getElementById("email");
    let rol =document.getElementById("rol");
    let status =document.getElementById("status");
    
    datos = JSON.stringify(info);

    id.innerHTML = info[0].id;
    nombre.innerHTML = info[0].nombre + " " +info[0].apellidos;
    email.innerHTML = info[0].correo;
    rol.innerHTML = info[0].rol;


    if(info[0].rol == 1){
        rol.innerHTML = "gerente";
    } else{
        rol.innerHTML = "empleado";
    }

    
    if(info[0].status == 1){
        
        status.innerHTML = "activo";
    
    } else{

        status.innerHTML = "no activo";

    }


    document.getElementById("nombred").value = info[0].nombre;
    document.getElementById("apellidosd").value = info[0].apellidos;
    document.getElementById("correod").value = info[0].correo;
    document.getElementById("rold").value = info[0].rol;

}

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
    //-----------------------------------

    $(document).ready(function() {

        verificarSesion();

        $('form').submit(function(event){
        
            event.preventDefault();

            var id = document.getElementById("id-muestra").textContent;

            var nombre = $('#nombred').val();
            var apellido = $('#apellidosd').val();
            var correo = $('#correod').val();
            var rol = $('#rold').val();
            var password = $('#password').val();

            const inputFile = document.getElementById('foto');
            
            if(nombre === "" || apellido === "" || correo === "" || rol === ""){

                $('#mensaje-enviado').show();
                setTimeout(function(){
                    $('#mensaje-enviado').hide();
                },5000);

            }else{

                    // Aquí puedes agregar el código para enviar el formulario
                    //$.post("editar.php", {id : id, nombre: nombre, apellidos: apellido, correo: correo, password: password, rol: rol}, function(data){
                    // Aquí puedes agregar el código para manejar la respuesta del servidor
                    //alert("Formulario enviado");
                    //window.location.href = "http://localhost/alanphp/bppi/ppi/b2";
                    //});
                
                $.post("validacion.php", {correo: correo}, function(data){
                if (data == ""){
                    // El correo electrónico ya existe en la base de datos
                    // Aquí puedes agregar el código para manejar este caso
                    document.getElementById("emailNo").innerHTML = " No podemos mandar un formulario con este correo " + data;
                    $('#emailNo').show();
                    setTimeout(function(){
                    $('#emailNo').hide();
                    }, 5000);

                }else{


                    if(inputFile.files.length == 0){
                        console.log("ediatar normal");
                        alert("hola a editar nomal");

                        $.post("editar.php", {id : id, nombre: nombre, apellidos: apellido, correo: correo, password: password, rol: rol}, function(data){
                        // Aquí puedes agregar el código para manejar la respuesta del servidor
                        alert("Formulario enviado");
                        window.location.href = "http://localhost/alanphp/bppi/ppi/b2";
                        });
                    } else {

                        var nombree = $('#nombred').val();
                        var apellidoe = $('#apellidosd').val();
                        var correoe = $('#correod').val();
                        var passworde = $('#password').val();
                        var role = $('#rold').val();
                        
                        // Crear un objeto FormData para enviar los datos al servidor
                        var formData = new FormData();
                        formData.append('id', id);
                        formData.append('nombre', nombree);
                        formData.append('apellido', apellidoe);
                        formData.append('correo', correoe);
                        formData.append('password', passworde);
                        formData.append('rol', role);
                        formData.append('foto', $('#foto')[0].files[0]);

                            // Realizar la petición Ajax
                            $.ajax({
                                url: 'editaFoto.php',
                                type: 'POST',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    // Procesar la respuesta del servidor
                                    console.log(response);
                                    window.location.href = "http://localhost/alanphp/bppi/ppi/b2";
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.log(textStatus, errorThrown);
                                }
                            });

                    }
                    // El correo electrónico no existe en la base de datos
                    // Aquí puedes agregar el código para enviar el formulario
                }
            });


        }
    });

});

function correCheck() {
                // Obtener el valor del campo de entrada de correo electrónico
                var correo = document.getElementById("correod").value;
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

<div class="opcionesContenedor">

<a href="http://localhost/alanphp/bppi/ppi/login/bienvenido.php" class="opcion">INICIO</a>
<a href="http://localhost/alanphp/bppi/ppi/b2/" class="opcion">EMPLEADOS</a>
<a href="http://localhost/alanphp/bppi/ppi/backProductos/listado/" class="opcion">PRODUCTO</a>
<a href="http://localhost/alanphp/bppi/ppi/backPedidos/listado/" class="opcion">PEDIDOS</a>
<a href="http://localhost/alanphp/bppi/ppi/backBanners/listado/" class="opcion">BANNERS</a>

</div>

<div class="tituloedicion"> EDICION DE EMPLEADOS </div>
<div class="contenedor-general-vd">
    
    <h2>DATOS ACTUALES</h2>

    <div class="contenedorCeldas">

        <h1>ID</h1>
        <div class="celda" id="id-muestra"></div> <br>
        <h1>NOMBRE COMPLETO</h1>
        <div class="celda" id="nombre"></div>
        <h1>EMAIL</h1>
        <div class="celda" id="email"></div>
        <h1>ROL</h1>
        <div class="celda" id="rol"></div>
        <h1>STATUS</h1>
        <div class="celda" id="status"></div>

        
    </div>

    <div class="contenedorBoton">
        <a href="http://localhost/alanphp/bppi/ppi/b2/">
            
            <button>Regresar a listado</button>

        </a>
    </div>

</div>

<div class="conenedorabajo">

<h2>DATOS NUEVOS</h2>
<form>
    <label for="nombre">Nombre:</label><br>
    <input type="text" id="nombred" name="nombre"><br>

    <label for="apellidos">Apellido:</label><br>
    <input type="text" id="apellidosd" name="apellidos"><br>

    <label for="correo">Correo electrónico:</label><br>
    <input type="email" id="correod" name="correo" onblur="correCheck()"><br>

    <label for="password">Contraseña:</label><br>
    <input type="password" id="password" name="password"><br>
    
    <label for="rol">Rol:</label><br>
    <select id="rold" name="rol">
        <option value="1">Gerente</option>
        <option value="0">Ejecutivo</option>
    </select><br><br>
    
    <label for="foto">Foto:</label>
    <input type="file" id="foto" name="foto" accept="image/*">

    <input type="submit" value="Enviar">
</form> 


<div id="mensaje-enviado" style="display: none;">Faltan campos por llenar</div>
<div id="emailNo" style="display: none;">Correo existente!!!!!</div>

</div>

<a class="botonlistado" href="http://localhost/alanphp/bppi/ppi"><button>REGRESAR</button></a>

</body>

</html>