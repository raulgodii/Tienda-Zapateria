<?php


namespace Routes;

use Controllers\CarritoController;
use Controllers\CategoriaController;
use Controllers\ErrorController;
use Controllers\PedidoController;
use Controllers\ProductoController;
use Lib\Router;
use Controllers\UsuarioController;
class RoutesClass{
    public static function routes(){
        Router::add('GET','/', function (){
            return (new ProductoController())->index();
        });

        Router::add('GET','/error/', function (){
            return (new ErrorController())->error404();
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

        Router::add('GET','/Pedido/Realizar/', function (){
            return (new PedidoController)->realizar();
        });

        Router::add('GET','/Pedido/gestionarPedidos/', function (){
            return (new PedidoController)->gestionar();
        });
        
        Router::add('GET','/Usuario/registrarUsuario/', function (){
            return (new UsuarioController)->registrarUsuario();
        });

        Router::add('GET','/eliminarProducto/:id/', function ($id){
            return (new ProductoController)->eliminarProducto($id);
        });

        Router::add('GET','/eliminarCategoria/:id/', function ($id){
            return (new CategoriaController)->eliminarCategoria($id);
        });

        Router::dispatch();
    }
}