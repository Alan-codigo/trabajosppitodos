<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "empresa";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_POST['id'];
$usuario = $_POST['usuario'];
$fecha = $_POST['fecha'];
$status = $_POST['status'];


$sql = "UPDATE pedidos SET usuario='$usuario', status='$status', fecha='$fecha' WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
    echo "Los datos han sido insertados correctamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>