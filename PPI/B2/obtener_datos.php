<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estructuraadmi";

// Crea la conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verifica la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Realiza la consulta para obtener los datos actualizados
$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conn, $sql);

// Crea un array para almacenar los registros
$registros = [];

// Agrega cada registro al array como un objeto con sus propiedades
while ($fila = mysqli_fetch_assoc($resultado)) {

    // Utilizar una estructura condicional para mostrar el texto deseado según el valor del campo "rol"
    if ($fila["rol"] == 1) {
        $rol_texto = 'Gerente';
    } elseif ($fila["rol"] == 2) {
        $rol_texto = 'Ejecutivo';
    } else {
        $rol_texto = 'Desconocido';
    }

    // Agrega el registro al array como un objeto con sus propiedades
    $registros[] = [
        'id' => $fila["id"],
        'nombre' => $fila["nombre"] . " " . $fila["apellidos"],
        'correo' => $fila["correo"],
        'rol_texto' => $rol_texto,
    ];
}

// Devuelve los registros en formato JSON
echo json_encode($registros);

// Cierra la conexión
mysqli_close($conn);
?>