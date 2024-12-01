<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
   <link href="https://tresplazas.com/web/img/big_punto_de_venta.png" rel="shortcut icon">
   <title>Inicio de sesión</title>
</head>

<body>
   <img class="wave" src="https://static.vecteezy.com/system/resources/previews/017/504/043/non_2x/bodybuilding-emblem-and-gym-logo-design-template-vector.jpg">
   <div class="container">
      <div class="img"></div>
      <div class="login-content">
         <form method="post" action="login.php">
            <img src="img/logo.jpg">
            <h2 class="title">BIENVENIDO</h2>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
               include("modelo/conexion_bd.php");

               $usuario = htmlspecialchars($_POST['usuario']);
               $password = $_POST['password'];

               // Consulta para obtener la contraseña encriptada
               $stmt = $conexion->prepare("SELECT clave FROM usuarios WHERE usuario = ?");
               $stmt->bind_param("s", $usuario);
               $stmt->execute();
               $stmt->store_result();

               if ($stmt->num_rows > 0) {
                  $stmt->bind_result($clave_encriptada);
                  $stmt->fetch();

                  // Verifica la contraseña
                  if (password_verify($password, $clave_encriptada)) {
                     // Redirige al usuario a cursos.html
                     header("Location: cursos.html");
                     exit; // Termina la ejecución del script después de la redirección
                  } else {
                     echo "<div class='alert alert-danger'>La contraseña es incorrecta.</div>";
                  }
               } else {
                  echo "<div class='alert alert-danger'>El usuario no existe.</div>";
               }

               $stmt->close();
               $conexion->close();
            }
            ?>
            <div class="input-div one">
               <div class="i">
                  <i class="fas fa-user"></i>
               </div>
               <div class="div">
                  <h5>Usuario</h5>
                  <input id="usuario" type="text" class="input" name="usuario" required>
               </div>
            </div>
            <div class="input-div pass">
               <div class="i">
                  <i class="fas fa-lock"></i>
               </div>
               <div class="div">
                  <h5>Contraseña</h5>
                  <input type="password" id="input" class="input" name="password" required>
               </div>
            </div>
            <div class="view">
               <div class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></div>
            </div>

            <div class="text-center">
               <a class="font-italic isai5" href="#">Olvidé mi contraseña</a>
               <a class="font-italic isai5" href="registro.php">Registrarse</a>
            </div>
            <input name="btningresar" class="btn" type="submit" value="INICIAR SESIÓN">
         </form>
      </div>
   </div>
   <script src="js/fontawesome.js"></script>
   <script src="js/main.js"></script>
   <script src="js/main2.js"></script>
   <script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.js"></script>
   <script src="js/bootstrap.bundle.js"></script>
</body>

</html>
