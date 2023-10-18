<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
function verificarSesion() {
$.get('http://localhost/alanphp/bppi/ppi/login/verificar_sesion.php', function(data) {
        if (data == 'true') {
            // El usuario tiene una sesión abierta
 
        } else {
            // El usuario no tiene una sesión abierta
            window.location.href = 'http://localhost/alanphp/bppi/ppi/login/login.php';
        }
    });
}

function detalleUno() {
const urlParams = new URLSearchParams(window.location.search);
const x = urlParams.get('id');
$.ajax({
    url: 'verdetallebanner.php',
    type: 'POST',
    data: { id: x },
    success: function(data) {
        console.log(data);
        let jsonData = JSON.parse(data);
        mostrarJson(jsonData);
    }
});
}
    $(document).ready(function() {
        verificarSesion();
        detalleUno();
    });



function mostrarJson(info){
    
//    let muestra = document.getElementById("muestra");
    
    let id =document.getElementById("id");
    let nombre =document.getElementById("etiqueta");
    let status = document.getElementById("status");
    let eliminado = document.getElementById("eliminado");

    datos = JSON.stringify(info);

    id.innerHTML = info[0].id;
    etiqueta.innerHTML = info[0].nombre
    status.innerHTML = info[0].status;
    eliminado.innerHTML = info[0].eliminado;
    let rutaImagen = "../alta/fotos/" + info[0].archivo;
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

    <img id="imagen" alt="Foto del usuario">


        <h1>ID</h1>
        <div id="id"></div> <br>
        <h1>etiqueta</h1>
        <div id="etiqueta"></div> <br>
        <h1>status</h1>
        <div id="status"></div> <br>
        <h1>eliminado</h1>
        <div id="eliminado"></div> <br>


        <a href="http://localhost/alanphp/bppi/ppi/backBanners/listado">
            <button>Regresar a listado</button>
        </a>


</body>

</html>