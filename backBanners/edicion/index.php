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


            $(document).ready(function(){

                            verificarSesion();

                const urlParams = new URLSearchParams(window.location.search);
                const x = urlParams.get('id');
                document.getElementById("id").value = x;

                $('form').submit(function(event) {
                    
                    event.preventDefault();

                    var id = $('#id').val();
                    var etiqueta = $('#etiqueta').val();
                    var foto = $('#foto').val();

                    if(id != "" && etiqueta != '' ){
    
                        $.post("../alta/etiqueta.php", {etiqueta,etiqueta}, function(data){
                            if(data != ""){
                                document.getElementById("etiquetaExistente").innerHTML = " No podemos mandar un formulario con esta estiqueta " + data;
                                $('#etiquetaExistente').show();
                                setTimeout(function(){
                                $('#etiquetaExistente').hide();
                                }, 5000);
                            }else{
                                
                                var formData = new FormData;
    
                                formData.append('id',id);                                
                                formData.append('etiqueta',etiqueta);
                                formData.append('foto', $('#foto')[0].files[0]);

                                $.ajax({

                                    url: 'editarbanners.php',
                                    type: 'POST',
                                    data: formData,
                                    contentType: false,
                                    processData: false,

                                    success: function(respuesta){
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

    <label for="etiqueta">Etiqueta</label><br>
    <input type="text" id="etiqueta" name="etiqueta"><br>

    <label for="foto">Foto:</label>
    <input type="file" id="foto" name="foto" accept="image/*">
            
    <input type="submit" value="Enviar">

</form>

<div id="rellenarCampos" style="display: none;">No estan llenos los campos</div>
<div id="etiquetaExistente" style="display: none;">Ya existe esta etiqueta</div>

<a class="botonlistado" href="http://localhost/alanphp/bppi/ppi/backBanners/listado"><button>LISTADO</button></a>

</body>
</html>