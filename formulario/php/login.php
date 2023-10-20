<?php
session_start();
$conn = new mysqli("localhost", "root", "", "registros_usuarios");

if (!$conn) {
    die("Problemas con la conexión: " . mysqli_connect_error());
}

// Variable donde almacenamos el correo y la contraseña
$contrasñaHash;
$correo = $_POST['correo'];
$contraseña = $_POST['password'];
//Consulta para buscar el correo
$sql = "SELECT * FROM usuarios WHERE Usuario_email = '" . $correo . "'";

$result = $conn->query($sql);

// Si al ejecutar la query da fallo
if (!$conn->query($sql)) {
    die("Error al ejecutar consulta: ");
}

// A partir de aqui falla
if($result->num_rows > 0) {
    

    // Consulta para buscar la contraseña y comprobar que es correcta
    $sqlPsw = "SELECT * FROM usuarios WHERE Usuario_email = '" .$correo. "'";
    $resultPsw = $conn->query($sqlPsw);

     if($resultPsw->num_rows > 0){
        $fila = mysqli_fetch_assoc($resultPsw);
        $clave = $fila['Usuario_clave'];
        if(password_verify($contraseña, $clave)){
            $_SESSION['correo_usuario'] = $correo;
            header('Location:logeo.php');

        } else {
            echo "La contraseña o usuario no coincide";
        }
        
     }


} else{
    echo "No hay nada";
}
$result->close();

mysqli_close($conn);
?>