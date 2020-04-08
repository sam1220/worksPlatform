<?php

    require_once 'php/db.php';
    require_once 'php/functions.php';
    $datas = get_publish_article();
    
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
        <?php if(!empty($datas)): ?>
            <?php foreach($datas as $data): ?>
            <?php 
                $abstract = strip_tags($data['content']);
                $abstract = mb_substr($abstract,0,100,'UTF-8');    
            ?>    
            <div class="container">
                <h2><a href="article.php?p=<?php echo $data['id'];?>"><?php echo $data['title'];?></a></h2>
                <?php echo $abstract." <a href='#'>more...</a>";?>
            </div>
            <?php endforeach;?>
        <?php else:?>
            <h2>尚無文章</h2>    
        <?php endif;?>    
    </div>
    <?php include_once 'footer.php'?>
</body>
</html>