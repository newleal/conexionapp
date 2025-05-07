<?php echo require APPROOT . '/views/shared/header.php'; ?>
    <a href="<?php echo URLROOT ?>/posts/index">Regresar 🔙</a>
    <h2>Crear Publicacion</h2>
    <p>Por favor ingrese los datros de su publicacion</p>
    <form action="<?php echo URLROOT; ?>/posts/add" method="post">
        <label for="title">Titulo:</label>
        <input type="text" name="title" id="title" value="<?php echo $data['title']; ?>">
        <span><?php echo isset($data['title_err'])? '': $data['title_err']; ?></span>
        <br>

        <label for="body">Contenido:</label>
        <textarea name="body" id="body" rows="5" placeholder="Agregar contenido">
        <?php echo $data['body']; ?>
        </textarea>
        <span><?php echo isset($data['body_err'])? '': $data['body_err']; ?></span>
        <br>

        <input type="submit" value="Crear Post">
    </form>
<?php echo require APPROOT . '/views/shared/footer.php'; ?>
