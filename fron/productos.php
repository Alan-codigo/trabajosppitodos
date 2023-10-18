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
    <title>listado de productos</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <script>

function crearPedido(usuario){

var fechaActual = new Date();
var año = fechaActual.getFullYear();
var mes = ('0' + (fechaActual.getMonth() + 1)).slice(-2); // Se suma 1 y se añade un cero al mes si es necesario
var día = ('0' + fechaActual.getDate()).slice(-2); // Se añade un cero al día si es necesario
var fechaMySQL = año + '-' + mes + '-' + día;

var formData = new FormData;
    
formData.append('usuario',usuario); 
formData.append('fecha',fechaMySQL);

$.ajax({

url: 'http://localhost/alanphp/bppi/ppi/backPedidos/alta/alta.php',
type: 'POST',
data: formData,
contentType: false,
processData: false,

success: function(respuesta){
    console.log(respuesta);
    console.log("se logro guardar el pedido");

},
error:function(jqXHR, textStatus, errorThrown){
    console.log(textStatus, errorThrown);
}
})

}

function abrirPedido(callback) {
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
                crearPedido(username, function(newId) {
                    // Llamada recursiva para obtener el ID del nuevo pedido
                    abrirPedido(callback);
                });
            } else {
                console.log("ID del pedido: " + jsonData[0].id);
                var regreso = jsonData[0].id;
                callback(regreso);
            }
        }
    });
}


function agregarCarrito(x,costo) {

    console.log("AGREGANDO " + x + " al carrito" + costo + "atras costo");
    let idArticulo = x;
    let pedido;
    abrirPedido(function(idPedido) {

        // Aquí puedes usar el ID del pedido y el ID del artículo para realizar las operaciones necesarias
        $.ajax({
        url: 'http://localhost/alanphp/bppi/ppi/fron/obteneridpidp.php',
        type: 'POST',
        data: { idpe: idPedido, idpr: idArticulo, costo: costo},
        success: function(data) {
            console.log(data);
            jsonData = JSON.parse(data);
        }
        });
    });
}

        function verProducto(x){
            console.log(x);
            window.location.href = "http://localhost/alanphp/bppi/ppi/fron/verdetalle/?id=" + x;
        }

        function obtener(){

            let idproducto = 0;

            $.ajax({
                url: "http://localhost/alanphp/bppi/ppi/backProductos/listado/obtenerproductos.php",
                type: "GET",
                dataType: 'json',
                success:function(data){
                    
                    for(let i = 0; i < data.length; i++){
                        console.log(data[i].id);
                        idproducto = data[i].id
                        detalleUno(idproducto);
                    }


                }
            });
        }

        function detalleUno(idproducto) {
        $.ajax({
        url: 'http://localhost/alanphp/bppi/ppi/BackProductos/verdetalle/verdetalleproducto.php',
        type: 'POST',
        data: { id: idproducto },
        success: function(data) {
            console.log(data);
            let jsonData = JSON.parse(data);
            mostrarJsonProducto(jsonData);
        }
        });
        }

        function mostrarJsonProducto(info) {
  // Obtener una referencia al elemento HTML donde se mostrarán los datos
  var contenedor = document.getElementById("contenedor-productos");

  // Recorrer cada JSON
  for (var i = 0; i < info.length; i++) {
    // Obtener los datos del JSON actual
    var id = info[i].id;
    var nombre = info[i].nombre;
    var codigo = info[i].codigo;
    var descripcion = info[i].descripcion;
    var costo = info[i].costo;
    var stock = info[i].stock;
    var archivo_n = info[i].archivo_n;
    var archivo = info[i].archivo;
    var status = info[i].status;
    var eliminado = info[i].eliminado;
    var urlImagen = "http://localhost/alanphp/bppi/ppi/backProductos/alta/fotos/" + archivo_n;

    // Construir el HTML para mostrar los datos
    var html = "<div class='productos'>";

    var imagenHTML = "<img src='" + urlImagen + "' alt='Imagen de producto'>";
    html += imagenHTML;
    html += "<p>Nombre: " + nombre + "</p>";
    html += "<p>Código: " + codigo + "</p>";
    html += "<p>Costo: " + costo + "</p>";
    html += "<button onclick='verProducto(" + id + ")'>ver detalle</button>";
    html += "<button onclick='agregarCarrito(" + id + "," + costo + ")'>Enviar al carrito</button>";
    html += "</div>";

    // Agregar el HTML al contenedor
    contenedor.innerHTML += html;
  }
}


        $(document).ready(function(){
            obtener();
        });
    </script>


<div class="cabecera">
    <img src="logo.jpg" alt="">
    <a class="opcioneCabecera" href="http://localhost/alanphp/bppi/ppi/fron/home.php">HOME</a>
    <a class="opcioneCabecera" href="http://localhost/alanphp/bppi/ppi/fron/productos.php">PRODUCTOS</a>
    <a class="opcioneCabecera" href="http://localhost/alanphp/bppi/ppi/fron/contacto.php">CONTACTO</a>
    <a class="opcioneCabecera" href="http://localhost/alanphp/bppi/ppi/fron/carrito.php">CARRITO</a>
</div>

<div id="contenedor-productos"></div>

<footer>
        <a class="opcionesFooter" href="">derechos</a>
        <a class="opcionesFooter" href="">redes sociales</a>
        <a class="opcionesFooter" href="">terminos y condiciones</a>
</footer>

</body>
</html>