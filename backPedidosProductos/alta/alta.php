<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "empresa";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$idpedido = $_POST['idpedido'];
$idproducto = $_POST['idproducto'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];


$sql = "INSERT INTO pedidos_productos (id_pedido, id_producto,cantidad,precio) VALUES ('$idpedido', '$idproducto','$cantidad','$precio')";

if ($conn->query($sql) === TRUE) {
    echo "Los datos han sido insertados correctamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>