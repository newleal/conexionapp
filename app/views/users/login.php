<?php require(APPROOT.'/views/shared/header.php'); ?>
    <h1>Ingresa a tu cuenta</h1>

    <?php  flash('register_success') ?>
    <form action="<?php echo URLROOT ?>/users/login" method="post">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Escribe tu email" value="<?php echo $data['email']; ?>">
        <span><?php echo $data['email_err']; ?></span></br></br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" placeholder="Escribe una contraseña" value="<?php echo $data['password']; ?>">
        <span><?php echo $data['password_err']; ?></span></br></br>

        <p>¿No tienes cuenta? <a href="<?php echo URLROOT ?>/users/register">Registrate</a></p>
        <input type="submit" value="Ingresar">
    </form>
<?php require(APPROOT.'/views/shared/footer.php'); ?>