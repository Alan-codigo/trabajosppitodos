<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "empresa";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los valores del formulario y el ID del usuario a actualizar
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$rol = $_POST['rol'];

$pass = password_hash($password, PASSWORD_DEFAULT);

// Guardar la imagen en una carpeta con nombre encriptado
$carpeta = "../altaFoto/fotos/";
$nombre_archivo = $_FILES["foto"]["name"];
$nombre_encriptado = md5($nombre_archivo) . "." . pathinfo($nombre_archivo, PATHINFO_EXTENSION);
$archivo = $carpeta . $nombre_encriptado;

if (move_uploaded_file($_FILES["foto"]["tmp_name"], $archivo)) {
    echo "El archivo " . htmlspecialchars($nombre_archivo) . " ha sido subido.";
} else {
    echo "Hubo un error al subir el archivo.";
}

// Actualizar los datos en la base de datos
$sql = "UPDATE mitabla SET nombre='$nombre', apellidos='$apellido', correo='$correo', pass='$pass', rol='$rol', archivo='$nombre_archivo', archivo_n='$nombre_encriptado' WHERE id=$id;";

if ($conn->query($sql) === TRUE) {
    echo "Los datos han sido actualizados correctamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
