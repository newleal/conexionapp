<?php require(APPROOT.'/views/shared/header.php'); ?>
    <h1>Posts</h1>
    <a href="<?php echo URLROOT ?>/posts/add">
        <i>🅰️ Crear publicación</i>
    </a>
   
    <ul>
        <?php if(isset($data['posts']) && is_array($data['posts'])): ?>
            <?php foreach($data['posts'] as $post): ?>
                <li>
                    <p><?php echo $post['title']; ?></p>
                    <p>Creado por: <?php echo $post['name']; ?> el <?php echo date( $post['postCreatedAt']); ?></p>
                    <a href="<?php echo URLROOT; ?>/potst/show/">Ver más...</a>
                </li>
            <?php endforeach; ?>
        <?php else : ?>
            <li>No hay datos para mostrar</li>
        <?php endif; ?>    
    </ul>    
    <p>Version de la aplicacion: <?php echo APPVERSION; ?></p>
<?php require(APPROOT.'/views/shared/footer.php'); ?>