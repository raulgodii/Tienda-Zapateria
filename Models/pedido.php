<?php
namespace Models;
use Lib\BaseDatos;

class Pedido {
    
    private $db;
    public function __construct() {
        $this->db = new BaseDatos();
    }

    public function realizar(){
        $pedido = new Pedido();
        $pedido->db->consulta("");
        $pedido->db->cierraConexion();
    }
}