<?php
require_once '../app/controllers/ProductosController.php';
$controller = new ProductosController();

if (isset($_GET['busqueda'])) {
    $controller->buscar();
} elseif (isset($_GET['categoria'])) {
    $controller->porCategoria($_GET['categoria']);
} else {
    $controller->index();
}
?>