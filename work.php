<?php

    require_once 'php/db.php';
    require_once 'php/functions.php';
    $a_work = get_work($_GET['p']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/frontDest_index.css">
    <title>作品展示</title>
    <style>
        .wrap{
            height:40vh;
        }
        .container{
            width:50%;
            padding-bottom:0;
        }
        img,video{
            max-width:50%;
            height:auto;
            border-radius:5px;
            margin-top:5px;
        }
    </style>
</head>
<body>
    <?php include_once 'menu.php'?>
    <div class="wrap">
        <?php if($a_work): ?>
            <div class="container">
                <h2><?php echo $a_work['intro'];?></h2>
                <?php if($a_work['image_path']):?>
                <img src="<?php echo $a_work['image_path']?>" alt="">
                <?php else:?>
                <video src="<?php echo $a_work['video_path']?>" controls></video>
                <?php endif;?>
            </div>
        <?php else:?>
            <h2>查無作品</h2>    
        <?php endif;?>    
    </div>
    <?php include_once 'footer.php'?>
</body>
</html>