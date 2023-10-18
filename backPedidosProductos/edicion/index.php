<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>
<script>
            $(document).ready(function(){

                const urlParams = new URLSearchParams(window.location.search);
                const x = urlParams.get('id');
                document.getElementById("id").value = x;

                $('form').submit(function(event) {
                    
                    event.preventDefault();

                    var id = $('#id').val();
                    var idpedido = $('#idpedido').val();
                    var idproducto = $('#idproducto').val();
                    var cantidad = $('#cantidad').val();
                    var precio = $('#precio').val();

                    if(id != "" && idpedido != '' && idproducto != "" && precio != "" && cantidad != ""){
    
                                var formData = new FormData;
    
                                formData.append('id',id);                                
                                formData.append('idpedido',idpedido);  
                                formData.append('idproducto',idproducto);  
                                formData.append('cantidad',cantidad);  
                                formData.append('precio',precio);  

                                $.ajax({

                                    url: 'editarpp.php',
                                    type: 'POST',
                                    data: formData,
                                    contentType: false,
                                    processData: false,

                                    success: function(respuesta){
                                        alert(respuesta);
                                        window.location.href = 'http://localhost/alanphp/bppi/ppi/backPedidosProductos/listado/';
                                    },
                                    error:function(jqXHR, textStatus, errorThrown){
                                        console.log(textStatus, errorThrown);
                                    }
                                })

                            

                     }else{
                        $('#rellenarCampos').show();
                        setTimeout(function(){
                        $('#rellenarCampos').hide();
                        },5000);
                    }
                });
            });
        </script>

<div class="opcionesContenedor">

<a href="http://localhost/alanphp/bppi/ppi/login/bienvenido.php" class="opcion">INICIO</a>
<a href="http://localhost/alanphp/bppi/ppi/b2/" class="opcion">EMPLEADOS</a>
<a href="http://localhost/alanphp/bppi/ppi/backProductos/listado/" class="opcion">PRODUCTO</a>
<a href="http://localhost/alanphp/bppi/ppi/backPedidos/listado/" class="opcion">PEDIDOS</a>
<a href="http://localhost/alanphp/bppi/ppi/backBanners/listado/" class="opcion">BANNERS</a>

</div>

<form>
            <label for="id">id </label><br>
            <input type="number" id="id" name="id"><br>

            <label for="idpedido">id pedido</label><br>
            <input type="number" id="idpedido" name="idpedido"><br>

            <label for="idproducto">id producto</label><br>
            <input type="number" id="idproducto" name="idproducto"><br>

            <label for="cantidad">cantidad</label><br>
            <input type="number" id="cantidad" name="cantidad"><br>

            <label for="precio">precio</label><br>
            <input type="number" id="precio" name="precio"><br>
            
            <input type="submit" value="Enviar">
</form> 

<div id="rellenarCampos" style="display: none;">No estan llenos los campos</div>

<a class="botonlistado" href="http://localhost/alanphp/bppi/ppi/backPedidosProductos/listado"><button>LISTADO</button></a>

</body>
</html>