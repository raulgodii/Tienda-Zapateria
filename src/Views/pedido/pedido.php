<?php if(isset($noLog)): ?>
    <p><b>Error:</b> Para realizar el pedido debes de estar logeado previamente</p>
<?php else: ?>
    <p>Pedido número <?=$idPedido?> realizado con éxito, se ha enviado la confirmación a su correo.</p>
<?php endif; ?>