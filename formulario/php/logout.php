<?php
session_start();

// Elimina todas las variables de sesión
$_SESSION = array();

// Destruye la sesión
session_destroy();

// Redirige al usuario a la página de inicio o de inicio de sesión
header("Location:../FormularioRegistro.html");
exit();
?>