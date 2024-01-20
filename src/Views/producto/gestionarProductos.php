
<?php
use Controllers\ProductoController;
?>

<h1>Gestionar Productos</h1>
<a href="<?=BASE_URL?>Producto/crearProducto/">Crear Producto</a></button>

<?php $productos = ProductoController::obtenerProductos() ?>

<table>
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>ID</th>
        <th>Accion</th>
    </tr>
        <?php foreach($productos as $producto): ?>
        <tr>
            <td><img style="width: 20px;"src="<?=BASE_URL?>public/img/<?=$producto["imagen"]?>" alt="img"></td>
            <td><?=$producto['nombre']?></td>
            <td><?=$producto['id']?></td>
            <td><a href="<?=BASE_URL?>/eliminarProducto/<?=$producto['id']?>">Eliminar</a></td>
        </tr>
        <?php endforeach; ?>
</table>