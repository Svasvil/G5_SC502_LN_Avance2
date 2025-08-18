<?php
define('ROOT_PATH', __DIR__ . '/../');

require_once(ROOT_PATH . 'app/controllers/AuthController.php');
require_once(ROOT_PATH . 'app/models/Productos.php');

$action = $_GET['action'] ?? '';

try {
    switch ($action) {
        case 'login':
            header('Content-Type: application/json');
            $auth = new AuthController();
            $auth->login();         
            break;
        case 'register':        
            header('Content-Type: application/json');
            $auth = new AuthController(); 
            $auth->register();         
            break;
        case 'listProductos':
            header('Content-Type: application/json');
            $m = new Productos();
            echo json_encode(['status' => 'success', 'data' => $m->obtenerTodos()]);
            break;
        case 'showProductos':
            header('Content-Type: application/json');
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            $m = new Productos();
            $row = $m->obtenerPorId($id);
            if ($row) {
                echo json_encode(['status' => 'success', 'data' => $row]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Producto no encontrado']);
            }
            break;
        case 'createProductos':
            header('Content-Type: application/json');
            $m = new Productos();
            $datos = [
                'nombre_producto'     => trim($_POST['nombre_producto'] ?? ''),
                'descripcion'         => trim($_POST['descripcion'] ?? ''),
                'precio'              => (float)($_POST['precio'] ?? 0),
                'imagen_url'          => trim($_POST['imagen_url'] ?? ''),
                'id_categoria'        => $_POST['id_categoria'] ?? null,
                'especie_relacionada' => trim($_POST['especie_relacionada'] ?? '')
            ];
            if ($datos['nombre_producto'] === '' || $datos['precio'] <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Nombre y precio son obligatorios']);
                exit;
            }
            $id = $m->create($datos);
            echo json_encode(['status' => 'success', 'id' => $id]);
            break;
        case 'updateProductos':
            header('Content-Type: application/json');
            $m = new Productos();
            $id = (int)($_POST['id_producto'] ?? 0);
            if ($id <= 0) { echo json_encode(['status' => 'error', 'message' => 'ID inválido']); break; }

            $datos = [
                'nombre_producto'     => trim($_POST['nombre_producto'] ?? ''),
                'descripcion'         => trim($_POST['descripcion'] ?? ''),
                'precio'              => (float)($_POST['precio'] ?? 0),
                'imagen_url'          => trim($_POST['imagen_url'] ?? ''),
                'id_categoria'        => $_POST['id_categoria'] ?? null,
                'especie_relacionada' => trim($_POST['especie_relacionada'] ?? '')
            ];
            $ok = $m->update($id, $datos);
            echo json_encode(['status' => $ok ? 'success' : 'error']);
            break;
        case 'deleteProductos':
            header('Content-Type: application/json');
            $m = new Productos();
            $id = (int)($_POST['id_producto'] ?? 0);
            $ok = $m->delete($id);
            echo json_encode(['status' => $ok ? 'success' : 'error']);
            break;
        default:
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Ruta no encontrada']);
            break;
    }
} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);

};
