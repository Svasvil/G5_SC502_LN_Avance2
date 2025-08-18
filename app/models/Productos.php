<?php
require_once __DIR__ . '/../config/db.php';

class Productos {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
        $this->conn->set_charset('utf8mb4');
    }

    public function obtenerTodos() {
        $sql = "SELECT p.*, c.nombre_categoria
                  FROM Productos p
             LEFT JOIN categorias c ON p.id_categoria = c.id_categoria
              ORDER BY p.id_producto DESC";
        $res = $this->conn->query($sql);
        if ($res === false) throw new Exception("Error en la consulta: " . $this->conn->error);

        $data = [];
        while ($row = $res->fetch_assoc()) $data[] = $row;
        return $data;
    }

    public function obtenerPorId($id) {
        $sql = "SELECT p.*, c.nombre_categoria
                  FROM Productos p
             LEFT JOIN categorias c ON p.id_categoria = c.id_categoria
                 WHERE p.id_producto = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) throw new Exception("Prepare error: " . $this->conn->error);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res ? $res->fetch_assoc() : null;
    }

    public function create($datos) {
        $sql = "INSERT INTO Productos
                   (nombre_producto, descripcion, precio, imagen_url, id_categoria, especie_relacionada)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) throw new Exception("Prepare error: " . $this->conn->error);

        $idCat = isset($datos['id_categoria']) && $datos['id_categoria'] !== '' ? (int)$datos['id_categoria'] : null;

        $stmt->bind_param(
            "ssdsis",
            $datos['nombre_producto'],
            $datos['descripcion'],
            $datos['precio'],
            $datos['imagen_url'],
            $idCat,
            $datos['especie_relacionada']
        );
        if (!$stmt->execute()) throw new Exception("Execute error: " . $stmt->error);
        return $this->conn->insert_id;
    }

    public function update($id, $datos) {
        $sql = "UPDATE Productos
                   SET nombre_producto = ?, descripcion = ?, precio = ?,
                       imagen_url = ?, id_categoria = ?, especie_relacionada = ?
                 WHERE id_producto = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) throw new Exception("Prepare error: " . $this->conn->error);

        $idCat = isset($datos['id_categoria']) && $datos['id_categoria'] !== '' ? (int)$datos['id_categoria'] : null;

        $stmt->bind_param(
            "ssdsisi",
            $datos['nombre_producto'],
            $datos['descripcion'],
            $datos['precio'],
            $datos['imagen_url'],
            $idCat,
            $datos['especie_relacionada'],
            $id
        );
        if (!$stmt->execute()) throw new Exception("Execute error: " . $stmt->error);
        return $stmt->affected_rows >= 0;
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM Productos WHERE id_producto = ?");
        if (!$stmt) throw new Exception("Prepare error: " . $this->conn->error);
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) throw new Exception("Execute error: " . $stmt->error);
        return $stmt->affected_rows > 0;
    }

    public function __destruct() {
        if ($this->conn) $this->conn->close();
    }
}


?>