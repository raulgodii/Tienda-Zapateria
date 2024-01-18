<?php
session_start();

require_once '../vendor/autoload.php';
require_once '../Config/config.php';

$dotendv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
$dotendv->safeLoad();

use Routes\RoutesClass;

$routes = new RoutesClass();

RoutesClass::routes();