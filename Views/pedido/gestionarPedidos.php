
<?php
use Controllers\PedidoController;
?>

<h1>Gestionar Pedidos</h1>

<?php $pedidos = PedidoController::obtenerPedidos($_SESSION["identity"]->id) ?>

<table>
        <?php foreach($pedidos as $pedido): ?>
        <tr>
            <th>ID</th>
            <th>Localidad</th>
            <th>Coste</th>
            <th>Estado</th>
            <th>Fecha</th>
        </tr>
        <tr>
            <td><?=$pedido["id"]?></td>
            <td><?=$pedido["localidad"]?></td>
            <td><?=$pedido["coste"]?></td>
            <td><?=$pedido["estado"]?></td>
            <td><?=$pedido["fecha"]?></td>
        </tr>
        <?php endforeach; ?>
</table>