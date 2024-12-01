<?php
session_start(); // Inicia la sesión para leer mensajes
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cursos</title>
</head>
<body>
    <h1>Registro de Cursos</h1>
    
    <?php
    // Muestra mensajes de error o éxito si existen
    if (isset($_SESSION['error'])) {
        echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']); // Limpia el mensaje de error
    }
    if (isset($_SESSION['success'])) {
        echo "<p style='color: green;'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']); // Limpia el mensaje de éxito
    }
    ?>

    <form action="controlador-curso.php" method="POST">
        <label for="id_usuario">ID Usuario:</label>
        <input type="text" id="id_usuario" name="id_usuario" required><br><br>

        <label for="sexo">Sexo:</label>
        <select name="sexo" required>
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
        <option value="Otro">Otro</option>
        </select>
        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required><br><br>

        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required><br><br>

        <label for="telefono_particular">Teléfono:</label>
        <input type="text" id="telefono_particular" name="telefono_particular" required><br><br>

        <label for="email_particular">Email:</label>
        <input type="email" id="email_particular" name="email_particular" required><br><br>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required><br><br>

        <label for="region_provincia_distrito">Región/Provincia/Distrito:</label>
        <input type="text" id="region_provincia_distrito" name="region_provincia_distrito" required><br><br>

        <button type="submit">Registrar Curso</button>
    </form>
</body>
</html>
