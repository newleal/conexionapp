<?php require (APPROOT . '/views/shared/header.php') ?>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2>Crear una cuenta</h2>
                <p>Por favor diligencia los campos para iniciar sesión</p>

                <form action="<?php echo URLROOT . '/users/login/'?>" method="post">
                    <div class="form-group">
                        <label for="email">Email:<sup>*</sup></label>
                        <input type="email" name="email" id="email" placeholder="email" class="form-control <?php echo (!empty($data['email_err']))? 'is-invalid':'' ?>" value="<?php echo $data['email']?>">
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:<sup>*</sup></label>
                        <input type="password" name="password" id="password" placeholder="Ingresa contraseña" class="form-control <?php echo (!empty($data['password_err']))? 'is-invalid':'' ?>" value="<?php echo $data['password']?>">
                        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <a href="<?php echo URLROOT.'/users/register' ?>">No tienes cuenta?, registrate.</a>
                        </div>
                        <div class="col">
                            <input type="submit" value="Inicia sesion" class="btn btn-primary btn-block">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php require (APPROOT . '/views/shared/footer.php') ?>