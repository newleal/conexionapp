<?php require(APPROOT.'/views/shared/header.php'); ?>
    <h1>Registrar una cuenta</h1>
    <form action="<?php echo URLROOT ?>/users/register" method="post">

        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" placeholder="Escribe tu nombre" value="<?php echo $data['name']; ?>">
        <span><?php echo $data['name_err']; ?></span></br></br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Escribe tu email" value="<?php echo $data['email']; ?>">
        <span><?php echo $data['email_err']; ?></span></br></br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" placeholder="Escribe una contraseña" value="<?php echo $data['password']; ?>">
        <span><?php echo $data['password_err']; ?></span></br></br>

        <label for="confirm_password">Confirmar Contraseña:</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirma la contraseña" value="<?php echo $data['confirm_password']; ?>">
        <span><?php echo $data['confirm_password_err']; ?></span></br></br>

        <p>¿Ya tienes cuenta? <a href="<?php echo URLROOT ?>/users/login">Ingresa</a></p>
        <input type="submit" value="Registrar">
    </form>
<?php require(APPROOT.'/views/shared/footer.php'); ?>