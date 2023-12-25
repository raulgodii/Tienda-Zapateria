<?php

// session_start();

// require_once "vendor/autoload.php";
// require_once "Config/config.php";
// $dotendv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotendv->safeLoad();

// use Controllers\FrontController;
// FrontController::main();



    session_start();

    require_once "vendor/autoload.php";
    require_once "Config/config.php";
    $dotendv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotendv->safeLoad();
    
    use Lib\Router;
    use Lib\Pages;
    use Controllers\UsuarioController;
    use Routes\RoutesClass;

    $pages = new Pages();
    $pages->render('layout/header');
    
    $routes = new RoutesClass();

    RoutesClass::routes();
    
