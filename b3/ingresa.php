<?php
$nombre = $_POST['nombre'];
$apellido = $_POST['apellidos'];
$correo = $_POST['correo'];
$contrasenia = $_POST['password'];
$rol = $_POST['rol'];

//ENCRIPTACION DE PASSWORD
$contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);

// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "empresa");

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Error al conectar a la base de datos: " . $conexion->connect_error);
}

// Preparar el comando SQL para insertar los datos
$sql = "INSERT INTO mitabla (nombre, apellidos, correo, pass, rol) VALUES (?, ?, ?, ?, ?)";
$sentencia = $conexion->prepare($sql);
$sentencia->bind_param("sssss", $nombre, $apellido, $correo, $contrasenia, $rol);

// Ejecutar el comando SQL
if ($sentencia->execute()) {
    // Aquí puedes agregar código
} else {
    echo "Error al guardar los datos: " . $sentencia->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
