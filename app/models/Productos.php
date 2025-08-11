<?php
require_once 'app/config/db.php';

class Citas
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function create($nombre_paciente, $fecha, $hora, $estado, $nombre_usuario)
    {
        $stmt = $this->db->prepare("INSERT INTO citas (nombre_paciente, fecha, hora, estado, nombre_usuario) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre_paciente, $fecha, $hora, $estado, $nombre_usuario);
        return $stmt->execute();
    }

    public function getAll()
    {
        $result = $this->db->query("SELECT * FROM citas");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM citas WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function update($id, $nombre_paciente, $fecha, $hora, $estado, $nombre_usuario)
    {
       $stmt = $this->db->prepare("UPDATE citas SET nombre_paciente=?, fecha=?, hora=?, estado=?, nombre_usuario=? WHERE id=?");
       $stmt->bind_param("sssssi", $nombre_paciente, $fecha, $hora, $estado, $nombre_usuario, $id);
       return $stmt->execute();
}

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM citas WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

   
}
