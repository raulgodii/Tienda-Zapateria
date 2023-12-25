
<?php
use Controllers\CategoriaController;
?>

<h1>Gestionar Categorias</h1>
<a href="<?=BASE_URL?>Categoria/crearCategoria/">Crear Categoria</a></button>

<?php $categorias = CategoriaController::obtenerCategorias() ?>

<table>
        <?php foreach($categorias as $categoria): ?>
        <tr>
            <td><?=$categoria['nombre']?></td>
            <td><?=$categoria['id']?></td>
        </tr>
        <?php endforeach; ?>
</table>