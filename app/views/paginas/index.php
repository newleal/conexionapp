<?php require(APPROOT.'/views/shared/header.php'); ?>
    <h1><?php echo $data['titulo']; ?></h1>

    <?php if(isset($data['posts']) && is_array($data['posts'])): ?>
        <?php  foreach($data['posts'] as $post){ ?>
            <ul>
                <li><?php echo $post['title']; ?></li>
            </ul>
        <?php } ?>    
    <?php else: ?>
        <p>No hay datos para mostrar</p>
    <?php endif; ?>  
    
    <p>Version de la aplicacion: <?php echo APPVERSION; ?></p>
<?php require(APPROOT.'/views/shared/footer.php'); ?>