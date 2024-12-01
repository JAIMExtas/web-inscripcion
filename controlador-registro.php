<?php
include 'modelo/conexion_bd.php'; // Incluye la conexión

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']);
    $usuario = htmlspecialchars($_POST['usuario']);
    $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT);

    $stmt = $conexion->prepare("SELECT id_usuario FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "El nombre de usuario ya está registrado. <a href='registro.php'>Volver al registro</a>";
    } else {
        $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellido, usuario, clave) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $apellido, $usuario, $clave);

        if ($stmt->execute()) {
            // Guarda el id_usuario en la sesión
            session_start();
            $_SESSION['id_usuario'] = $conexion->insert_id; // Obtiene el último ID generado

            // Redirige al formulario para registrar un curso
            header("Location: formulario_curso.php");
            exit;
        } else {
            echo "Error al registrar el usuario: " . $stmt->error;
        }
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "Método no permitido.";
}
?>
