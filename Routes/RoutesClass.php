<?php


namespace Routes;

use Controllers\CarritoController;
use Controllers\CategoriaController;
use Controllers\ProductoController;
use Lib\Router;
use Controllers\UsuarioController;
class RoutesClass{
    public static function routes(){
        Router::add('GET','/', function (){
            return "Bienvenido";
        });
        
        Router::add('POST','/Usuario/login/', function (){
            return (new UsuarioController())->login();
        });

        Router::add('GET','/Usuario/login/', function (){
            return (new UsuarioController())->login();
        });
        
        Router::add('GET','/Usuario/registro/', function (){
            return (new UsuarioController())->registro();
        });

        Router::add('POST','/Usuario/registro/', function (){
            return (new UsuarioController())->registro();
        });
        
        // Ejemplo con tres parametros
        Router::add('GET','/Categoria/verProductos/:id', function (int $id){
            return (new CategoriaController())->verProductos($id);
        });

        Router::add('GET','/Usuario/logout/', function (){
            return (new UsuarioController())->logout();
        });

        Router::add('GET','/Categoria/pedidos/', function (){
            return (new CategoriaController)->gestionarCategorias();
        });

        Router::add('GET','/Categoria/crearCategoria/', function (){
            return (new CategoriaController)->crearCategoria();
        });

        Router::add('POST','/Categoria/guardarCategoria/', function (){
            return (new CategoriaController)->guardarCategoria();
        });

        Router::add('GET','/Producto/gestionarProductos/', function (){
            return (new ProductoController)->gestionarProductos();
        });

        Router::add('GET','/Producto/crearProducto/', function (){
            return (new ProductoController)->crearProducto();
        });

        Router::add('GET','/Categoria/gestionarCategorias/', function (){
            return (new CategoriaController)->gestionarCategorias();
        });

        Router::add('POST','/Producto/guardarProducto/', function (){
            return (new ProductoController)->guardarProducto();
        });

        Router::add('GET','/Carrito/verCarrito/', function (){
            return (new CarritoController)->verCarrito();
        });

        Router::add('GET','/Carrito/Agregar/:id', function (int $id){
            return (new CarritoController)->agregar($id);
        });

        Router::add('GET','/Carrito/Quitar/:id', function (int $id){
            return (new CarritoController)->quitar($id);
        });

        Router::add('GET','/Carrito/Vaciar/', function (){
            return (new CarritoController)->vaciar();
        });
        
        Router::dispatch();
    }
}