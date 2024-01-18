
<?php
use Controllers\CategoriaController;
?>

<h1>Crear Categoria</h1>

<form action="<?=BASE_URL?>Categoria/guardarCategoria/" method="POST">
    <label for="categoria">Nueva Categoria:</label>
    <input type="text" name="categoria" id="categoria" placeholder="Introduce la nueva categoria">
    <input type="submit" value="Crear">
</form>