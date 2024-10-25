<?php require_once(APPROOT . '/views/shared/header.php'); ?>
<div class="jumbotron">
    <h1 class="display-3">Register</h1>

    <div class="row">
        <div class="col-mb-6 mx-auto">
            <div class="card card-body bg-ligth mt-5">
                <h2>Crear una Cuenta</h2>
                <p>Por favor llena los campos para registrarte</p>

                <?php echo !empty($mesaje['mensaje']) ? $mesaje['mensaje']: '';?>
                <?php echo var_dump($data);?>

                <form  action="<?php echo URLROOT . '/users/register'; ?>" method="post">
                    
                    <div class="form-group">
                        <label for="name">Nombre:<sup>*</sup></label>
                        <input type="text" name="name" id="name" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name'] ?>"  placeholder="Nombre" >
                        <span class="'invalid-feedback'"><?php echo $data['name_err']; ?></span>
                    </div>

                    <div class="form-group">
                            <label for="email">Email: <sup>*</sup></label>
                            <input type="email" name="email" id="email" class="form-control <?php echo (!empty($data['email_err']))? 'is-invalid':''; ?>" value="<?php echo $data['email']; ?>">
                            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="password">Contraseña: <sup>*</sup></label>
                            <input type="password" name="password" id="password" class="form-control <?php echo (!empty($data['password_err']))? 'is-invalid':''; ?>" value="<?php echo $data['password']; ?>">
                            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirmar Contraseña: <sup>*</sup></label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control <?php echo (!empty($data['confirm_password_err']))? 'is-invalid':''; ?>" value="<?php echo $data['confirm_password']; ?>">
                            <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                        </div>
                        <div class="row">
                            <div class="col">
                                <a href="<?php echo URLROOT; ?>/users/login">¿Ta tienes cuenta?, inicia sesion</a>
                            </div>
                            <div class="col">
                                <input type="submit" value="Registrar" class="btn btn-primary btn-block">
                            </div>
                        </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once(APPROOT . '/views/shared/footer.php'); ?>