<?php require APPROOT . '/views/shared/header.php'; ?>
    <a href="<?php echo URLROOT ?>/posts/index">Regresar 🔙</a>

    <h1><?php echo $data['post']['title']; ?></h1>
    <p>Creado por: <?php echo $data['user']['name']; ?>, el <?php echo $data['post']['create_at']; ?>.</p>
    <p>Session = <?php echo $data['user']['id']; ?></p>
    <p>Id Post = <?php echo $data['post']['id']; ?></p>
    <p><?php echo $data['post']['body']; ?></p>

    <?php if($_SESSION['user_id'] == $data['user']['id']): ?>
        <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']['id']; ?>">Editar</a>
        <a href="<?php echo URLROOT; ?>/posts/delete">Borrar</a>
    <?php endif;?>    
<?php require APPROOT . '/views/shared/footer.php'; ?>