<?php require_once ( APPROOT . '/views/shared/header.php');?>

<div class="jumbotron">
    <h1 class="dispplay-3">Login</h1>

        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card card-body bg-ligth-mt-5">

                <?php echo flash('register-success'); ?>       
                <h2>Inicia Sesion</h2>
                    <p>Por favor llena los campos para poder ingresar</p>
                    <form action="<?php echo ROOTRUL; ?>/users/login" method="post">
                        

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

                        <div class="row">
                            <div class="col">
                                <a href="<?php echo ROOTRUL; ?>/users/register">¿No tienes cuenta?, registrate</a>
                            </div>
                            <div class="col">
                                <input type="submit" value="Ingresar" class="btn btn-primary btn-block">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <p>Esta es una aplicacion desarrollada por Miguel Angel</p>

<?php require_once ( APPROOT . '/views/shared/footer.php');?>