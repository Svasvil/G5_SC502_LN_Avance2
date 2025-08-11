<?php
// productos.php
require_once '../app/controllers/ProductosController.php';

$controller = new ProductosController();

// Verificar si hay parámetros de búsqueda o categoría
if (isset($_GET['busqueda'])) {
    $controller->buscar();
} elseif (isset($_GET['categoria'])) {
    $controller->porCategoria($_GET['categoria']);
} else {
    $controller->index();
}
?>