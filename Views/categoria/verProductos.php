<?php if(isset($productos) && isset($categoria)) :?>
    <ul>
        <?php foreach($productos[0] as $producto): ?>
            <li><?=$producto["nombre"]?></li>
        <?php endforeach;?>
    </ul>
<?php endif;?>