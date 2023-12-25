<?php
namespace Controllers;
use Models\Producto;
use Lib\Pages;
use Utils\Utils;

class ProductoController{
    private Pages $pages;

    public function __construct(){
        $this->pages = new Pages();
    }

    public static function obtenerProductos(): ?array{
        return Producto::getAll();
    }

    public function gestionarProductos():void{
        $this->pages->render("producto/gestionarProductos");
    }

    public function crearProducto():void{
        $this->pages->render("producto/crearProducto");
    }

    public function guardarProducto():void {
        $nuevoProducto = $_POST['producto'];
        Producto::guardarProducto($nuevoProducto);
        $this->pages->render("producto/gestionarProductos");
    }
}