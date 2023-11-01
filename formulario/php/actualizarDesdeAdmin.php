<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);*/

session_start();

if (!isset($_SESSION['correo_usuario'])) {
    header("Location:../FormularioRegistro.html");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Establecer la conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "registros_usuarios");

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Problemas con la conexión: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE Usuario_id = ?");
    if (!$stmt) {
        die("Error en la preparación: " . $conn->error);
    }

    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $primerApellido = $_POST['primer_apellido'];
    $segundoApellido = $_POST['segundo_apellido'];
    $nick = $_POST['nick'];
    $domicilio = $_POST['domicilio'];
    $poblacion = $_POST['poblacion'];
    $provincia = $_POST['provincia'];
    $nif = $_POST['nif'];
    $telefono = intval($_POST['telefono']);

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
                Usuario_numero_telefono = ? 
            WHERE Usuario_id = ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error en la preparación: " . $conn->error);
    }

    // Vincular los parámetros a la consulta
    $stmt->bind_param("ssssssssii", $nombre, $primerApellido, $segundoApellido, $nick, $domicilio, $poblacion, $provincia, $nif, $telefono, $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("Location: editarUsuarios.php");
    } else {
        die("Error al ejecutar la consulta: " . $conn->error);
    }

    // Cerrar el prepared statement y la conexión
    $stmt->close();
    $conn->close();
}
?>
