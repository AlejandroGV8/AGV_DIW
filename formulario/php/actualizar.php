<?php
session_start();

if(!isset($_SESSION['correo_usuario'])){
    header("Location:../FormularioRegistro.html");
    exit();
}

// Establecer la conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "registros_usuarios");

// Verificar la conexión
if ($conn->connect_error) {
    die("Problemas con la conexión: " . $conn->connect_error);
}

// Recoger los datos del formulario
$correo = $_SESSION['correo_usuario'];
$nombre = $_POST['nombre'];
$primerApellido = $_POST['primer_apellido'];
$segundoApellido = $_POST['segundo_apellido'];
$nick = $_POST['nick'];
$domicilio = $_POST['domicilio'];
$poblacion = $_POST['poblacion'];
$provincia = $_POST['provincia'];
$nif = $_POST['nif'];
$telefono = $_POST['telefono'];

// Crear la consulta SQL preparada
$sql = "UPDATE usuarios 
        SET Usuario_nombre = ?, 
            Usuario_apellido1 = ?, 
            Usuario_apellido2 = ?, 
            Usuario_nick = ?, 
            Usuario_domicilio = ?, 
            Usuario_poblacion = ?, 
            Usuario_provincia = ?, 
            Usuario_nif = ?, 
            Usuario_telefono = ? 
        WHERE Usuario_email = ?";

$stmt = $conn->prepare($sql);

// Vincular los parámetros a la consulta
$stmt->bind_param("ssssssssis", $nombre, $primerApellido, $segundoApellido, $nick, $domicilio, $poblacion, $provincia, $nif, $telefono, $correo);

// Ejecutar la consulta
if($stmt->execute()) {
    header('Location:logeo.php');
} else {
    die("Error al preparar la consulta: " . $conn->error);
}

// Cerrar el prepared statement y la conexión
$stmt->close();
$conn->close();
?>