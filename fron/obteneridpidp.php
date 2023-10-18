<?php

$pdo = new PDO('mysql:host=localhost;dbname=empresa', 'root', '');

$idpedido = $_POST['idpe'];
$idproducto = $_POST['idpr'];
$precio = $_POST['costo'];

// Selección de los datos que deseas mostrar
$sql_select = "SELECT * FROM pedidos_productos WHERE id_pedido = :id_pedido AND id_producto = :id_producto";
$stmt_select = $pdo->prepare($sql_select);
$stmt_select->bindParam(':id_pedido', $idpedido);
$stmt_select->bindParam(':id_producto', $idproducto);
$stmt_select->execute();
$data = $stmt_select->fetchAll(PDO::FETCH_ASSOC);

// Verificar si se encontraron datos
if (empty($data)) {
  // Ejecutar consulta de inserción
  $sql_insert = "INSERT INTO pedidos_productos (id_pedido, id_producto, cantidad, precio) VALUES (:id_pedido, :id_producto, 1, :precio)";
  $stmt_insert = $pdo->prepare($sql_insert);
  $stmt_insert->bindParam(':id_pedido', $idpedido);
  $stmt_insert->bindParam(':id_producto', $idproducto);
  $stmt_insert->bindParam(':precio', $precio);
  $stmt_insert->execute();
  
  $response = "Inserción realizada correctamente";
} else {
  $response = $data;
}

// Envío de los datos o el mensaje como respuesta
echo json_encode($response);

?>
