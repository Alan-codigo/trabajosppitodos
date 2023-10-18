<?php
// Conexión a la base de datos
$pdo = new PDO('mysql:host=localhost;dbname=empresa', 'root', '');

// Selección de los datos que deseas mostrar
$sql = "SELECT * FROM productos WHERE eliminado=0";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Envío de los datos como respuesta
echo json_encode($data);
?>