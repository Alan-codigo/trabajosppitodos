<?php

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$pass = $_POST['pass'];
$rol = $_POST['rol'];

//ENCRIPTACION DE PASSWORD
$pass = password_hash($pass, PASSWORD_DEFAULT);

// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "empresa");

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Error al conectar a la base de datos: " . $conexion->connect_error);
}

// Preparar el comando SQL para insertar los datos
$sql = "INSERT INTO mitabla (nombre, apellidos, correo, pass, rol) VALUES (?, ?, ?, ?, ?)";
$sentencia = $conexion->prepare($sql);
$sentencia->bind_param("ssssi", $nombre, $apellidos, $correo, $pass, $rol);

// Ejecutar el comando SQL
if ($sentencia->execute()) {
    // Aquí puedes agregar código
} else {
    echo "Error al guardar los datos: " . $sentencia->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();

?>
