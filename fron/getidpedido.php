<?php

$pdo = new PDO('mysql:host=localhost;dbname=empresa', 'root', '');

$username = $_POST['usuario'];

// Selección de los datos que deseas mostrar
$sql = "SELECT * FROM pedidos WHERE usuario = :usuario AND status = 0";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':usuario', $username);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verificar si se encontraron datos
if (empty($data)) {
  $response = "no encontrado";
} else {
  $response = $data;
}

// Envío de los datos o el mensaje como respuesta
echo json_encode($response);

?>
