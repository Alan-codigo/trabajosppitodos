

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
      .centrado {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 80vh;
        background-color: white;
      }

      .contenido{
        width: 50%;
        height: 50%;
        background-color: gray;
        border-radius: 50px;
        border: 3px solid black;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .formulariocontenedor{

      }

      h1{
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      
    </style>

    <script>

$(document).ready(function() {
    verificarSesion();
});

function verificarSesion() {
    $.get('verificar_sesion.php', function(data) {
        if (data == 'true') {
            // El usuario tiene una sesión abierta
            window.location.href = 'bienvenido.php';
        } else {
            // El usuario no tiene una sesión abierta
        }
    });
}


$(document).ready(function() {
  $('#login-form').submit(function(event) {

    event.preventDefault(); // Prevenir que el formulario se envíe normalmente

    // Obtener los valores del formulario
    var email = $('#email').val();
    var password = $('#password').val();

    
    if (email != "" || password != "") {
    // El formulario está completo
    $.ajax({
      url: 'verifica.php',
      type: 'post',
      data: { email: email, password: password },
      success: function(response) {
      console.log(response);

        if (response === 'existe') {
          window.location.href = 'bienvenido.php'; // Redirigir a la página de bienvenida
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

  
  <h1> LOGIN </h1>
  <div class="centrado">
    
  <div class="contenido">
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