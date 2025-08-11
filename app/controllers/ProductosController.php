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
    
    /**
     * Mostrar productos por categoría
     */
    public function porCategoria($idCategoria) {
        try {
            $productos = $this->productosModel->obtenerPorCategoria($idCategoria);
            $titulo = "Productos por categoría";
            $this->mostrarVista('productos', compact('productos', 'titulo'));
        } catch (Exception $e) {
            $this->manejarError("Error al cargar productos por categoría: " . $e->getMessage());
        }
    }
    
    /**
     * Buscar productos
     */
    public function buscar() {
        $termino = $_GET['busqueda'] ?? '';
        
        if (empty($termino)) {
            header('Location: productos.php');
            exit;
        }
        
        try {
            $productos = $this->productosModel->buscar($termino);
            $titulo = "Resultados de búsqueda para: " . htmlspecialchars($termino);
            $this->mostrarVista('productos', compact('productos', 'titulo'));
        } catch (Exception $e) {
            $this->manejarError("Error al buscar productos: " . $e->getMessage());
        }
    }
    
    /**
     * Mostrar un producto específico
     */
    public function mostrar($id) {
        try {
            $producto = $this->productosModel->obtenerPorId($id);
            
            if (!$producto) {
                http_response_code(404);
                $this->manejarError("Producto no encontrado");
                return;
            }
            
            $this->mostrarVista('producto_detalle', compact('producto'));
        } catch (Exception $e) {
            $this->manejarError("Error al cargar producto: " . $e->getMessage());
        }
    }
    
    /**
     * Obtener productos destacados para la página principal
     */
    public function destacados($limit = 6) {
        try {
            return $this->productosModel->obtenerDestacados($limit);
        } catch (Exception $e) {
            error_log("Error al obtener productos destacados: " . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Crear un nuevo producto (para admin)
     */
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datos = $this->validarDatosProducto($_POST);
                $id = $this->productosModel->crear($datos);
                
                $_SESSION['mensaje'] = "Producto creado exitosamente";
                header('Location: admin_productos.php');
                exit;
            } catch (Exception $e) {
                $error = $e->getMessage();
                $this->mostrarVista('admin/crear_producto', compact('error'));
            }
        } else {
            $this->mostrarVista('admin/crear_producto');
        }
    }
    
    /**
     * Actualizar un producto existente (para admin)
     */
    public function actualizar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datos = $this->validarDatosProducto($_POST);
                $actualizado = $this->productosModel->actualizar($id, $datos);
                
                if ($actualizado) {
                    $_SESSION['mensaje'] = "Producto actualizado exitosamente";
                } else {
                    $_SESSION['error'] = "No se pudo actualizar el producto";
                }
                
                header('Location: admin_productos.php');
                exit;
            } catch (Exception $e) {
                $error = $e->getMessage();
                $producto = $this->productosModel->obtenerPorId($id);
                $this->mostrarVista('admin/editar_producto', compact('producto', 'error'));
            }
        } else {
            try {
                $producto = $this->productosModel->obtenerPorId($id);
                if (!$producto) {
                    throw new Exception("Producto no encontrado");
                }
                $this->mostrarVista('admin/editar_producto', compact('producto'));
            } catch (Exception $e) {
                $this->manejarError($e->getMessage());
            }
        }
    }
    
    /**
     * Eliminar un producto (para admin)
     */
    public function eliminar($id) {
        try {
            $eliminado = $this->productosModel->eliminar($id);
            
            if ($eliminado) {
                $_SESSION['mensaje'] = "Producto eliminado exitosamente";
            } else {
                $_SESSION['error'] = "No se pudo eliminar el producto";
            }
        } catch (Exception $e) {
            $_SESSION['error'] = "Error al eliminar producto: " . $e->getMessage();
        }
        
        header('Location: admin_productos.php');
        exit;
    }
    
    /**
     * Validar datos del producto
     */
    private function validarDatosProducto($datos) {
        $errores = [];
        
        if (empty($datos['nombre_producto'])) {
            $errores[] = "El nombre del producto es obligatorio";
        }
        
        if (empty($datos['descripcion'])) {
            $errores[] = "La descripción es obligatoria";
        }
        
        if (empty($datos['precio']) || !is_numeric($datos['precio']) || $datos['precio'] <= 0) {
            $errores[] = "El precio debe ser un número mayor a 0";
        }
        
        if (!empty($errores)) {
            throw new Exception(implode(", ", $errores));
        }
        
        return [
            'nombre_producto' => trim($datos['nombre_producto']),
            'descripcion' => trim($datos['descripcion']),
            'precio' => floatval($datos['precio']),
            'imagen_url' => trim($datos['imagen_url'] ?? ''),
            'id_categoria' => !empty($datos['id_categoria']) ? intval($datos['id_categoria']) : null,
            'especie_relacionada' => trim($datos['especie_relacionada'] ?? '')
        ];
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