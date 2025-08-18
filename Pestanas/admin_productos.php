<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Productos (Admin) - Acuario La Casa del Pez</title>
  <link rel="stylesheet" href="../Estilos/Index.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../Estilos/admin_productos.css">
</head>

<body>
  <br>
  <div class="contendedorNav">
    <nav class="Navegacion-Principal ">
      <a href="index.php">
        <img src="../Img/89e80d4a-3e74-4e90-9368-87538123716e_removalai_preview.png" width="125" height="90" alt="Logo">
      </a>
      <a href="admin_productos.php">*Admin* Productos</a>
      <a href="index.php">Inicio</a>
      <a href="productos_index.php">Productos</a>

      <div class="dropdown show">
        <a class="btn btn-secondary dropdown-toggle dropdown-blanco" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Servicios</a>
        <div class="dropdown-menu dropdown-blanco" aria-labelledby="dropdownMenuLink">
          <a href="especies_index.php">Especies</a>
          <a href="adopciones.html">Adopciones</a>
        </div>
      </div>

      <div class="dropdown show">
        <a class="btn btn-secondary dropdown-toggle dropdown-blanco" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Nosotros</a>
        <div class="dropdown-menu dropdown-blanco" aria-labelledby="dropdownMenuLink">
          <a href="quienes_somos.html">Quiénes Somos</a>
          <a href="contactenos.html">Contáctenos</a>
        </div>
      </div>


      <div class="dropdown show">
        <a class="btn btn-secondary dropdown-toggle dropdown-blanco" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Tu cuenta</a>
        <div class="dropdown-menu dropdown-blanco" aria-labelledby="dropdownMenuLink">
          <a href="perfil.html">Mi Cuenta</a>
          <a href="logout.php">Cerrar Sesión</a>
        </div>
      </div>

    </nav>
  </div>
  <br>

  <svg id="wave" style="transform:rotate(180deg); transition: .3s" viewBox="0 0 1440 100" xmlns="http://www.w3.org/2000/svg">
    <defs>
      <linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0">
        <stop stop-color="rgba(255,255,255,1)" offset="0%"></stop>
        <stop stop-color="rgba(99.419,187.23,239.383,1)" offset="100%"></stop>
      </linearGradient>
    </defs>
    <path style="transform:translate(0,0);opacity:1" fill="url(#sw-gradient-0)" d="M0,20L34.3,23.3C68.6,27,137,33,206,45C274.3,57,343,73,411,75C480,77,549,63,617,53.3C685.7,43,754,37,823,36.7C891.4,37,960,43,1029,53.3C1097.1,63,1166,77,1234,68.3C1302.9,60,1371,30,1440,15L1440,100L0,100Z" />
  </svg>

  <div class="container py-4">
    <div class="d-flex align-items-center mb-3">
      <i class="bi bi-box-seam mr-2 h3 mb-0 text-primary"></i>
      <h3 class="mb-0">Productos <small class="text-muted">(Admin)</small></h3>
      <div class="ml-auto">
        <button id="loadProductos" class="btn btn-outline-primary btn-sm">
          <i class="bi bi-arrow-repeat mr-1"></i>Recargar
        </button>
      </div>
    </div>

    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <form id="productosForm">
          <input type="hidden" id="id_producto" name="id_producto">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="nombre_producto">Nombre</label>
              <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" required>
            </div>
            <div class="form-group col-md-2">
              <label for="precio">Precio</label>
              <input type="number" class="form-control" id="precio" name="precio" min="0" step="0.01" required>
            </div>
            <div class="form-group col-md-3">
              <label for="imagen_url">Imagen URL</label>
              <input type="text" class="form-control" id="imagen_url" name="imagen_url" placeholder="../Img/archivo.jpg">
            </div>
            <div class="form-group col-md-3">
              <label for="id_categoria">Categoría (id)</label>
              <input type="number" class="form-control" id="id_categoria" name="id_categoria" min="1">
            </div>
          </div>

          <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label for="especie_relacionada">Especie relacionada</label>
            <input type="text" class="form-control" id="especie_relacionada" name="especie_relacionada">
          </div>

          <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-save mr-1"></i>Guardar
            </button>
            <button type="button" id="cancelEdit" class="btn btn-light ml-2" style="display:none;">
              <i class="bi bi-x-circle mr-1"></i>Cancelar
            </button>
            <span id="productosResult" class="ml-3 text-muted"></span>
          </div>
        </form>
      </div>
    </div>

    <div class="card shadow-sm">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table id="productosTable" class="table table-hover mb-0">
            <thead class="thead-custom">
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th class="text-right">Precio</th>
                <th>Categoría</th>
                <th>Especie</th>
                <th class="text-center">Acciones</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <svg id="wave" style="transform:rotate(0deg); transition:.3s" viewBox="0 0 1440 140" xmlns="http://www.w3.org/2000/svg">
    <defs>
      <linearGradient id="sw-gradient-1" x1="0" x2="0" y1="1" y2="0">
        <stop stop-color="rgba(166,225,255,1)" offset="0%"></stop>
        <stop stop-color="rgba(255,255,255,1)" offset="100%"></stop>
      </linearGradient>
    </defs>
    <path style="transform:translate(0,0);opacity:1" fill="url(#sw-gradient-1)" d="M0,14L18.5,23.3C36.9,33,74,51,111,65.3C147.7,79,185,89,222,93.3C258.5,98,295,98,332,95.7C369.2,93,406,89,443,72.3C480,56,517,28,554,35C590.8,42,628,84,665,93.3C701.5,103,738,79,775,72.3C812.3,65,849,75,886,81.7C923.1,89,960,93,997,95.7C1033.8,98,1071,98,1108,84C1144.6,70,1182,42,1218,32.7C1255.4,23,1292,33,1329,49C1366.2,65,1403,89,1440,91L1440,140L0,140Z" />
  </svg>

  <footer class="footer">
    <div class="footer-content">
      <p>&copy; 2025 Acuario La Casa del Pez. Todos los derechos reservados.</p>
      <p><a href="#">Política de Privacidad</a> | <a href="#">Términos de Servicio</a> | <a href="mailto:LaCasaDelPez@gmail.com">Contacto</a></p>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

  <script src="../js/jquery-3.7.1.min.js"></script>
  <script src="../js/script.js"></script>
</body>

</html>