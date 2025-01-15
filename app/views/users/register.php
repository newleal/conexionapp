<?php require (APPROOT . '/views/shared/header.php') ?>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2>Crear una cuenta</h2>
                <p>Por favor diligencia los campos para registrarte</p>

                <form action="<?php echo APPROOT . '/users/register/'?>" method="post">
                    <div class="form-group">
                        <label for="name">Nombre:<sup>*</sup></label>
                        <input type="text" name="name" id="name" placeholder="Nombre" class="form-control <?php echo (!empty($data['name_err']))? 'is-invalid':'' ?>" value="<?php echo $data['name']?>">
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:<sup>*</sup></label>
                        <input type="email" email="email" id="email" placeholder="email" class="form-control <?php echo (!empty($data['email_err']))? 'is-invalid':'' ?>" value="<?php echo $data['email']?>">
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

<?php require (APPROOT . '/views/shared/footer.php') ?>