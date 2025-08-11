<?php
// router.php

// Incluimos el controlador que contiene la lógica de login
require_once 'app/controllers/AuthController.php';

// Verificamos si se ha recibido el parámetro 'action'
$action = $_GET['action'] ?? null;

// Usamos un switch para dirigir la solicitud
switch ($action) {
    case 'login':
        // Creamos una instancia del controlador de autenticación
        $controller = new AuthController();
        // Llamamos al método login
        $controller->login();
        break;

    default:
        // En caso de que la acción no sea válida, devolvemos un error
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Acción no válida']);
        break;
}