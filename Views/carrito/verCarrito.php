<!-- carrito.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <!-- Agrega aquí tus enlaces a hojas de estilo, si es necesario -->
</head>
<body>

<h1>Carrito de Compras</h1>

<?php
use Controllers\ProductoController;
$productoController = new ProductoController();

// Obtener el contenido del carrito desde la sesión
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
$total = 0;

if (empty($carrito)): ?>
    <p>El carrito está vacío.</p>
<?php else: ?>
    <table border="1">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($carrito as $codigoProducto => $cantidad): ?>
                <?php
                $nombreProducto = $productoController::getNombre($codigoProducto);
                $precioProducto = $productoController::getPrecio($codigoProducto);
                ?>
                <tr>
                    
                    <td><?= $codigoProducto ?></td>
                    <td><?= $nombreProducto ?></td>
                    <td><?= $precioProducto ?></td>
                    <td><?= $cantidad ?></td>
                    <?php $subtotal =  $precioProducto * $cantidad?>
                    <?php $total+=$subtotal?>
                    <td><?= $subtotal?></td>
                    <td>
                        <a href="<?=BASE_URL?>Carrito/Quitar/<?=$codigoProducto?>">Quitar 1 unidad</a>
                        <a href="<?=BASE_URL?>Carrito/Agregar/<?=$codigoProducto?>">Agregar 1 unidad</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">Total:</td>
                <td><?= $total ?></td>
                <td><a href="<?=BASE_URL?>Carrito/Vaciar/">Vaciar carrito</a></td>
            </tr>
        </tfoot>
    </table>

    <p>
        <a href="<?=BASE_URL?>">Seguir comprando</a>
        <td><a href="<?=BASE_URL?>Pedido/Realizar/">Realizar Pedido</a></td>
    </p>
<?php endif; ?>

</body>
</html>