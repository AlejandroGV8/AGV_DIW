<?php
session_start();

if (!isset($_SESSION['correo_usuario'])) {
    header("Location: ../FormularioRegistro.html");
    exit();
}

// Verifica si se ha enviado un ID para eliminar
if (!isset($_GET['id'])) {
    die('ID no proporcionado.');
}

$id = $_GET['id'];

// Conexión con la base de datos
$conn = new mysqli("localhost", "root", "", "registros_usuarios");

if ($conn->connect_error) {
    die("Problemas con la conexión: " . $conn->connect_error);
}

// Preparar la sentencia para eliminar el registro basado en el ID
$stmt = $conn->prepare("DELETE FROM usuarios WHERE Usuario_id = ?");
if(!$stmt){
    die("Error en la preparación: ". $conn->error);
}

$stmt->bind_param("i", $id);  // "i" significa que es un entero

// Ejecuta la sentencia
if ($stmt->execute()) {
    // Redirige de nuevo a la página de edición de usuarios con un mensaje de éxito
    header("Location:editarUsuario.php");
} else {
    die("Error al eliminar el usuario: " . $stmt->error);
}