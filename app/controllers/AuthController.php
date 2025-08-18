<?php
require_once(ROOT_PATH . 'app/models/Usuario.php');

class AuthController {
    public function login() {
        session_start();

        $user = new User();
        $username = $_POST['usuario'] ?? '';
        $password = $_POST['contrasena'] ?? '';

        if ($user->login($username, $password)) {
            $_SESSION['user_logged_in'] = true;
            $_SESSION['username'] = $username;
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error con el usuario']);
        }
    }
    
     public function register() {
        $user = new User();
        $nombre = $_POST['nombre'] ?? '';
        $correo = $_POST['correo'] ?? '';
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Validaciones básicas
        if (empty($nombre) || empty($correo) || empty($username) || empty($password)) {
            echo json_encode(['status' => 'error', 'message' => 'Todos los campos son requeridos']);
            return;
        }

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 'error', 'message' => 'El correo electrónico no es válido']);
            return;
        }

        if ($user->register($nombre, $correo, $username, $password)) {
            echo json_encode(['status' => 'success', 'message' => 'Usuario registrado correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'El usuario o correo ya existen']);
        }
    }
}