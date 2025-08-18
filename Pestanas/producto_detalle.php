<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$pdo = new PDO('mysql:host=127.0.0.1;dbname=proyectoambientewebg5;charset=utf8mb4', 'root', 'contraseña', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$stmt = $pdo->prepare('SELECT p.id_producto, p.nombre_producto, p.descripcion, p.precio, p.imagen_url, p.especie_relacionada, c.nombre_categoria FROM productos p LEFT JOIN categorias c ON p.id_categoria = c.id_categoria WHERE p.id_producto = ?');
$stmt->execute([$id]);
$p = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$p) {
    header('Location: productos_index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($p['nombre_producto']); ?> - Acuario La Casa del Pez</title>
    <link rel="stylesheet" href="../Estilos/producto.css">
    <link rel="stylesheet" href="../Estilos/Index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
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

            <div style="margin-left:auto; display:flex; align-items:center;">
                <a href="carrito.html" class="btn btn-outline-primary">
                    🛒 Carrito <span id="cartCount" class="badge badge-pill badge-info">0</span>
                </a>
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

    <main>
        <section class="producto">
            <div class="imagen-producto">
                <img src="<?php echo htmlspecialchars($p['imagen_url'] ?: '../Img/producto-default.jpg'); ?>" alt="Imagen del producto" onerror="this.src='../Img/producto-default.jpg'">
            </div>

            <div class="info-producto">
                <h1 class="titulo-producto"><?php echo htmlspecialchars($p['nombre_producto']); ?></h1>
                <p class="precio">₡<?php echo number_format((float)$p['precio'], 2); ?></p>

                <div class="descripcion-corta">
                    <h2>Descripción</h2>
                    <p><?php echo htmlspecialchars($p['descripcion'] ?: 'Sin descripción.'); ?></p>
                </div>

                <div class="especificaciones">
                    <h2>Datos</h2>
                    <ul>
                        <li><strong>Categoría:</strong> <span><?php echo htmlspecialchars($p['nombre_categoria'] ?: '—'); ?></span></li>
                        <li><strong>Especie relacionada:</strong> <span><?php echo htmlspecialchars($p['especie_relacionada'] ?: '—'); ?></span></li>
                    </ul>
                </div>

                <div class="d-flex align-items-center" style="gap:8px; margin-top:10px;">
                    <input type="number" id="qty" value="1" min="1" class="form-control" style="width:90px;">
                    <button id="addToCart" class="btnProducto" data-id="<?php echo (int)$p['id_producto']; ?>" data-nombre="<?php echo htmlspecialchars($p['nombre_producto']); ?>" data-precio="<?php echo (float)$p['precio']; ?>" data-imagen="<?php echo htmlspecialchars($p['imagen_url'] ?: '../Img/producto-default.jpg'); ?>">Agregar al carrito</button>
                    <a class="btn btn-outline-primary" href="productos_index.php">Volver al catálogo</a>
                </div>
            </div>
        </section>
    </main>

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

    <script>
        (function() {
            var btn = document.getElementById('addToCart');
            if (!btn) return;
            btn.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                var nombre = this.getAttribute('data-nombre');
                var precio = parseFloat(this.getAttribute('data-precio')) || 0;
                var imagen = this.getAttribute('data-imagen');
                var qty = parseInt(document.getElementById('qty').value) || 1;
                if (qty < 1) qty = 1;
                var cartRaw = localStorage.getItem('carrito');
                var cart = cartRaw ? JSON.parse(cartRaw) : [];
                var idx = -1;
                for (var i = 0; i < cart.length; i++) {
                    if (String(cart[i].id) === String(id)) {
                        idx = i;
                        break;
                    }
                }
                if (idx > -1) {
                    cart[idx].cantidad += qty;
                } else {
                    cart.push({
                        id: id,
                        nombre: nombre,
                        precio: precio,
                        imagen: imagen,
                        cantidad: qty
                    });
                }
                localStorage.setItem('carrito', JSON.stringify(cart));
                window.location.href = 'carrito.html';
            });
        })();
    </script>

    <script src="../js/cartCounter.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>

</html>