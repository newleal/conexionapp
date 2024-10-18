<?php require_once(APPROOT . '/views/shared/header.php'); ?>
    <h1><?php echo $data['titulo']; ?></h1>

    <ul>
        <?php foreach($data['posts'] as $post) { ?>
            <li><?php echo $post['title']   ; ?></li>
        <?php } ?>
    </ul>
    <?php require_once(APPROOT . '/views/shared/footer.php'); ?>