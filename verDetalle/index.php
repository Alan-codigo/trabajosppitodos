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

        .imgusuario{
            margin-top: 10%;
            border-radius: 100px;
            height: 100px;
            width: 100px;

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
        url: 'obtenerUnEmpleado.php',
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
    let imagen = document.getElementById("imagen");

    
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


    // establecer el atributo src de la imagen
    
    
    console.log(info[0].archivo);
    let rutaImagen = "../altaFoto/fotos/" + info[0].archivo_n;
    console.log(rutaImagen + " gadasdasdasd hola");
    imagen.setAttribute("src", rutaImagen);

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

<div class="contenedor-general-vd">
    
<div class="contenedorimg">
    <img class="imgusuario" id="imagen" alt="Foto del usuario">

</div>

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

</body>

</html>