<?php

$usuario = $_POST['usuario'];

// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "empresa");

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Error al conectar a la base de datos: " . $conexion->connect_error);
}

// Preparar el comando SQL para buscar el correo electrónico
$sql = "SELECT * FROM pedidos WHERE usuario = ? AND status =  0";
//$sql = "SELECT * FROM productos WHERE codigo = ?";
$sentencia = $conexion->prepare($sql);
$sentencia->bind_param("s", $usuario);

// Ejecutar el comando SQL
$sentencia->execute();
$resultado = $sentencia->get_result();

// Verificar si se encontró el correo electrónico
if ($resultado->num_rows > 0) {
    // El correo electrónico ya existe en la base de datos
    // Aquí puedes agregar el código para manejar este caso

    echo "$usuario";


} else {

    echo "";

    // El correo electrónico no existe en la base de datos
    // Aquí puedes agregar el código para manejar este caso
}

// Cerrar la conexión a la base de datos
$conexion->close();

?>
