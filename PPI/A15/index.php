<!DOCTYPE html>
<html>
<head>
	<title>500 Opciones</title>
</head>
<body>
    <!-- Creacion de un formulario que muestre un select y que ese select muestre 5000 opciones
    lo mandamos a procesar php con action
    hacemos el formulario normar en html lo unico que cambia es que se mostraran 5000 ociones con el for de 1 hasta 5000
-->
	<form name="formopc" method="post" action="procesar.php" onsubmit="return valida()">
		<label for="opciones">Selecciona una opción:</label>
		<select name="opciones" id="opciones">
			<?php
				echo "<option value=0>selecciona</option>";
			for ($i=1; $i<=5000; $i++) {
				echo "<option value='$i'>$i</option>";
			}
			?>
		</select>

		<input type="submit" name="submit" value="Enviar">
	</form>

    <script>

        function valida(){    
            var valida = document.formopc.opciones.value;
            if (valida == 0) {
                alert("Por favor, llene todos los campos");
                return false;
            } else {
                return true;
            }
        }
        
    </script>
</body>
</html>
