
<?php
use Controllers\CategoriaController;
?>

<h1>Gestionar Categorias</h1>
<a href="<?=BASE_URL?>Categoria/crearCategoria/">Crear Categoria</a></button>

<?php $categorias = CategoriaController::obtenerCategorias() ?>

<table>
    <tr>
        <th>Nombre</th>
        <th>ID</th>
        <th>Accion</th>
    </tr>
        <?php foreach($categorias as $categoria): ?>
        <tr>
            <td><?=$categoria['nombre']?></td>
            <td><?=$categoria['id']?></td>
            <td><a href="<?=BASE_URL?>/eliminarCategoria/<?=$categoria['id']?>">Eliminar</a></td>
        </tr>
        <?php endforeach; ?>
</table>