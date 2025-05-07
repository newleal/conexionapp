<?php echo require APPROOT . '/views/shared/header.php'; ?>
    <h2>Editar publicacion</h2>
    <p>Modificar lso datos de la publicacion</p>
    <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="post">
        <label for="title">Titulo:</label>
        <input type="text" name="title" value="<?php echo $data['title']; ?>"><br>
        <span><?php echo empty($adata['title_err'])? '':$adata['title_err']; ?></span>
        <br><br>

        <textarea name="body" id="body" rows="5">
            <?php echo $data['body']; ?>
        </textarea>
        <br>
        <span><?php echo empty($adata['body_err'])? '':$adata['body_err']; ?></span>
        <br>
        <input type="submit" value="Actualizar Publicacion">
    </form>
<?php echo require APPROOT . '/views/shared/footer.php'; ?>