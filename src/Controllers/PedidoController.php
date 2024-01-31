<?php

namespace Controllers;
use Lib\Pages;
use Models\Pedido;

class PedidoController {

    private Pages $pages;

    public function __construct(){
        $this->pages = new Pages();
    }

    public function realizar(){
        if(isset($_SESSION["identity"])){
            $usuario_id = $_SESSION["identity"]->id; 
            $provincia = "Granada";
            $localidad = "Granada";
            $direccion = "Calle nombrecalle, 99";
            $coste = $this->costeTotal();
            $estado = "Procesando";
            $fecha = date("Y-m-d");
            $hora = date("H:i:s");
            $nombreUsuario = $_SESSION["identity"]->nombre;

            $id = Pedido::realizar($usuario_id, $provincia, $localidad, $direccion, $coste, $estado, $fecha, $hora, $_SESSION["carrito"],$nombreUsuario);
            $carritoController = new CarritoController();
            $carritoController->vaciar();
            $this->pages->render("pedido/pedido", ["idPedido" => $id]);
        } else {
            $this->pages->render("pedido/pedido", ["noLog"=>true]);
        }
    }

    public static function obtenerPedidos($usuario_id): ?array{
        return Pedido::getAll($usuario_id);
    }

    public function gestionar(){
        $this->pages->render("pedido/gestionarPedidos");
    }

    private function costeTotal(){
        $total = 0;
        foreach ($_SESSION["carrito"] as $codigoProducto => $cantidad){
            $total += ProductoController::getPrecio($codigoProducto)*$cantidad;
        }
        return $total;
    }
}