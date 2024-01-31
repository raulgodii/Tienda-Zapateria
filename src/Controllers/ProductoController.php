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

    public function eliminarProducto($id):void {
        Producto::eliminarProducto($id);
        $this->pages->render("producto/gestionarProductos");
    }

    public static function getNombre($id){
        return Producto::getNombre($id)[0]["nombre"];
    }

    public static function getPrecio($id){
        return Producto::getPrecio($id)[0]["precio"];
    }

    public static function getUnidadesDisponibles($codProducto){
        return Producto::getUnidadesDisponibles($codProducto);
    }
}