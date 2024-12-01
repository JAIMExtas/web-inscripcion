<?php
if (!empty($_POST["btningresar"])) {
    if (empty($_POST["usuario"]) || empty($_POST["password"])) {
        echo '<div class="alert alert-danger">LOS CAMPOS ESTÁN VACÍOS</div>';
    } else {
        $usuario = $_POST["usuario"];
        $clave = $_POST["password"];

        // Preparamos la consulta para evitar inyecciones SQL
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = ? AND clave = ?");
        $stmt->bind_param("ss", $usuario, $clave);
        $stmt->execute();

        // Obtenemos los resultados
        $resultado = $stmt->get_result();
        if ($datos = $resultado->fetch_object()) {
            header("Location:cursos.html"); // Redirige al usuario a la página de inicio
            exit; // Asegúrate de detener la ejecución después de redirigir
        } else {
            echo '<div class="alert alert-danger">Acceso denegado</div>';
        }
    }
}
?>
