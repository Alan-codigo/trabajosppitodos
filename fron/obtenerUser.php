<?php

session_start();

// Verificar si la sesión y el nombre de usuario están definidos
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  echo "$username";
} else {
  echo "No se ha iniciado sesión.";
}
?>