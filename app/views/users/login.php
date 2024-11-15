<?php require_once (APPROOT . '/shared/header.php'); ?>

<div class="jumbotron">

    <div class="row">
        <div class="col mb-6 mx-auto">
            <h2>Crear una cuenta</h2>
            <p>Por favor llema los campos para registrarte</p>
            
            <from action="<?php echo ROOT; ?>/users/register" method="post">

                <div class="form-goup">
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" id="name" placeholder="Nombre">
                </div>

            </from>
        </div>
    </div>

</div>

<?php require_once (APPROOT . '/shared/footer.php'); ?>