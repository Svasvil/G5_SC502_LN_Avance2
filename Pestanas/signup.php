<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>

    <link href="../Estilos/signup.css" rel="stylesheet">
    <script src="../js/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/script.js"></script>
</head>
<body>
<div class="login-container">
  <div class="login-box">
    <img src="../Img/89e80d4a-3e74-4e90-9368-87538123716e_removalai_preview.png" width="200" height="150" alt="Logo">
    <br><br>
    <h2>Registro</h2>

    <?php if (!empty($mensaje)) echo "<div class='alert alert-info'>$mensaje</div>"; ?>

    <form id="register-form">
        
      <label for="nombre">Nombre completo</label>
      <input type="text" id="nombre" name="nombre" required>
  
      <label for="correo">Correo electrónico</label>
      <input type="text" id="correo" name="correo" required>

      <label for="usuario">Nombre de usuario</label>
      <input type="text" id="username" name="username" required>

      <label for="contrasena">Contraseña</label>
      <input type="password" id="password" name="password" required>

      <label for="confirmar">Confirmar contraseña</label>
      <input type="password" id="confirmar" name="confirmar" required>

      <button type="submit">Registrarse</button>
    </form>
    <div id="registerResult"></div>
    <p style="text-align:center; margin-top:16px;">
      ¿Ya tienes una cuenta? <a href="login.php" style="color: var(--edus-light-blue); text-decoration: underline;">Inicia sesión</a>
    </p>
  </div>
</div>
</body>
</html>