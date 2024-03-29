<?php
use Controllers\CategoriaController;
?>

<?php $categorias = CategoriaController::obtenerCategorias() ?>

<nav id="menu_cat">
    <ul>
        <?php foreach($categorias as $categoria): ?>
        <li>
            <a href="<?=BASE_URL?>Categoria/verProductos/<?=$categoria['id']?>"><?=$categoria['nombre']?></a>
        </li>
        <?php endforeach; ?>
    </ul>
</nav>

<?php if(isset($_SESSION['identity'])): ?>
    <ul>
        <?php if($_SESSION['identity']->rol == "admin"): ?>
            <li><a href="<?=BASE_URL?>Producto/gestionarProductos/">Gestionar productos</a></li>
            <li><a href="<?=BASE_URL?>Categoria/gestionarCategorias/">Gestionar categorias</a></li>
            <li><a href="<?=BASE_URL?>Usuario/registrarUsuario/">Registrar usuario</a></li>
        <?php endif; ?>
            <li><a href="<?=BASE_URL?>Pedido/gestionarPedidos/">Gestionar pedidos</a></li>
            <li><a href="<?=BASE_URL?>Carrito/verCarrito/">Carrito</a></li>
            <li><a href="<?=BASE_URL?>">Inicio</a></li>
    </ul>
<?php endif; ?>


<ul>
<?php if(!isset($_SESSION['identity'])): ?>
    <li><a href="<?=BASE_URL?>">Inicio</a></li>
    <li><a href="<?=BASE_URL?>Usuario/login/">Identificarse</a></li>
    <li><a href="<?=BASE_URL?>Usuario/registro/">Registrarse</a></li>
    <li><a href="<?=BASE_URL?>Carrito/verCarrito/">Carrito</a></li>
<?php else: ?>
    <h2><?=$_SESSION['identity']->nombre?> <?=$_SESSION['identity']->apellidos?></h2>
    <a href="<?=BASE_URL?>Usuario/logout/">Cerrar Sesión</a>
<?php endif; ?>
</ul>