<?php
namespace Models;
use Lib\BaseDatos;
use PDO;

class Producto {
    private $id;
    private $nombre;
    private $db;

    public function __construct() {
        $this->db = new BaseDatos();
    }

    // Getter para el ID
    public function getId() {
        return $this->id;
    }

    // Setter para el ID
    public function setId($id) {
        $this->id = $id;
    }

    // Setter para el nombre
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public static function getAll():?array{
        $producto = new Producto();
        $producto->db->consulta("SELECT * FROM productos ORDER BY id DESC");
        $productos = $producto->db->extraer_todos();
        $producto->db->cierraConexion();
        return $productos;
    }

    public static function getNombre($id){
        $producto = new Producto();
        $producto->db->consulta("SELECT nombre FROM productos WHERE id={$id}");
        $productos = $producto->db->extraer_todos();
        $producto->db->cierraConexion();
        return $productos;
    }

    public static function getPrecio($id){
        $producto = new Producto();
        $producto->db->consulta("SELECT precio FROM productos WHERE id={$id}");
        $productos = $producto->db->extraer_todos();
        $producto->db->cierraConexion();
        return $productos;
    }

    public static function guardarProducto($nuevoProducto):void{
        
        $producto = new Producto();

        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {
            // Obtener información sobre la foto
            $nombreFoto = $_FILES["imagen"]["name"];
            $tipoFoto = $_FILES["imagen"]["type"];
            $rutaTempFoto = $_FILES["imagen"]["tmp_name"];
    
            // Verificar el tipo de la foto
            $tiposPermitidos = ["image/jpeg", "image/png", "image/gif"];
            if (!in_array($tipoFoto, $tiposPermitidos)) {
                echo "Error: El tipo de archivo no está permitido.";
                exit;
            }
    
            // Mover la foto al directorio deseado
            $directorioDestino = "./public/img/";
            $rutaFinalFoto = $directorioDestino . $nombreFoto;
            move_uploaded_file($rutaTempFoto, $rutaFinalFoto);

            // Guardar producto en BD
            var_dump($nuevoProducto);
            $producto->db->consulta("INSERT INTO productos (categoria_id, nombre, descripcion, precio, stock, oferta, fecha, imagen) 
            VALUES ({$nuevoProducto['categoria_id']}, '{$nuevoProducto['nombre']}', '{$nuevoProducto['descripcion']}', {$nuevoProducto['precio']}, {$nuevoProducto['stock']}, '{$nuevoProducto['oferta']}', '{$nuevoProducto['fecha']}', '{$nombreFoto}')"
        );
    
        } else {
            echo "Error: No se pudo cargar la foto.";
            
        }

        $producto->db->cierraConexion();
    }
}
