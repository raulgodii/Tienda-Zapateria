
<h2>Iniciar Sesión</h2>

<?php if(!isset($_SESSION['identity'])): ?>

<form action="<?=BASE_URL?>Usuario/login/" method="POST">
    <label for="email">Email</label>
    <input type="email" name="data[email]" id="email" required/>

    <label for="password">Contraseña</label>
    <input type="password" name="data[password]" id="password" required/>
    
    <input type="submit" value="Iniciar Sesión"/>
</form>

<?php else: ?>
    <h3> Has iniciado sesión con exito como: <?= $_SESSION['identity']->nombre?></h3>
<?php endif; ?>