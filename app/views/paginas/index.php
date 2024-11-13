<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?php echo $data['titulo']; ?></h1>
    <ul>
        <?php foreach ($data['posts'] as $post): ?>
            <li>
                <?php echo $post['title']; ?>
            </li>
        <?php endforeach; ?>    
    </ul>
</body>
</html>