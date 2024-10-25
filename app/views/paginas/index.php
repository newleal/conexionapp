<?php require_once (APPROOT . '/views/shared/header.php'); ?>
    <h1><?php echo $data['titulo']; ?> Index</h1>

    <?php foreach ($data['posts'] as $posts) {?>
        <ul>
            <li><?php echo $posts['title']; ?></li>
        </ul>
    <?php }?>
<?php require_once (APPROOT . '/views/shared/footer.php'); ?>
