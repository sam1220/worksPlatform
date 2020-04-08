<?php

    require_once 'php/db.php';
    require_once 'php/functions.php';
    $datas = get_publish_works();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/frontDest_index.css">
    <title>所有作品</title>
    <style>
        .wrap{
            flex-direction:row;
            margin-top:0;
            justify-content:center;
        }
        .container{
            width:25%;
            margin:0 10px;
        }
        .item img{
            max-width:100%;
            height:auto;
        }
        .item video{
            max-width:100%;
            height:auto;
        }
        .item a{
            display:block;
            text-decoration:none;
            color:#aaa;
        }
    </style>
</head>
<body>
    <?php include_once 'menu.php'?>
    <div class="wrap">
        <?php if(!empty($datas)): ?>
            <?php foreach($datas as $work): ?>
            <div class="container">
                <div class="item">
                <?php if($work['image_path']):?>
                    <img src="<?php echo $work['image_path'];?>" alt="">
                    <a href="work.php?p=<?php echo $work['id'];?>"><?php echo $work['intro'];?></a>
                <?php else:?>
                    <video src="<?php echo $work['video_path'];?>" controls></video>
                    <a href="work.php?p=<?php echo $work['id'];?>"><?php echo $work['intro'];?></a>    
                <?php endif;?>
                </div>
            </div>      
            <?php endforeach;?>
        <?php else:?>
            <h2>尚無作品</h2>    
        <?php endif;?>
          
    </div>
    <?php include_once 'footer.php'?>
</body>
</html>