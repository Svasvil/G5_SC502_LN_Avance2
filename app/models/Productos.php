<?php
require_once '../app/config/db.php';

class Productos {
    private $conn;
    
    public function __construct() {
        $this->conn = Database::connect();
        
        // Verificar la conexión
        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }
    
    /**
     * Obtener todos los productos con sus categorías
     */
    public function obtenerTodos() {
        $sql = "SELECT p.*, c.nombre_categoria 
                FROM Productos p 
                LEFT JOIN categorias c ON p.id_categoria = c.id_categoria 
                ORDER BY p.id_producto DESC";
        
        $result = $this->conn->query($sql);
        
        if ($result === false) {
            throw new Exception("Error en la consulta: " . $this->conn->error);
        }
        
        $productos = [];
        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }
        
        return $productos;
    }
    
    /**
     * Crear un nuevo producto
     */
    public function create($datos) {
        $sql = "INSERT INTO Productos (nombre_producto, descripcion, precio, imagen_url, id_categoria, especie_relacionada) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bind_param("ssdsis", 
            $datos['nombre_producto'],
            $datos['descripcion'],
            $datos['precio'],
            $datos['imagen_url'],
            $datos['id_categoria'],
            $datos['especie_relacionada']
        );
        
        return $this->conn->insert_id;
    }
    
    /**
     * Actualizar un producto existente
     */
    public function update($id, $datos) {
        $sql = "UPDATE Productos 
                SET nombre_producto = ?, descripcion = ?, precio = ?, 
                    imagen_url = ?, id_categoria = ?, especie_relacionada = ?
                WHERE id_producto = ?";
        
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $this->conn->error);
        }
        
        $stmt->bind_param("ssdsIsi", 
            $datos['nombre_producto'],
            $datos['descripcion'],
            $datos['precio'],
            $datos['imagen_url'],
            $datos['id_categoria'],
            $datos['especie_relacionada'],
            $id
        );
        
        if (!$stmt->execute()) {
            throw new Exception("Error al actualizar producto: " . $stmt->error);
        }
        
        return $stmt->affected_rows > 0;
    }
    
    /**
     * Eliminar un producto
     */
    public function delete($id) {
        $sql = "DELETE FROM Productos WHERE id_producto = ?";
        
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $this->conn->error);
        }
        
        $stmt->bind_param("i", $id);
        
        if (!$stmt->execute()) {
            throw new Exception("Error al eliminar producto: " . $stmt->error);
        }
        
        return $stmt->affected_rows > 0;
    }
    
    /**
     * Cerrar conexión
     */
    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>