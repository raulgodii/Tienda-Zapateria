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

    // Getter para el nombre
    public function getNombre() {
        return $this->nombre;
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

    public static function guardarProducto($nuevoProducto):void{
        $producto = new Producto();
        var_dump($nuevoProducto);
        $producto->db->consulta("INSERT INTO productos (categoria_id, nombre, descripcion, precio, stock, oferta, fecha, imagen) 
            VALUES ({$nuevoProducto['categoria_id']}, '{$nuevoProducto['nombre']}', '{$nuevoProducto['descripcion']}', {$nuevoProducto['precio']}, {$nuevoProducto['stock']}, '{$nuevoProducto['oferta']}', '{$nuevoProducto['fecha']}', 'url')"
        );


        $producto->db->cierraConexion();
    }
}
