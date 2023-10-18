<?php

session_start();
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "empresa";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los valores del formulario
$email = $_POST['email'];
$pass = $_POST['password'];

// Consultar si el usuario existe y está activo
$sql = "SELECT * FROM mitabla WHERE correo = '$email' AND status = 1 AND eliminado = 0";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
  // Verificar la contraseña
  $fila = $resultado->fetch_assoc();
  if (password_verify($pass, $fila['pass'])) {

    $_SESSION['username'] = $fila['nombre'];

    echo 'existe'; // El usuario existe y la contraseña es correcta
  } else {
    echo $fila['pass'];
    echo 'contraseña incorrecta';
  }
} else {
  echo 'usuario no encontrado';
}

$conn->close();
?>
