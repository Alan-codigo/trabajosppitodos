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

                    var fecha = $('#fecha').val();
                    var usuario = $('#usuario').val();

                    if(fecha != '' && usuario != ""){
    
                        $.post("usuario.php", {usuario,usuario}, function(data){
                            if(data != ""){
                                document.getElementById("usuarioExistente").innerHTML = " No podemos mandar un formulario con esta etiqueta " + data;
                                $('#usuarioExistente').show();
                                setTimeout(function(){
                                $('#usuarioExistente').hide();
                                }, 5000);
                            }else{
                                
                                var formData = new FormData;
    
                                formData.append('usuario',usuario); 
                                formData.append('fecha',fecha);
                                
                                $.ajax({

                                    url: 'alta.php',
                                    type: 'POST',
                                    data: formData,
                                    contentType: false,
                                    processData: false,

                                    success: function(respuesta){
                                        console.log(respuesta);
                                        window.location.href = 'http://localhost/alanphp/bppi/ppi/backBanners/listado/';
                                    },
                                    error:function(jqXHR, textStatus, errorThrown){
                                        console.log(textStatus, errorThrown);
                                    }
                                })

                            }
                        });
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
            <label for="fecha">fecha</label><br>
            <input type="date" id="fecha" name="fecha"><br>

            <label for="usuario">usuario</label><br>
            <input type="text" id="usuario" name="usuario"><br>
            
            <input type="submit" value="Enviar">
</form> 


<div id="rellenarCampos" style="display: none;">No estan llenos los campos</div>
<div id="usuarioExistente" style="display: none;">Ya existe un pedido en proceso</div>
<a class="botonlistado" href="http://localhost/alanphp/bppi/ppi/backPedidos/listado"><button>REGRESAR</button></a>

</body>
</html>