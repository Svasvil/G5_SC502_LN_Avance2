<?php
require_once 'app/models/Usuario.php';

class AuthController {
    public function login() {
        session_start();

        $user = new User();
        $username = $_POST['usuario'] ?? '';
        $password = $_POST['contrasena'] ?? '';

        if ($user->login($email, $password)) {
            $_SESSION['user_logged_in'] = true;
            $_SESSION['username'] = $username;
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error con el usuario']);
        }
    }
}