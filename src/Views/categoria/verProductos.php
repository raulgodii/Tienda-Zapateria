<?php if(isset($productos) && isset($categoria)) :?>
    <ul>
        <?php foreach($productos[0] as $producto): ?>
            <li> <img style="width: 20px;" src="<?=BASE_URL?>public/img/<?=$producto["imagen"]?>" alt="producto"> <?=$producto["nombre"]?> <a href="<?=BASE_URL?>Carrito/Agregar/<?=$producto["id"]?>">Comprar</a></li>
        <?php endforeach;?>
    </ul>
<?php endif;?>