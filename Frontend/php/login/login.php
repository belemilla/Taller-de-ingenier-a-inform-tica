<?php
include("../conexion.php");
session_start();

if (!empty($_POST["btningresar"])) {
    if (empty($_POST["user"]) || empty($_POST["pass"])) {
        $mensaje = "Error: Todos los campos son obligatorios.";
    } else {
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $consulta = pg_query_params($conn, "SELECT * FROM Huesped WHERE Nombre = CAST($1 AS TEXT) AND clave = md5($2)", array($user, $pass));

        if ($consulta && pg_num_rows($consulta) > 0) {
            $_SESSION['usuario'] = $user;
            header("Location:../../pages/index.html");
            exit();
        } else {
            $mensaje = "Error: Usuario y Clave no Registrados.";
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
    <section>
        <div class="formulario">
            <h1>Inicio de Sesión</h1>

            <?php if (!empty($mensaje)) : ?>
                <div class="alert alert-danger"><?= $mensaje ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="username">
                    <input type="text" name="user" required />
                    <label>Nombre de Usuario</label>
                </div>
                <div class="username">
                    <input type="password" name="pass" required />
                    <label>Clave Usuario</label>
                </div>
                <input name="btningresar" type="submit" value="Iniciar" />
                <div class="registrarse">
                    Quiero hacer el <a href="registro.php">registro</a>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
