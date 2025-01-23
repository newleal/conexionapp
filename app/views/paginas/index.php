<?php require (APPROOT . '/views/shared/header.php'); ?>
    <h1><?php echo $data['titulo']; ?></h1>

    <ul>
        <?php foreach ($data['posts'] as $posts) :?>
            <li>
                <?php echo $posts['title']; ?>
            </li>
        <?php endforeach; ?>    
    </ul>
<?php require (APPROOT . '/views/shared/footer.php'); ?>
