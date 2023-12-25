
<?php
use Controllers\ProductoController;
?>

<h1>Crear Producto</h1>

<form action="<?=BASE_URL?>Producto/guardarProducto/" method="post" enctype="multipart/form-data">
    <label for="categoria">Categoría:</label>
    <select name="producto[categoria_id]" id="categoria" required>
        <?php foreach($categorias as $categoria): ?>
            <option value="<?=$categoria['id']?>"><?=$categoria['nombre']?></option>
        <?php endforeach; ?>
    </select>
    <br>

    <label for="nombre">Nombre:</label>
    <input type="text" name="producto[nombre]" id="nombre" required>
    <br>

    <label for="descripcion">Descripción:</label>
    <textarea name="producto[descripcion]" id="descripcion" rows="4"></textarea>
    <br>

    <label for="precio">Precio:</label>
    <input type="number" name="producto[precio]" id="precio" step="0.01" required>
    <br>

    <label for="stock">Stock:</label>
    <input type="number" name="producto[stock]" id="stock" required>
    <br>

    <label for="oferta">Oferta (opcional):</label>
    <input type="text" name="producto[oferta]" id="oferta">
    <br>

    <label for="fecha">Fecha:</label>
    <input type="date" name="producto[fecha]" id="fecha" required>
    <br>

    <label for="imagen">Imagen:</label>
    <input type="file" name="producto[imagen]" id="imagen">
    <br>

    <input type="submit" value="Agregar Producto">
</form>
