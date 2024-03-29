
<h2>Crear una cuenta</h2>

<?php use Utils\Utils; ?>

<?php if(isset($_SESSION['register']) && $_SESSION['register'] === 'complete'): ?>
    <strong>Registro completado correctamente</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] === 'failed'): ?>
    <strong>Registro fallido, introduzca bien los datos</strong>
<?php endif; ?>



<?php Utils::deleteSession('register');?>

<form action="<?=BASE_URL?>Usuario/registro/" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="data[nombre]" id="nombre" required/>

    <label for="apellidos">Apellidos</label>
    <input type="text" name="data[apellidos]" id="apellidos" required/>

    <label for="email">Email</label>
    <input type="email" name="data[email]" id="email" required/>

    <label for="password">Contraseña</label>
    <input type="password" name="data[password]" id="password" required/>
    
    <input type="submit" value="Registrarse"/>
</form>