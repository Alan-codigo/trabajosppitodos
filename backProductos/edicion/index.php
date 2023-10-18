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
                    var nombre = $('#nombre').val();
                    var codigo = $('#codigo').val();
                    var descripcion = $('#descripcion').val();
                    var costo = $('#costo').val();
                    var stock= $('#stock').val();
                    var foto = $('#foto').val();

                    if(nombre != '' && codigo != "" && descripcion != "" && costo != "" && stock != ""){
    
                        $.post("../alta/codigo.php", {codigo,codigo}, function(data){
                            if(data != ""){
                                document.getElementById("codigoExistente").innerHTML = " No podemos mandar un formulario con este codigo " + data;
                                $('#codigoExistente').show();
                                setTimeout(function(){
                                $('#codigoExistente').hide();
                                }, 5000);
                            }else{
                                
                                var formData = new FormData;
    
                                formData.append('id',id);                                
                                formData.append('nombre',nombre);
                                formData.append('codigo',codigo);
                                formData.append('descripcion',descripcion,);
                                formData.append('costo',costo);
                                formData.append('stock',stock);
                                formData.append('foto', $('#foto')[0].files[0]);


                                alert(nombre);
                                
                                $.ajax({

                                    url: 'editarproducto.php',
                                    type: 'POST',
                                    data: formData,
                                    contentType: false,
                                    processData: false,

                                    success: function(respuesta){
                                        window.location.href = 'http://localhost/alanphp/bppi/ppi/backProductos/listado/';
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

    <label for="nombre">Nombre:</label><br>
    <input type="text" id="nombre" name="nombre"><br>

    <label for="codigo">codigo:</label><br>
    <input type="text" id="codigo" name="codigo"><br>

    <label for="descripcion">descripcion</label><br>
    <input type="text" id="descripcion" name="descripcion"><br>
            
    <label for="costo">Costo:</label><br>
    <input type="number" id="costo" name="costo"><br>

    <label for="stock">stock:</label><br>
    <input type="number" id="stock" name="stock"><br>

    <label for="foto">Foto:</label>
    <input type="file" id="foto" name="foto" accept="image/*">
            
    <input type="submit" value="Enviar">

</form>

<div id="rellenarCampos" style="display: none;">No estan llenos los campos</div>
<div id="codigoExistente" style="display: none;">Ya existe ese codigo</div>

<a class="botonlistado" href="http://localhost/alanphp/bppi/ppi/backProductos/listado"><button>LISTADO</button></a>

</body>
</html>