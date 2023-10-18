<?php

$pdo = new PDO('mysql:host=localhost;dbname=empresa', 'root', '');

$idpedido = $_POST['idPedido'];
$idproducto = $_POST['idProducto'];

// Actualizar la cantidad
$query = "UPDATE pedidos_productos SET cantidad = cantidad + 1 WHERE id_pedido = :idpedido AND id_producto = :idproducto";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':idpedido', $idpedido);
$stmt->bindParam(':idproducto', $idproducto);
$stmt->execute();

// Verificar si se realizó la actualización correctamente
if ($stmt->rowCount() > 0) {
    echo "La tabla pedidos_productos ha sido actualizada correctamente.";
} else {
    echo "No se encontró una fila que coincida con los valores proporcionados.";
}
?>
