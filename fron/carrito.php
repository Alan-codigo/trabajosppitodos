<?php
session_start();
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<script>

    /*
    Pedidos
---------
Se mostrará un listado con los productos agregados de ese pedido (solo un pedido se mostrará, en este caso el "abierto")
En este listado de productos se podrá eliminar un producto del listado.
Tendrá un botón para "Enviar pedido". Este botón llamará un ajax para cambiar el status del pedido a "Cerrado"



    */

    function obtenerPedidoActual(callback) {
    var username = "<?php echo $username; ?>";

    $.ajax({
        url: 'http://localhost/alanphp/bppi/ppi/fron/getidpedido.php',
        type: 'POST',
        data: { usuario: username },
        success: function(data) {
            console.log(data);
            jsonData = JSON.parse(data);

            if (data === '"no encontrado"') {
                console.log("No se encontró, se creará un nuevo pedido");
                window.location.href = 'http://localhost/alanphp/bppi/ppi/fron/home.php'; 
                crearPedido(username, function(newId) {
                    // Llamada recursiva para obtener el ID del nuevo pedido
                    obtenerPedidoActual(callback);
                });
            } else {
                console.log("ID del pedido: " + jsonData[0].id);
                var regreso = jsonData[0].id;
                callback(regreso);
            }
        }
    });
}

function aumentar(idProducto,cantidad){

obtenerPedidoActual(function(idPedido) {

// Aquí puedes usar el ID del pedido y el ID del artículo para realizar las operaciones necesarias

console.log("se eejecuto aumentar");
$.ajax({
  url: 'http://localhost/alanphp/bppi/ppi/fron/aumenta.php',
  type: 'POST',
  data: { idPedido: idPedido, idProducto: idProducto},
  success: function(data) {

    window.location.href = 'http://localhost/alanphp/bppi/ppi/fron/carrito.php'; 

  }
});



});


}

function disminuir(idpro,idped){

console.log("se eejecuto disminuir");

$.ajax({
  url: 'http://localhost/alanphp/bppi/ppi/fron/disminuir.php',
  type: 'POST',
  data: { idPedido: idped, idProducto: idpro},
  success: function(data) {

    window.location.href = 'http://localhost/alanphp/bppi/ppi/fron/carrito.php'; 

  }
});

}

function borrar(idpro,idped){

    console.log("se eejecuto disminuir");

$.ajax({
  url: 'http://localhost/alanphp/bppi/ppi/fron/borrar.php',
  type: 'POST',
  data: { idPedido: idped, idProducto: idpro},
  success: function(data) {

    window.location.href = 'http://localhost/alanphp/bppi/ppi/fron/carrito.php'; 

  }
});

}

function cerrarpedido(producto,pedido){

$.ajax({
    url: 'http://localhost/alanphp/bppi/ppi/backPedidos/eliminacion/eliminarpedido.php',
    type: 'POST',
    data: { id: pedido },
    success: function(response) {


        window.location.href = 'http://localhost/alanphp/bppi/ppi/fron/home.php'; 
                        

    }
});

}

$(document).ready(function(){

obtenerPedidoActual(function(idPedido) {

console.log("nuestro pedido actual es " + idPedido);

let precioTotal = "0";
// Aquí puedes usar el ID del pedido y el ID del artículo para realizar las operaciones necesarias

$.ajax({
  url: 'http://localhost/alanphp/bppi/ppi/fron/obtenerpp.php',
  type: 'POST',
  data: { id: idPedido },
  success: function(data) {
    console.log(data);
    jsonData = JSON.parse(data);
    
    // Obtener el contenedor HTML donde mostrar los datos
    let precioTotal = 0;
    var container = document.getElementById('json-container');
    var valoramostrar = document.getElementById('precio');

    // Recorrer los elementos del JSON y crear el HTML correspondiente
    var html = '';
    html += "<button class='botoncerrar' onclick='cerrarpedido(" + jsonData[0].id_producto + "," + jsonData[0].id_pedido + ")'>cerrar pedido</button>";
    for (var i = 0; i < jsonData.length; i++) {
        
        var item = jsonData[i];
        precioTotal = precioTotal + (item.precio * item.cantidad);
      html += '<div class="productoEnCarrito">';
      html += '<p>ID: ' + item.id + '</p>';
      html += '<p>ID Pedido: ' + item.id_pedido + '</p>';
      html += '<p>ID Producto: ' + item.id_producto + '</p>';
      html += '<p id="cantidaddp'+ item.id_producto+'">Cantidad: ' + item.cantidad + '</p>';
      html += '<p>Precio c/u: ' + item.precio + '</p>';
      html += '<p>Precio de estos articulos: ' + item.precio * item.cantidad + '</p>';
      html += "<button onclick='aumentar(" + item.id_producto + "," + item.cantidad + ")'>+</button>";
      html += "<button onclick='disminuir(" + item.id_producto + "," + item.id_pedido + ")'>-</button>";
      html += "<button onclick='borrar(" + item.id_producto + "," + item.id_pedido + ")'>BORRAR TODO</button>";
      html += '</div>';

    }
    
    // Agregar el HTML al contenedor
    valoramostrar.innerHTML = precioTotal;
    container.innerHTML = html;
    console.log(precioTotal + "LA SUMA DE TODO ES ");
  }
});



});

});


function cerrarPedido(){


}
</script>


<div class="cabecera">
    <img src="logo.jpg" alt="">
    <a class="opcioneCabecera" href="http://localhost/alanphp/bppi/ppi/fron/home.php">HOME</a>
    <a class="opcioneCabecera" href="http://localhost/alanphp/bppi/ppi/fron/productos.php">PRODUCTOS</a>
    <a class="opcioneCabecera" href="http://localhost/alanphp/bppi/ppi/fron/contacto.php">CONTACTO</a>
    <a class="opcioneCabecera" href="http://localhost/alanphp/bppi/ppi/fron/carrito.php">CARRITO</a>
    <a class="opcioneCabecera" href="http://localhost/alanphp/bppi/ppi/fron/cerrarcliente.php"><?php echo $_SESSION['username']; ?> cerrarSesion</a>
</div>

<div class="todo">
  <div id="contenedor-carrito"></div>
  <div id="json-container"></div>
  
  <div class="valores">
      <div>El precio final es</div>
      <div id="precio"></div>
  
  </div>

</div>




<footer>
        <a class="opcionesFooter" href="">derechos</a>
        <a class="opcionesFooter" href="">redes sociales</a>
        <a class="opcionesFooter" href="">terminos y condiciones</a>
</footer>

</body>
</html>