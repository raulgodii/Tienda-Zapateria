<?php
namespace Models;
use Lib\BaseDatos;
use PDO;

class Categoria {
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
        $categoria = new Categoria();
        $categoria->db->consulta("SELECT * FROM categorias ORDER BY id DESC");
        $categorias = $categoria->db->extraer_todos();
        $categoria->db->cierraConexion();
        return $categorias;
    }

    public static function guardarCategoria($nuevaCategoria):void{
        $categoria = new Categoria();
        $categoria->db->consulta("INSERT INTO categorias (nombre) VALUES (\"$nuevaCategoria\")");
        $categoria->db->cierraConexion();
    }
}
