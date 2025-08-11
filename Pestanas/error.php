<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Error - Acuario La Casa del Pez</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="alert alert-danger text-center">
          <h4>¡Oops! Algo salió mal</h4>
          <p><?php echo htmlspecialchars($error); ?></p>
          <a href="productos.php" class="btn btn-primary">Volver a Productos</a>
          <a href="index.php" class="btn btn-secondary">Ir al Inicio</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>