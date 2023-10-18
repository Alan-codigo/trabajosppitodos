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
                    var usuario = $('#usuario').val();
                    var status = $('#status').val();
                    var fecha = $('#fecha').val();

                    if(id != "" && usuario != '' && fecha != '' && status != '' ){
    
                        $.post("../alta/usuario.php", {usuario,usuario}, function(data){
                            if(data != ""){
                                document.getElementById("usuarioExistente").innerHTML = " No podemos mandar un formulario con este  " + data;
                                $('#usuarioExistente').show();
                                setTimeout(function(){
                                $('#usuarioExistente').hide();
                                }, 5000);
                            }else{
                                
                                var formData = new FormData;
    
                                formData.append('id',id);  
                                formData.append('status',status);  
                                formData.append('usuario',usuario);
                                formData.append('fecha',fecha);


                                $.ajax({

                                    url: 'editarpedido.php',
                                    type: 'POST',
                                    data: formData,
                                    contentType: false,
                                    processData: false,

                                    success: function(respuesta){
                                        window.location.href = 'http://localhost/alanphp/bppi/ppi/backPedidos/listado/';
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

<div class="opcionesContenedor">

<a href="http://localhost/alanphp/bppi/ppi/login/bienvenido.php" class="opcion">INICIO</a>
<a href="http://localhost/alanphp/bppi/ppi/b2/" class="opcion">EMPLEADOS</a>
<a href="http://localhost/alanphp/bppi/ppi/backProductos/listado/" class="opcion">PRODUCTO</a>
<a href="http://localhost/alanphp/bppi/ppi/backPedidos/listado/" class="opcion">PEDIDOS</a>
<a href="http://localhost/alanphp/bppi/ppi/backBanners/listado/" class="opcion">BANNERS</a>

</div>

<form>

    <label for="id">id</label><br>
    <input type="number" id="id" name="id"><br>

    <label for="usuario">usuario</label><br>
    <input type="text" id="usuario" name="usuario"><br>

    <label for="fecha">fecha</label><br>
    <input type="date" id="fecha" name="fecha"><br>

    <label for="status">status</label><br>
    <input type="number" id="status" name="status"><br>
            
    <input type="submit" value="Enviar">

</form>

<div id="rellenarCampos" style="display: none;">No estan llenos los campos</div>
<div id="etiquetaExistente" style="display: none;">Ya existe este usuario</div>

<a class="botonlistado" href="http://localhost/alanphp/bppi/ppi/backPedidos/listado"><button>LISTADO</button></a>

</body>
</html>