
<?php
use Controllers\ProductoController;
?>

<h1>Gestionar Productos</h1>
<a href="<?=BASE_URL?>Producto/crearProducto/">Crear Producto</a></button>

<?php $productos = ProductoController::obtenerProductos() ?>

<table>
        <?php foreach($productos as $producto): ?>
        <tr>
            <td><?=$producto['nombre']?></td>
            <td><?=$producto['id']?></td>
            <td><img src="../../img/<?=$producto['imagen']?>" alt="img"></td>
        </tr>
        <?php endforeach; ?>
</table>