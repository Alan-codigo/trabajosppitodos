<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function(){

                $('form').submit(function(event) {
                    
                    event.preventDefault();

                    var idpedido = $('#idpedido').val();              
                    var idproducto = $('#idproducto').val();
                    var cantidad = $('#cantidad').val();
                    var precio = $('#precio').val();

                    if(idpedido != '' && idproducto != "" && cantidad != "" && precio != ""){
    
                    var formData = new FormData;
    
                    formData.append('idpedido',idpedido);
                    formData.append('idproducto',idproducto);
                    formData.append('cantidad',cantidad);
                    formData.append('precio',precio);

                                
                    $.ajax({
                        url: 'alta.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,

                        success: function(respuesta){
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
</head>
<body>

<div class="opcionesContenedor">
<a href="http://localhost/alanphp/bppi/ppi/login/bienvenido.php" class="opcion">INICIO</a>
<a href="http://localhost/alanphp/bppi/ppi/b2/" class="opcion">EMPLEADOS</a>
<a href="http://localhost/alanphp/bppi/ppi/backProductos/listado/" class="opcion">PRODUCTO</a>
<a href="http://localhost/alanphp/bppi/ppi/backPedidos/listado/" class="opcion">PEDIDOS</a>
<a href="http://localhost/alanphp/bppi/ppi/backBanners/listado/" class="opcion">BANNERS</a>
</div>

<form>
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
<div id="etiquetaExistente" style="display: none;">Ya existe esta etiqueta</div>
<a class="botonlistado" href="http://localhost/alanphp/bppi/ppi/backBanners/listado"><button>REGRESAR</button></a>

</body>
</html>