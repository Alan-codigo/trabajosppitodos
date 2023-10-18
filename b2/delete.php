<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "empresa";

// Crea la conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verifica la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Obtiene el ID del registro a eliminar desde los datos enviados por AJAX
$id = $_POST['id'];

// Ejecuta la consulta SQL DELETE para eliminar el registro
$sql = "DELETE FROM mitabla WHERE id=$id";
mysqli_query($conn, $sql);

// Cierra la conexión
mysqli_close($conn);
?>

