<?php
define('ROOT_PATH', __DIR__ . '/../');

require_once(ROOT_PATH . 'app/controllers/AuthController.php');
header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

$auth = new AuthController();

switch ($action) {
    case 'login':
        $auth->login();
        break;
    
    default:
        echo json_encode(['status' => 'error', 'message' => 'Ruta no encontrada']);
        break;
}

