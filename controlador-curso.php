<?php
require_once 'modelo/conexion_bd.php'; // Incluye el archivo de conexión

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoge los datos del formulario
    $id_usuario = $_POST['id_usuario'];
    $sexo = $_POST['sexo'];
    $edad = $_POST['edad'];
    $dni = $_POST['dni'];
    $telefono_particular = $_POST['telefono_particular'];
    $email_particular = $_POST['email_particular'];
    $direccion = $_POST['direccion'];
    $region_provincia_distrito = $_POST['region_provincia_distrito'];
    $fecha_registro = date('Y-m-d H:i:s'); // Fecha actual

    // Verificar si el DNI ya existe en la base de datos
    $sql_check = "SELECT COUNT(*) FROM cursos WHERE dni = ?";
    $stmt_check = $conexion->prepare($sql_check);
    $stmt_check->bind_param("s", $dni);
    $stmt_check->execute();
    $stmt_check->bind_result($count);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($count > 0) {
        // Si el DNI ya existe, mostrar un mensaje y pedir un nuevo DNI
        echo "El DNI ya está registrado. Por favor, ingresa otro DNI.";
        echo '<br><a href="cursos.html" class="button">Volver a intentar</a>';
    } else {
        // Si el DNI no existe, proceder con la inserción
        $sql = "INSERT INTO cursos (id_usuario, sexo, edad, dni, telefono_particular, email_particular, direccion, region_provincia_distrito, fecha_registro)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepara la consulta
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("isissssss", $id_usuario, $sexo, $edad, $dni, $telefono_particular, $email_particular, $direccion, $region_provincia_distrito, $fecha_registro);

        // Ejecuta la consulta
        if ($stmt->execute()) {
            // Muestra el mensaje y el enlace del botón
            echo "Curso registrado exitosamente.<br>";
            echo '<a href="cursos.html" class="button">Volver a Cursos</a>';
        } else {
            echo "Error: " . $stmt->error;
        }

        // Cierra la conexión
        $stmt->close();
    }

    // Cierra la conexión principal
    $conexion->close();
}
?>
