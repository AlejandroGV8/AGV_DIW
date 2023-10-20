<?php
session_start();

if (!isset($_SESSION['correo_usuario'])) {
    header("Location:../FormularioRegistro.html");
    exit();
}

// Conexion con la base de datos
$conn = new mysqli("localhost", "root", "", "registros_usuarios");

if ($conn->connect_error) {
    die("Problemas con la conexión: " . $conn->connect_error);
}

$query = "SELECT * FROM usuarios WHERE Usuario_email != 'admin@gmail.com'";
$result = $conn->query($query);

if (!$result) {
    die("Error ejecutando la consulta: " . $conn->error);
}

$users = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Formulario.css">
    <title>Editar Usuarios</title>
</head>

<body>
    <header>
        <div class="bienvenida">
            Bienvenido/a <?php echo $_SESSION['correo_usuario']; ?> editar Usuarios
        </div>
        <div class="acciones">
            <a href="editarPerfil.php">
                <button class="editar">Editar perfil</button>
            </a>
            <a href="logout.php">
                <button class="cerrar-sesion">Cerrar sesión</button>
            </a>
            <a href="paginaAdmin.php">
                <button class="volver">volver</button>
            </a>
        </div>
    </header>
    <table border="1" class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido 1</th>
                <th>Apellido 2</th>
                <th>Nick</th>
                <th>Fecha Alta</th>
                <th>Email</th>
                <th>Bloqueado</th>
                <th>Fecha Bloqueo</th>
                <th>Última Conexión</th>
                <th>Domicilio</th>
                <th>Población</th>
                <th>Provincia</th>
                <th>Perfil</th>
                <th>NIF</th>
                <th>Teléfono</th>
                <th>Fecha Contratación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user['Usuario_id'] ?></td>
                    <td><?= $user['Usuario_nombre'] ?></td>
                    <td><?= $user['Usuario_apellido1'] ?></td>
                    <td><?= $user['Usuario_apellido2'] ?></td>
                    <td><?= $user['Usuario_nick'] ?></td>
                    <td><?= $user['Usuario_fecha_alta'] ?></td>
                    <td><?= $user['Usuario_email'] ?></td>
                    <td><?= $user['Usuario_bloqueado'] ? 'Sí' : 'No' ?></td>
                    <td><?= $user['Usuario_fecha_bloqueo'] ?></td>
                    <td><?= $user['Usuario_fecha_ultima_conexion'] ?></td>
                    <td><?= $user['Usuario_domicilio'] ?></td>
                    <td><?= $user['Usuario_poblacion'] ?></td>
                    <td><?= $user['Usuario_provincia'] ?></td>
                    <td><?= $user['Usuario_perfil'] ?></td>
                    <td><?= $user['Usuario_nif'] ?></td>
                    <td><?= $user['Usuario_numero_telefono'] ?></td>
                    <td><?= $user['Usuario_fecha_contratacion'] ?></td>
                    <td>
                        <a class="admin-actions" href="editarPerfil.php?id=<?= $user['Usuario_id'] ?>">Modificar</a> |
                        <a class="admin-actions" href="eliminar.php?id=<?= $user['Usuario_id'] ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar a este usuario?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script src="/JS/seguroEliminar.js"></script>
</body>

</html>