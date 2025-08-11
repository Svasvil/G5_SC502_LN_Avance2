<?php
require_once '../app/models/Productos.php';

class ProductosController {
    private $productosModel;
    
    public function __construct() {
        $this->productosModel = new Productos();
    }
    
    /**
     * Mostrar todos los productos
     */
    public function index() {
        try {
            $productos = $this->productosModel->obtenerTodos();
            $titulo = "Todos nuestros productos";
            $this->mostrarVista('productos', compact('productos', 'titulo'));
        } catch (Exception $e) {
            $this->manejarError("Error al cargar productos: " . $e->getMessage());
        }
    }
    
    public function create() {
        $producto = new Productos();

        $nombre_producto = $_POST['nombre_producto'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $precio = $_POST['precio'] ?? '';
        $imagen_url = $_POST['imagen_url'] ?? '';
        $id_categoria = $_POST['id_categoria'] ?? '',
        $especie_relacionada = $_POST['especie_relacionada'] ?? '';

        if ($cita->create($nombre_producto, $descripcion, $precio, $imagen_url, $especie_relacionada)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo crear el producto']);
        }
    }

    public function list() {
        $producto = new Productos();

        $productoA = $producto->getAll();

        echo json_encode(['status' => 'success', 'data' => $productoA]);
    }

    public function show() {
        $producto = new Productos();
        $id = $_GET['id_producto'] ?? 0;

        $item = $producto->getById($id);

        if ($item) {
            echo json_encode(['status' => 'success', 'data' => $item]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Producto no encontrado']);
        }
    }

    public function update() {
        $producto = new Productos();

        $id = $_POST['id_producto'] ?? 0;
        $nombre_producto = $_POST['nombre_producto'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $precio = $_POST['precio'] ?? '';
        $imagen_url = $_POST['imagen_url'] ?? '';
        $id_categoria = $_POST['id_categoria'] ?? '',
        $especie_relacionada = $_POST['especie_relacionada'] ?? '';

        if ($cita->update($id, $nombre_producto, $descripcion, $precio, $imagen_url, $especie_relacionada)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo actualizar']);
        }
    }

    public function delete() {
        $producto = new Productos();
        $id = $_POST['id_producto'] ?? 0;

        if ($cita->delete($id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo eliminar']);
        }
    }
}

    
    /**
     * Mostrar una vista
     */
    private function mostrarVista($vista, $datos = []) {
        extract($datos);
        include "../Pestanas/$vista.php";
    }
    
    /**
     * Manejar errores
     */
    private function manejarError($mensaje) {
        $error = $mensaje;
        include '../Pestanas/error.php';
    }
}
?>