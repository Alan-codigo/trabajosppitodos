<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

                $('form').submit(function(event) {
                    
                    event.preventDefault();

                    var etiqueta = $('#etiqueta').val();
                    var foto = $('#foto').val();

                    if(etiqueta != '' && foto != ""){
    
                        $.post("etiqueta.php", {etiqueta,etiqueta}, function(data){
                            if(data != ""){
                                document.getElementById("etiquetaExistente").innerHTML = " No podemos mandar un formulario con esta etiqueta " + data;
                                $('#etiquetaExistente').show();
                                setTimeout(function(){
                                $('#etiquetaExistente').hide();
                                }, 5000);
                            }else{
                                
                                var formData = new FormData;
    
                                formData.append('etiqueta',etiqueta);
                                formData.append('foto', $('#foto')[0].files[0]);
                                
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
            <label for="etiqueta">Etiqueta</label><br>
            <input type="text" id="etiqueta" name="etiqueta"><br>

            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto" accept="image/*">
            
            <input type="submit" value="Enviar">
</form> 


<div id="rellenarCampos" style="display: none;">No estan llenos los campos</div>
<div id="etiquetaExistente" style="display: none;">Ya existe esta etiqueta</div>
<a class="botonlistado" href="http://localhost/alanphp/bppi/ppi/backBanners/listado"><button>REGRESAR</button></a>

</body>
</html>