<?php

    require_once 'php/db.php';
    require_once 'php/functions.php';
    $article = get_article($_GET['p']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/frontDest_index.css">
    <title>作品網站</title>
    <style>
        .container{
            margin:10px;
        }
        .container a{
            text-decoration:none;
            color:#115ff0;
        }
    </style>
</head>
<body>
    <?php include_once 'menu.php'?>
    <div class="wrap">
        <?php if($article): ?>
            <div class="container">
                <h2><?php echo $article['title'];?></h2>
                <?php echo $article['content'];?>
            </div>
        <?php else:?>
            <h2>尚無文章</h2>    
        <?php endif;?>    
    </div>
    <?php include_once 'footer.php'?>
</body>
</html>