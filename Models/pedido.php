<?php
namespace Models;
use Lib\BaseDatos;

class Pedido {
    
    private $db;
    public function __construct() {
        $this->db = new BaseDatos();
    }

    public static function realizar($usuario_id, $provincia, $localidad, $direccion, $coste, $estado, $fecha, $hora, $carrito){
        $pedido = new Pedido();
        $pedido->db->consulta("INSERT INTO pedidos (usuario_id, provincia, localidad, direccion, coste, estado, fecha, hora) VALUES ($usuario_id, \"{$provincia}\", \"{$localidad}\", \"{$direccion}\", $coste, \"{$estado}\", \"{$fecha}\", \"{$hora}\")");
        $pedidoId = $pedido->db->lastInsertId();
        $pedido->db->cierraConexion();
        $pedido->lineaPedido($carrito, $pedidoId);
    }

    private function lineaPedido($carrito, $pedidoId){
        $pedido = new Pedido();
        foreach($carrito as $productoId => $cantidad){
            $pedido->db->consulta("INSERT INTO lineas_pedidos (pedido_id, producto_id, unidades) VALUES ($pedidoId, $productoId, $cantidad)");
        }
        $pedido->db->cierraConexion();
    }
}