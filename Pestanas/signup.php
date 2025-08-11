<?php
require_once 'conexion.php';

$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $contrasena = $_POST['contrasena'];
    $confirmar = $_POST['confirmar'];

    // Generar un nombre de usuario y un email simple
    $nombre_usuario_generado = strtolower(substr($nombre, 0, 1) . $apellido);
    $email_generado = strtolower(str_replace(" ", ".", $nombre)) . "." . strtolower($apellido) . "@dominio.com";

    if ($contrasena !== $confirmar) {
        $mensaje = "Las contraseñas no coinciden.";
    } else {
        $mysqli = abrirConexion();
        
        // 1. Verificar si el nombre de usuario ya existe
        $stmt_check = $mysqli->prepare("SELECT id_usuario FROM Usuarios WHERE nombre_usuario = ?");
        $stmt_check->bind_param("s", $nombre_usuario_generado);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            $mensaje = "Ya existe un usuario con ese nombre de usuario. Intenta con otro.";
        } else {
            // 2. Hashear la contraseña para mayor seguridad
            $contrasena_hashed = password_hash($contrasena, PASSWORD_DEFAULT);

            // 3. Insertar en la tabla Usuarios
            $stmt_usuario = $mysqli->prepare("INSERT INTO Usuarios (nombre_usuario, contrasena, tipo_usuario) VALUES (?, ?, 'Registrado')");
            $stmt_usuario->bind_param("ss", $nombre_usuario_generado, $contrasena_hashed);

            if ($stmt_usuario->execute()) {
                // Obtener el ID del usuario recién insertado
                $id_usuario = $stmt_usuario->insert_id;

                // 4. Insertar en la tabla Perfiles
                $stmt_perfil = $mysqli->prepare("INSERT INTO Perfiles (id_usuario, nombre, email) VALUES (?, ?, ?)");
                $nombre_completo = $nombre . " " . $apellido;
                $stmt_perfil->bind_param("iss", $id_usuario, $nombre_completo, $email_generado);
                
                if ($stmt_perfil->execute()) {
                    $mensaje = "Registro exitoso. Tu nombre de usuario es: **" . htmlspecialchars($nombre_usuario_generado) . "**";
                } else {
                    $mensaje = "Error al registrar el perfil: " . $stmt_perfil->error;
                }
            } else {
                $mensaje = "Error al registrar el usuario: " . $stmt_usuario->error;
            }
        }
        cerrarConexion($mysqli);
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