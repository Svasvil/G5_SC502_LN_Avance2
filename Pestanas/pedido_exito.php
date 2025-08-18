<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pedido confirmado</title>
    <link rel="stylesheet" href="../Estilos/Index.css">
    <link rel="stylesheet" href="../Estilos/productos.css">
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
      
    </nav>
  </div>
  <br>

    <svg id="wave" style="transform:rotate(180deg); transition: .3s" viewBox="0 0 1440 100" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <linearGradient id="g1" x1="0" x2="0" y1="1" y2="0">
                <stop stop-color="rgba(255,255,255,1)" offset="0%"></stop>
                <stop stop-color="rgba(99.419,187.23,239.383,1)" offset="100%"></stop>
            </linearGradient>
        </defs>
        <path fill="url(#g1)" d="M0,20L34.3,23.3C68.6,27,137,33,206,45C274.3,57,343,73,411,75C480,77,549,63,617,53.3C685.7,43,754,37,823,36.7C891.4,37,960,43,1029,53.3C1097.1,63,1166,77,1234,68.3C1302.9,60,1371,30,1440,15L1440,100L0,100Z" />
    </svg>

    <main class="container text-center my-4">
        <h2 class="mb-2">Pedido registrado</h2>
        <p class="text-muted mb-4">Gracias por tu compra.</p>

        <div class="d-flex justify-content-center">
            <div class="card shadow-sm" style="width:100%; max-width:560px;">
                <div class="card-body">
                    <h5 class="mb-3 text-left">Resumen</h5>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th class="text-right">Precio</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyResumen"></tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right">Subtotal</th>
                                    <th class="text-right" id="subResumen">₡0</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-right">Envío</th>
                                    <th class="text-right" id="envResumen">₡0</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-right">Total</th>
                                    <th class="text-right" id="totResumen">₡0</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <a href="productos_index.php" class="btn btn-primary">Seguir comprando</a>
                        <a href="index.php" class="btn btn-outline-secondary">Volver al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <svg id="wave" style="transform:rotate(0deg); transition:.3s" viewBox="0 0 1440 140" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <linearGradient id="g2" x1="0" x2="0" y1="1" y2="0">
                <stop stop-color="rgba(166,225,255,1)" offset="0%"></stop>
                <stop stop-color="rgba(255,255,255,1)" offset="100%"></stop>
            </linearGradient>
        </defs>
        <path fill="url(#g2)" d="M0,14L18.5,23.3C36.9,33,74,51,111,65.3C147.7,79,185,89,222,93.3C258.5,98,295,98,332,95.7C369.2,93,406,89,443,72.3C480,56,517,28,554,35C590.8,42,628,84,665,93.3C701.5,103,738,79,775,72.3C812.3,65,849,75,886,81.7C923.1,89,960,93,997,95.7C1033.8,98,1071,98,1108,84C1144.6,70,1182,42,1218,32.7C1255.4,23,1292,33,1329,49C1366.2,65,1403,89,1440,91L1440,140L0,140Z" />
    </svg>

    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2025 Acuario La Casa del Pez. Todos los derechos reservados.</p>
            <p><a href="#">Política de Privacidad</a> | <a href="#">Términos de Servicio</a> | <a href="mailto:LaCasaDelPez@gmail.com">Contacto</a></p>
        </div>
    </footer>

    <script>
        (function() {
            function money(n) {
                return (n || 0).toLocaleString('es-CR', {
                    style: 'currency',
                    currency: 'CRC'
                });
            }
            var raw = localStorage.getItem('lastPedido');
            var data = raw ? JSON.parse(raw) : [];
            var tb = document.getElementById('tbodyResumen');
            var sub = 0;
            tb.innerHTML = '';
            if (Array.isArray(data) && data.length) {
                data.forEach(function(it) {
                    var tr = document.createElement('tr');
                    var td1 = document.createElement('td');
                    td1.textContent = (it.nombre || 'Producto');
                    var td2 = document.createElement('td');
                    td2.className = 'text-right';
                    td2.textContent = money(it.precio || 0);
                    var td3 = document.createElement('td');
                    td3.className = 'text-center';
                    td3.textContent = String(it.cantidad || 1);
                    var td4 = document.createElement('td');
                    td4.className = 'text-right';
                    var t = (it.precio || 0) * (it.cantidad || 1);
                    td4.textContent = money(t);
                    sub += t;
                    tr.appendChild(td1);
                    tr.appendChild(td2);
                    tr.appendChild(td3);
                    tr.appendChild(td4);
                    tb.appendChild(tr);
                });
            } else {
                var tr = document.createElement('tr');
                var td = document.createElement('td');
                td.colSpan = 4;
                td.className = 'text-center';
                td.textContent = 'No hay datos del pedido.';
                tr.appendChild(td);
                tb.appendChild(tr);
            }
            var envio = 0;
            document.getElementById('subResumen').textContent = money(sub);
            document.getElementById('envResumen').textContent = money(envio);
            document.getElementById('totResumen').textContent = money(sub + envio);
            localStorage.removeItem('lastPedido');
        })();
    </script>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>

</html>