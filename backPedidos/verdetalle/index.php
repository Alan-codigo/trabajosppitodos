<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>

    $(document).ready(function() {
        detalleUno();
    });

    function detalleUno() {
    const urlParams = new URLSearchParams(window.location.search);
    const x = urlParams.get('id');
    $.ajax({
        url: 'verdetallepedido.php',
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
    
    let id =document.getElementById("id");
    let usuario =document.getElementById("usuario");
    let fecha = document.getElementById("fecha");
    let status = document.getElementById("status");

    datos = JSON.stringify(info);

    id.innerHTML = info[0].id;
    usuario.innerHTML = info[0].usuario
    status.innerHTML = info[0].status;
    fecha.innerHTML = info[0].fecha;

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

        <h1>ID</h1>
        <div id="id"></div> <br>
        <h1>usuario</h1>
        <div id="usuario"></div> <br>
        <h1>status</h1>
        <div id="status"></div> <br>
        <h1>fecha</h1>
        <div id="fecha"></div> <br>


        <a href="http://localhost/alanphp/bppi/ppi/backPedidos/listado">
            <button>Regresar a listado</button>
        </a>


</body>

</html>