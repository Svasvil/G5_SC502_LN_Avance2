<?php
require_once 'app/models/Citas.php';

class CitasController {
    public function create() {
        $cita = new Citas();

        $nombre_paciente = $_POST['nombre_paciente'] ?? '';
        $fecha = $_POST['fecha'] ?? '';
        $hora = $_POST['hora'] ?? '';
        $estado = $_POST['estado'] ?? '';
        $nombre_usuario = $_POST['nombre_usuario'] ?? '';

        if ($cita->create($nombre_paciente, $fecha, $hora, $estado, $nombre_usuario)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo crear el producto']);
        }
    }

    public function list() {
        $cita = new Citas();

        $citasA = $cita->getAll();

        echo json_encode(['status' => 'success', 'data' => $citasA]);
    }

    public function show() {
        $cita = new Citas();
        $id = $_GET['id'] ?? 0;

        $item = $cita->getById($id);

        if ($item) {
            echo json_encode(['status' => 'success', 'data' => $item]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Producto no encontrado']);
        }
    }

    public function update() {
        $cita = new Citas();

        $id = $_POST['id'] ?? 0;
        $nombre_paciente = $_POST['nombre_paciente'] ?? '';
        $fecha = $_POST['fecha'] ?? '';
        $hora = $_POST['hora'] ?? '';
        $estado = $_POST['estado'] ?? '';
        $nombre_usuario = $_POST['nombre_usuario'] ?? '';

        if ($cita->update($id, $nombre_paciente, $fecha, $hora, $estado, $nombre_usuario)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo actualizar']);
        }
    }

    public function delete() {
        $cita = new Citas();
        $id = $_POST['id'] ?? 0;

        if ($cita->delete($id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo eliminar']);
        }
    }
}
