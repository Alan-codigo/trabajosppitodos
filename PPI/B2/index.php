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

// Realiza la consulta para obtener los datos de la tabla usuarios
$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <style>
        .tablaadmi{
            height: 100%;
            width: 100%;
            border: 2px solid black;
        }

        td{
            border: 2px solid black;
        }
    </style>



    <title>B2</title>
    <script src="./jquery-3.3.1.min.js"></script>
</head>
<body>
    <table class="tablaadmi">
        <tr>
            <td colspan="5">LISTADO DE EMPLEADOS</td>
        </tr>
        <tr>
            <td>ID</td>
            <td>NOMBRE</td>
            <td>CORREO</td>
            <td>ROL</td>
            <td>BOTON</td>
        </tr>

        <?php
        // Imprime los registros en la tabla HTML utilizando un bucle while
        while ($fila = mysqli_fetch_assoc($resultado)) {

            $rol = $fila["rol"];
    
            // Utilizar una estructura condicional para mostrar el texto deseado según el valor del campo "rol"
            if ($rol == 1) {
                $rol_texto = 'Gerente';
            } elseif ($rol == 2) {
                $rol_texto = 'Ejecutivo';
            } else {
                $rol_texto = 'Desconocido';
            }


            echo "<tr>";
            echo "<td>" . $fila["id"] . "</td>";
            echo "<td>" . $fila["nombre"] . " " . $fila["apellidos"] . "</td>";
            echo "<td>" . $fila["correo"] . "</td>";
            echo '<td>' . $rol_texto . '</td>';

            echo '<td><button onclick="editar(' . $fila["id"] . ')">editar</button></td>';
            
            echo "</tr>";
        }
        ?>

    </table>

    <script src="main.js"></script>
</body>
</html>
