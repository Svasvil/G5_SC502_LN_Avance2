<?php
require_once(ROOT_PATH . 'app/config/db.php');

class User {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if ($result && password_verify($password, $result['contrasena'])) {
            return true;
        }
        return false;
    }
}
