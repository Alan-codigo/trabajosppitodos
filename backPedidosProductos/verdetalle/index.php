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
        url: 'verdetallepp.php',
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
    console.log(info);    

    let id =document.getElementById("id");
    let idpedido =document.getElementById("idpedido");
    let idproducto =document.getElementById("idproducto");
    let cantidad =document.getElementById("cantidad");
    let precio =document.getElementById("precio");

    datos = JSON.stringify(info);

    id.innerHTML = info[0].id;
    idpedido.innerHTML = info[0].id_pedido
    idproducto.innerHTML = info[0].id_producto;
    cantidad.innerHTML = info[0].cantidad;
    precio.innerHTML = info[0].precio;
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
        <h1>idpedido</h1>
        <div id="idpedido"></div> <br>
        <h1>idproducto</h1>
        <div id="idproducto"></div> <br>
        <h1>cantidad</h1>
        <div id="cantidad"></div> <br>
        <h1>precio</h1>
        <div id="precio"></div> <br>


        <a href="http://localhost/alanphp/bppi/ppi/backPedidosProductos/listado">
            <button>Regresar a listado</button>
        </a>


</body>

</html>