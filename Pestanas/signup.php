<?php
require_once 'conexion.php'; // Este archivo debe conectar a la base 'citasmedicas'

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recoger datos del formulario
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $contrasena = $_POST['contrasena'];
    $confirmar = $_POST['confirmar'];

    // Validar campos
    if (empty($nombre) || empty($apellido) || empty($contrasena) || empty($confirmar)) {
        $mensaje = "Todos los campos son obligatorios.";
    } elseif ($contrasena !== $confirmar) {
        $mensaje = "Las contraseñas no coinciden.";
    } else {
        // Generar nombre de usuario y correo
        $nombre_usuario = strtolower(substr($nombre, 0, 1) . $apellido);
        $correo = strtolower(str_replace(" ", ".", $nombre)) . "." . strtolower($apellido) . "@acuario.com";

        // Conectar a la base de datos
        $mysqli = abrirConexion();
        if (!$mysqli || $mysqli->connect_errno) {
            $mensaje = "Error de conexión: " . ($mysqli ? $mysqli->connect_error : mysqli_connect_error());
        } else {
            // Verificar si el usuario ya existe
            $stmt_check = $mysqli->prepare("SELECT id FROM usuarios WHERE usuario = ?");
            if ($stmt_check) {
                $stmt_check->bind_param("s", $nombre_usuario);
                $stmt_check->execute();
                $result_check = $stmt_check->get_result();

                if ($result_check && $result_check->num_rows > 0) {
                    $mensaje = "Ya existe un usuario con ese nombre de usuario.";
                } else {
                    // Hashear la contraseña
                    $contrasena_hashed = password_hash($contrasena, PASSWORD_DEFAULT);
                    $nombre_completo = $nombre . " " . $apellido;

                    // Insertar nuevo usuario
                    $stmt_insert = $mysqli->prepare("INSERT INTO usuarios (nombre, usuario, correo, contrasena, rol) VALUES (?, ?, ?, ?, 'recepcionista')");
                    if ($stmt_insert) {
                        $stmt_insert->bind_param("ssss", $nombre_completo, $nombre_usuario, $correo, $contrasena_hashed);
                        if ($stmt_insert->execute()) {
                            $mensaje = "✅ Registro exitoso. Tu nombre de usuario es: <strong>" . htmlspecialchars($nombre_usuario) . "</strong>";
                        } else {
                            $mensaje = "❌ Error al registrar el usuario: " . $stmt_insert->error;
                        }
                        $stmt_insert->close();
                    } else {
                        $mensaje = "❌ Error preparando el INSERT: " . $mysqli->error;
                    }
                }
                $stmt_check->close();
            } else {
                $mensaje = "❌ Error preparando la verificación: " . $mysqli->error;
            }
            cerrarConexion($mysqli);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Estilos/signup.css" rel="stylesheet">
</head>
<body>
<div class="login-container">
  <div class="login-box">
    <img src="../Img/89e80d4a-3e74-4e90-9368-87538123716e_removalai_preview.png" width="200" height="150" alt="Logo">
    <br><br>
    <h2>Registro</h2>

    <?php if (!empty($mensaje)) echo "<div class='alert alert-info'>$mensaje</div>"; ?>

    <form method="POST">
      <label for="nombre">Nombre</label>
      <input type="text" id="nombre" name="nombre" required>

      <label for="apellido">Apellido</label>
      <input type="text" id="apellido" name="apellido" required>

      <label for="contrasena">Contraseña</label>
      <input type="password" id="contrasena" name="contrasena" required>

      <label for="confirmar">Confirmar contraseña</label>
      <input type="password" id="confirmar" name="confirmar" required>

      <button type="submit">Registrarse</button>
    </form>
    <p style="text-align:center; margin-top:16px;">
      ¿Ya tienes una cuenta? <a href="login.php" style="color: var(--edus-light-blue); text-decoration: underline;">Inicia sesión</a>
    </p>
  </div>
</div>
</body>
</html>