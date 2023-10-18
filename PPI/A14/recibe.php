<!DOCTYPE html>
<head>
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<?PHP 
echo "El nombre es ";
echo $_POST["nombre"];
echo "<br>";
echo "El correo es ";
echo $_POST["correo"];
echo "<br>";
echo "El sexo es ";
if( $_POST["sexo"] == "F" ) echo "FEMENUNO";
if( $_POST["sexo"] == "M" ) echo "MASCULINO";
echo "<br>";
echo "Quiere boletion?";
if (0 == $_POST["boletin"]) echo "no";
if (1 == $_POST["boletin"]) echo "si";
echo "<br>";
echo "El Comentario es ";
echo $_POST["comentario"];
echo "<br>";
echo "Esta en la carrera de ";
if (1 == $_POST["carrera"]) echo "ING INFORMATICA";
if (2 == $_POST["carrera"]) echo "ING COMPUTACION";
echo "<br>";
echo "Contrasenia ";
echo $_POST["pasw"];
echo "<br>";
echo "El promedio es ";
echo $_POST["promedio"];
echo "<br>";
echo "La fecha es  ";
echo $_POST["fecha"];
?>  
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
