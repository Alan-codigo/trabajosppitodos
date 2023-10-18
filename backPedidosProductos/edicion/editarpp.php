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
$idpedidos = $_POST['idpedido'];
$idproductos = $_POST['idproducto'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];

$sql = "UPDATE pedidos_productos SET id_pedido = '$idpedidos', id_producto ='$idproductos', cantidad = '$cantidad', precio = '$precio' WHERE id = '$id'"; 


if ($conn->query($sql) === TRUE) {
    echo "Los datos han sido insertados correctamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>