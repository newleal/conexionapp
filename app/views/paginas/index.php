<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h2><?php echo $data['titulo']; ?></h2>

    <h3>Listado de Posts</h3>

    <ul>
        <?php foreach ($data['posts'] as $post) {?>
            <li><?php echo $post['title']; ?></li>
       <?php }; ?>     
    </ul>

    
</body>
</html>