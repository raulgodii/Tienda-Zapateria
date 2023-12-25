<?php


namespace Routes;

use Lib\Router;
use Controllers\UsuarioController;
class RoutesClass{
    public static function routes(){
        Router::add('GET','/', function (){
            return "Bienvenido";
        });
        
        Router::add('GET','/Usuario/login/', function (){
            return (new UsuarioController())->identifica();
        });
        
        Router::add('GET','/Usuario/registro/', function (){
            return (new UsuarioController())->registro();
        });
        
        // Ejemplo con tres parametros
        Router::add('GET','/Usuario/prueba/:id', function (int $id){
            return (new UsuarioController())->prueba($id);
        });
        
        
        Router::dispatch();
    }
}