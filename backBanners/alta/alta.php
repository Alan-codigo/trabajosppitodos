<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "empresa";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$etiqueta = $_POST['etiqueta'];

$carpeta = "fotos/";
$nombre_archivo = $_FILES["foto"]["name"];
$nombre_encriptado = md5($nombre_archivo) . "." . pathinfo($nombre_archivo, PATHINFO_EXTENSION);
$archivo = $carpeta . $nombre_encriptado;

if (move_uploaded_file($_FILES["foto"]["tmp_name"], $archivo)) {
    echo "El archivo " . htmlspecialchars($nombre_archivo) . " ha sido subido.";
} else {
    echo "Hubo un error al subir el archivo.";
}

$sql = "INSERT INTO banners (nombre, archivo) VALUES ('$etiqueta', '$nombre_encriptado')";

if ($conn->query($sql) === TRUE) {
    echo "Los datos han sido insertados correctamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>