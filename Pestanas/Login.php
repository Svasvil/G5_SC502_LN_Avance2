<?php

require_once 'conexion.php';
session_start();

// Este bloque procesa el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["IdUsuario"];
    $contrasena = $_POST["contrasena"];

    $mysqli = abrirConexion();

    // Busca el usuario en la base de datos
    $sql = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $row = $resultado->fetch_assoc();
        // Compara la contraseña ingresada con la encriptada
        if (password_verify($contrasena, $row['contrasena'])) {
            $_SESSION['usuario_id'] = $row['id'];
            $_SESSION['rol'] = $row['rol'];
            
            $_SESSION['usuario'] = $row['usuario']; 
            
            header("Location: index.php");
            exit;
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }

    cerrarConexion($mysqli);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Estilos/login.css" rel="stylesheet">
</head>
<body>
<div class="login-container">
    <div class="login-box">

 <img src="../Img/89e80d4a-3e74-4e90-9368-87538123716e_removalai_preview.png" width="200" height="150" alt="Logo">
 <br><br><br><br>

        <h2>Iniciar Sesión</h2>

        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>



        <form method="POST">
            <label for="usuario">usuario</label>
            <input type="text" id="IdUsuario" name="IdUsuario" required>

            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <button type="submit">Ingresar</button>
        </form>
     <p style="text-align:center; margin-top:16px;">
      ¿No tienes cuenta? <a href="signup.php" style="color: var(--edus-light-blue); text-decoration: underline;">Regístrate aquí</a>
    </p>
    </div>
   
</div>
</body>
    <footer class="footer py-4">
        <div class="container text-center">
            <small>&copy; 2025 examen 2 sebas vasquez.</small>
        </div>
    </footer>
</html>