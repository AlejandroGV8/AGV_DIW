<?php
session_start();

if(!isset($_SESSION['correo_usuario'])){
    header("Location:../FormularioRegistro.html");
    exit();
}

// Conexion con la base de datos
$conn = new mysqli("localhost", "root", "", "registros_usuarios");

if ($conn->connect_error) {
    die("Problemas con la conexión: " . $conn->connect_error);
}

$correo = $_SESSION['correo_usuario'];
$sql = "SELECT Usuario_fotografia FROM usuarios WHERE Usuario_email = '$correo'";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>logeo administrador</title>
    <link rel="stylesheet" href="../CSS/Formulario.css">
</head>
<body>
    <header>
        <div class="bienvenida">
            Bienvenido/a administrador <?php echo $_SESSION['correo_usuario']; ?>
        </div>
        <div class="acciones">
            <a href="editarUsuarios.php">
            <button class="editar usuarios">Editar Usuarios</button>
            </a>
            <a href="editarAdmin.php">
            <button class="editar">Editar perfil</button>
            </a>
            <a href="logout.php">
            <button class="cerrar-sesion">Cerrar sesión</button>
            </a>
        </div>
    </header>
</body>
</html>