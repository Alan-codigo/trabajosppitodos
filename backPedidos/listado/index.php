<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listado de pedidos</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>
    <script>

        function editarid(x){
            window.location.href = "http://localhost/alanphp/bppi/ppi/backPedidos/edicion/?id=" + x;
        }

        function verdetallepedidoid(x){
            window.location.href = "http://localhost/alanphp/bppi/ppi/backPedidos/carrito/?id=" + x;
        }

        function borrarpedidoid(x) {
            let permiso = confirm("¿Estás seguro de que quieres eliminar este registro?");
            if (permiso) {
                $.ajax({
                    url: '../eliminacion/eliminarpedido.php',
                    type: 'POST',
                    data: { id: x },
                    success: function(response) {
                        
                        alert(response);

                        deleteRow(x);

                    }
                });
            }
        }

        function deleteRow(rowId) {
        $('#row-' + rowId).remove();
        }

        function obtener(){

            $.ajax({
                url: "obtenerpedidos.php",
                type: "GET",
                dataType: 'json',
                success:function(data){

                    var html = '<table>';
                    html += '<tr><th>ID</th><th>fecha</th><th>usuario</th><th>status</th><th>ELIMINAR</th><th>VER DETALLE</th><th>EDITAR</th></tr>';
                    for (var i = 0; i < data.length; i++) {
                        html += '<tr id="row-' + data[i].id + '">';
                        html += '<td>' + data[i].id + '</td>';
                        html += '<td>' + data[i].fecha + '</td>';
                        html += '<td>' + data[i].usuario + '</td>';
                        html += '<td>' + data[i].status + '</td>';
                        html += '<td><button onclick="borrarpedidoid(' + data[i].id + ')">Eliminar</button></td>';
                        html += '<td><button onclick="verdetallepedidoid(' + data[i].id + ')">Ver Detalle</button></td>';
                        html += '<td><button onclick="editarid(' + data[i].id + ')">Editar</button></td>';
                        html += '</tr>';
                    }
                    html += '</table>';
                    $('#tabla').html(html);

                }
            });
        }


        $(document).ready(function(){
            obtener();
        });
    </script>

<div class="opcionesContenedor">

<a href="http://localhost/alanphp/bppi/ppi/login/bienvenido.php" class="opcion">INICIO</a>
<a href="http://localhost/alanphp/bppi/ppi/b2/" class="opcion">EMPLEADOS</a>
<a href="http://localhost/alanphp/bppi/ppi/backProductos/listado/" class="opcion">PRODUCTO</a>
<a href="http://localhost/alanphp/bppi/ppi/backPedidos/listado/" class="opcion">PEDIDOS</a>
<a href="http://localhost/alanphp/bppi/ppi/backBanners/listado/" class="opcion">BANNERS</a>

</div>

<a href="http://localhost/alanphp/bppi/ppi/backPedidos/alta/" class="opcion">Agregar Pedido</a>

<div id="tabla"></div>


<a class="botonlistado" href="http://localhost/alanphp/bppi/ppi/login/bienvenido.php">        
        <button> 
REGRESAR
        </button>
    </a>
</body>
</html>