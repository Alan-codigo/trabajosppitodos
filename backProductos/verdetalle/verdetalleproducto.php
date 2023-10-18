<?php
// Conexión a la base de datos
$pdo = new PDO('mysql:host=localhost;dbname=empresa', 'root', '');

$id = $_POST['id'];

// Selección de los datos que deseas mostrar
$sql = "SELECT * FROM productos WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Envío de los datos como respuesta
echo json_encode($data);
?>
