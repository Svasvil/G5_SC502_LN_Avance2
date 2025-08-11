<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Productos (Admin)</title>

  <link rel="stylesheet" href="../Estilos/Index.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../Estilos/admin_productos.css">
</head>
<body>

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
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

<script src="../js/jquery-3.7.1.min.js"></script>
<script src="../js/script.js"></script>
</body>
</html>
