<!DOCTYPE html>
    <head>
        <title>Mostrar filas </title>
    </head>
    <body>
    <?php

    $filas = $_POST['opciones'];

    echo "<table>";
		echo "<tr><th>ID</th></tr>";
		for ($i = 1; $i <= $filas; $i++) {
			echo "<tr>";
			echo "<td>" . $i . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	
	?>


    </body>
    </html>