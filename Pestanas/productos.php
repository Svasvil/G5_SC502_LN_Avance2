<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Productos - Acuario La Casa del Pez</title>
  <link rel="stylesheet" href="../Estilos/index.css">
  <link rel="stylesheet" href="../Estilos/productos.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<br>
<div class="contendedorNav">
  <nav class="Navegacion-Principal ">   
     <a href="index.php">
    <img src="../Img/89e80d4a-3e74-4e90-9368-87538123716e_removalai_preview.png" width="125" height="90" alt="Logo">
  </a>
      <a href="login.php">Iniciar Sesión</a>
      <a href="index.php">Inicio</a>
      <a href="productos_index.php">Productos</a>

<div class="dropdown show">
  <a class="btn btn-secondary dropdown-toggle dropdown-blanco" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" > Servicios</a>
  <div class="dropdown-menu dropdown-blanco" aria-labelledby="dropdownMenuLink">
                  <a href="especies_index.php">Especies</a>
            <a href="adopciones.html">Adopciones</a>
  </div>
</div>
            
<div class="dropdown show">
  <a class="btn btn-secondary dropdown-toggle dropdown-blanco" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" > Nosotros</a>
  <div class="dropdown-menu dropdown-blanco" aria-labelledby="dropdownMenuLink">
    <a href="quienes_somos.html">Quiénes Somos</a>
    <a href="contactenos.html">Contáctenos</a>
  </div>
</div>


<div class="dropdown show">
  <a class="btn btn-secondary dropdown-toggle dropdown-blanco" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" > Tu cuenta</a>
  <div class="dropdown-menu dropdown-blanco" aria-labelledby="dropdownMenuLink">
    <a href="login.php">Iniciar Sesión</a>
    <a href="perfil.html">Mi Cuenta</a>
  </div>
</div>

     

    </nav>
    </div>
    <br>

  <!-- Ola superior -->
  <svg id="wave" style="transform:rotate(180deg); transition: 0.3s" viewBox="0 0 1440 100" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(255, 255, 255, 1)" offset="0%"></stop><stop stop-color="rgba(99.419, 187.23, 239.383, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,20L34.3,23.3C68.6,27,137,33,206,45C274.3,57,343,73,411,75C480,77,549,63,617,53.3C685.7,43,754,37,823,36.7C891.4,37,960,43,1029,53.3C1097.1,63,1166,77,1234,68.3C1302.9,60,1371,30,1440,15L1440,100L0,100Z"></path></svg>

  <br><br>

  <!-- Título -->
  <div class="Productos">
    <div class="fondo">
      <h2><?php echo htmlspecialchars($titulo); ?></h2>
    </div>
  </div>


  <!-- Contenedor de productos dinámico -->
  <div class="contenedor-flex">
    <?php if (!empty($productos)): ?>
      <?php foreach ($productos as $producto): ?>
        <div class="item">
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" 
                 src="<?php echo !empty($producto['imagen_url']) ? htmlspecialchars($producto['imagen_url']) : 'Img/producto-default.jpg'; ?>" 
                 alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>"
                 onerror="this.src='Img/producto-default.jpg'">
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($producto['nombre_producto']); ?></h5>
              <p class="card-text"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
              <p class="precio"><strong>₡<?php echo number_format($producto['precio'], 2); ?></strong></p>
              <?php if (!empty($producto['nombre_categoria'])): ?>
                <small class="categoria">Categoría: <?php echo htmlspecialchars($producto['nombre_categoria']); ?></small>
              <?php endif; ?>
              <?php if (!empty($producto['especie_relacionada'])): ?>
                <br><small class="text-muted">Para: <?php echo htmlspecialchars($producto['especie_relacionada']); ?></small>
              <?php endif; ?>
              <br><br>
              <a href="Producto.php?id=<?php echo $producto['id_producto']; ?>" class="btnProducto">Ver Detalles</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12 text-center">
        <div class="alert alert-info">
          <h4>No hay productos disponibles</h4>
          <p>
            <?php if (isset($_GET['busqueda'])): ?>
              No se encontraron productos que coincidan con tu búsqueda.
            <?php elseif (isset($_GET['categoria'])): ?>
              No hay productos en esta categoría en este momento.
            <?php else: ?>
              No hay productos disponibles en este momento.
            <?php endif; ?>
          </p>
          <a href="productos.php" class="btn btn-primary">Ver todos los productos</a>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <!-- Ola inferior -->
  <svg id="wave" style="transform:rotate(0deg); transition: 0.3s" viewBox="0 0 1440 140" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(166, 225, 255, 1)" offset="0%"></stop><stop stop-color="rgba(255, 255, 255, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,14L18.5,23.3C36.9,33,74,51,111,65.3C147.7,79,185,89,222,93.3C258.5,98,295,98,332,95.7C369.2,93,406,89,443,72.3C480,56,517,28,554,35C590.8,42,628,84,665,93.3C701.5,103,738,79,775,72.3C812.3,65,849,75,886,81.7C923.1,89,960,93,997,95.7C1033.8,98,1071,98,1108,84C1144.6,70,1182,42,1218,32.7C1255.4,23,1292,33,1329,49C1366.2,65,1403,89,1440,91L1440,140L0,140Z"></path></svg>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-content">
      <p>&copy; 2025 Acuario La Casa del Pez. Todos los derechos reservados.</p>
      <p>
        <a href="#">Política de Privacidad</a> | 
        <a href="#">Términos de Servicio</a> | 
        <a href="mailto:LaCasaDelPez@gmail.com">Contacto</a>
      </p>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
