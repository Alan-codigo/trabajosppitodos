

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN CLIENTE</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">

    <script>

$(document).ready(function() {
  $('#login-form').submit(function(event) {

    event.preventDefault(); // Prevenir que el formulario se envíe normalmente

    // Obtener los valores del formulario
    var mail = $('#email').val();
    var password = $('#password').val();
 
    if (mail != "" && password != "") {
    // El formulario está completo
    $.ajax({
      url: 'verificaCliente.php',
      type: 'post',
      data: { mail: mail, password: password},
      success: function(response) {
      console.log(response);

        if (response === 'existe') {
          window.location.href = 'home.php'; // Redirigir a la página de bienvenida
        }else{
          $('#error-msg').text('Usuario no encontrado').show();
        }
      },
      error: function() {
        $('#error-msg').text('Error al conectar con el servidor').show();
      }
    });

    } else {
      // El formulario no está completo
      $('#error-msg').text('Por favor, ingrese su email y contraseña').show();
    }
  });
});


    </script>
</head>
<body>

  
  <div class="centrado">
    
    <div class="contenidoLogin">
    <h1> LOGIN </h1>
    <a href="usuarios/"><h1>crear sesion</h1></a>
    <div class="formulariocontenedor">

      <form id="login-form" action="#" method="post">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" >
      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password" >
      <button type="submit" id="submit-btn">Iniciar sesión</button>
      </form>
      

      <div id="error-msg" style="display: none;"></div>
    </div>
  </div>

</div>

</body>
</html>