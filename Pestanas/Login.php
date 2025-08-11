<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Log In</title>
    <link href="../Estilos/login.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="../js/script.js"></script>
</head>
<body>
<div class="login-container">
    <div class="login-box">

 <img src="../Img/89e80d4a-3e74-4e90-9368-87538123716e_removalai_preview.png" width="200" height="150" alt="Logo">
 <br><br><br><br>

        <h2>Iniciar Sesión</h2>

        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

        <form id="login-form">
            <label for="usuario">usuario</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <button type="submit">Ingresar</button>
        </form>

        <div id="loginResult" style="margin-top: 15px; font-weight: bold;"></div>

     <p style="text-align:center; margin-top:16px;">
      ¿No tienes cuenta? <a href="signup.php" style="color: var(--edus-light-blue); text-decoration: underline;">Regístrate aquí</a>
    </p>
    </div>
   
</div>
</body>
    <footer class="footer">
  <div class="footer-content">
    <p>&copy; 2025 Acuario La Casa del Pez. Todos los derechos reservados.</p>
    <p>
      <a href="#">Política de Privacidad</a> | 
      <a href="#">Términos de Servicio</a> | 
      <a href="LaCasaDelPez@gmail.com">Contacto</a>
    </p>
  </div>
</footer>

</html>