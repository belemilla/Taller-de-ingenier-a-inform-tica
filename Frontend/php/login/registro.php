<?php
include("../conexion.php");
session_start();


if (!empty($_POST["btnregistrar"])) {
    if (empty($_POST["user"]) ||
    empty($_POST["apellido"]) || 
    empty($_POST["run"]) || 
    empty($_POST["tel"]) || 
    empty($_POST["city"]) || 
    empty($_POST["email"]) || 
    empty($_POST["pass"])) 
        { $mensaje = "Error: Todos los campos son obligatorios.";
    } else {
        // Recuperar datos del formulario
        $user = $_POST['user'];
        $apellido = $_POST['apellido'];
        $run = $_POST['run'];
        $tel = $_POST['tel'];
        $city = $_POST['city'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        // Consulta para insertar el usuario en la base de datos
        $consulta = pg_query_params($conn,"INSERT INTO huesped (nombre, apellido, run, telefono, ciudad, email, clave) VALUES ($1,$2,$3,$4,$5,$6, md5($7))", array($user,$apellido,$run,$tel,$city,$email,$pass));

        if ($consulta) {
            // Registro exitoso: Redirigir a Login.php
            header("Location:Login.php");
            exit();
        } else {
            // Error al registrar el usuario
            echo '<div class="alert alert-danger">Error: No se pudo registrar el usuario. ' . pg_last_error($link) . '</div>';
        }
    }
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
  <link rel="stylesheet" href="../../css/login.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

    <!-------Formulario ---------->
    <section>
        <div class="formulario">
            <h1>Registro de Usuario</h1>

            <?php if (!empty($mensaje)) : ?>
                <div class="alert alert-danger"><?= $mensaje ?></div>
            <?php endif; ?>

            <form method="post">
            <!-------usuario---------->
            <div class="username">
                <input type="text" name="user" required />
                <label>Nombre de Usuario</label>
            </div>
            <!-------Apellido---------->
                <div class="username">
                <input type="text" name="apellido" required />
                <label>Apellido de Usuario</label>
            </div>
            <!-------rut---------->
            <div class="username">
                <input type="text" name="run" required />
                <label>Rut de Usuario</label>
            </div>
            <!-------telefono---------->
            <div class="username">
                <input type="text" name="tel" required />
                <label>Telefono</label>
            </div>
            <!-------ciudad---------->
            <div class="username">
                <input type="text" name="city" required />
                <label>Ciudad</label>
            </div>
            <!-------email---------->
            <div class="username">
                <input type="text" name="email" required />
                <label>Email</label>
            </div>
            <!-------contraseña---------->
            <div class="username">
                <input type="password" name="pass" required />
                <label>Contraseña</label>
            </div>
            <!-------boton iniciar---------->
            <input name="btnregistrar" type="submit" value="Registrarse" />
            <!-------registrarse---------->
            <div class="registrarse">
                <a href="login.php">Volver</a>
            </div>
            </form>
        </div>
    </section>

</body>
</html>




