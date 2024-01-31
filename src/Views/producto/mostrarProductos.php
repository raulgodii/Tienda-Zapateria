
<?php
use Controllers\ProductoController;
?>

<h1>Productos TOP</h1>

<?php $productos = ProductoController::obtenerProductos() ?>

<table>
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Comprar</th>
    </tr>
        <?php foreach($productos as $producto): ?>
        <tr>
            <td><img style="width: 20px;"src="<?=BASE_URL?>public/img/<?=$producto["imagen"]?>" alt="img"></td>
            <td><?=$producto['nombre']?></td>
            <td><a href="<?=BASE_URL?>Carrito/Agregar/<?=$producto["id"]?>">Comprar</a></td>
        </tr>
        <?php endforeach; ?>
</table>