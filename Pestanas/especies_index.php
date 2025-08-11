<?php
require_once '../app/controllers/EspeciesController.php';

$controller = new EspeciesController();

if (isset($_GET['q']) || isset($_GET['habitat'])) {
    $controller->buscar($_GET['q'] ?? '', $_GET['habitat'] ?? '');
} else {
    $controller->index();
}
