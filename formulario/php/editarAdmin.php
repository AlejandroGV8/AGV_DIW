<?php
session_start();
if (!isset($_SESSION['correo_usuario'])) {
    header("Location:../FormularioRegistro.html");
    exit();
}

$conn = new mysqli("localhost", "root", "", "registros_usuarios");
if ($conn->connect_error) {
    die("Problemas con la conexión: " . $conn->connect_error);
}

$correo = $_SESSION['correo_usuario'];
$sql = "SELECT * FROM usuarios WHERE Usuario_email = '$correo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $fila = $result->fetch_assoc();
    $nombre = $fila['Usuario_nombre'];
    $primerApellido = $fila['Usuario_apellido1'];
    $segundoApellido = $fila['Usuario_apellido2'];
    $nick = $fila['Usuario_nick'];
    $domicilio = $fila['Usuario_domicilio'];
    $poblacion = $fila['Usuario_poblacion'];
    $provincia = $fila['Usuario_provincia'];
    $nif = $fila['Usuario_nif'];
    $telefono = $fila['Usuario_numero_telefono'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Formulario.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Editar Perfil</title>
</head>

<body>
    <header>
        <div class="bienvenida">
            Bienvenido/a <?php echo $_SESSION['correo_usuario']; ?>
        </div>
        <div class="acciones">
            <a href="logout.php">
                <button class="cerrar-sesion">Cerrar sesión</button>
            </a>
            <a href="paginaAdmin.php">
                <button class="volver">volver</button>
            </a>
        </div>
    </header>

    <div class="editar-perfil-formulario">
        <h2>Editar perfil</h2>
        <form method="post" action="./actualizar.php" enctype="multipart/form-data">

            /* readonly disabled: para mostar algun campo y hacerlo no editable */

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>">

            <label for="primer_apellido">Primer Apellido:</label>
            <input type="text" id="primer_apellido" name="primer_apellido" value="<?php echo $primerApellido; ?>">

            <label for="segundo_apellido">Segundo Apellido:</label>
            <input type="text" id="segundo_apellido" name="segundo_apellido" value="<?php echo $segundoApellido; ?>">

            <label for="nick">Nick:</label>
            <input type="text" id="nick" name="nick" value="<?php echo $nick; ?>">

            <label for="domicilio">Domicilio:</label>
            <input type="text" id="domicilio" name="domicilio" value="<?php echo $domicilio; ?>">

            <label for="poblacion">Población:</label>
            <input type="text" id="poblacion" name="poblacion" value="<?php echo $poblacion; ?>">

            <label for="provincia">Provincia:</label>
            <input type="text" id="provincia" name="provincia" value="<?php echo $provincia; ?>">

            <label for="nif">NIF:</label>
            <input type="text" id="nif" name="nif" value="<?php echo $nif; ?>">

            <label for="telefono">Número de Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" value="<?php echo $telefono; ?>">

            <input type="submit" value="Guardar">
        </form>
    </div>
</body>

</html>