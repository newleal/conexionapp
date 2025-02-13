<?php require (APPROOT . '/views/shared/header.php') ?>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2>Crear una cuenta</h2>
                <p>Por favor diligencia los campos para registrarte</p>

                <form action="<?php echo URLROOT . '/users/register/';?>" method="post">
                    <div class="form-group">
                        <label for="name">Nombre:<sup>*</sup></label>
                        <input type="text" name="name" id="name" placeholder="Nombre" class="form-control <?php echo (!empty($data['name_err']))? 'is-invalid':'' ?>" value="<?php echo $data['name']?>">
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>
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
                    <div class="form-group">
                        <label for="confirm_password">Confirm contraseña:<sup>*</sup></label>
                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirma contraseña" class="form-control <?php echo (!empty($data['confirm_password_err']))? 'is-invalid':'' ?>" value="<?php echo $data['confirm_password']?>">
                        <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <a href="<?php echo URLROOT.'/users/login' ?>">Ya tienes cuenta?, Incia sesión.</a>
                        </div>
                        <div class="col">
                            <input type="submit" value="Registrar" class="btn btn-primary btn-block">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php require (APPROOT . '/views/shared/footer.php') ?>