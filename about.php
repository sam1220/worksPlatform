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
    <title>關於我們</title>
    <style>
        .container{
            display:flex;
            text-align:initial;
            background-color:#fff;
        }
        .container .item{
            width:50%;
            padding-right:50px;
        }
    </style>
</head>
<body>
    <?php include_once 'menu.php'?>
    <div class="wrap">
        <div class="container">
            <div class="item">
                <h2>Contact</h2>
                <p>你好!我目前正在尋找網頁開發相關工作，這邊會分享我學習網頁開發的心得以及記錄學習歷程，有興趣可與我聯繫，感謝。</p>
            </div>
            <div class="item">
                <h2>Sam</h2>
                <p>電話:</p>
                <p>email:</p>
            </div>
        </div> 
    </div>
    <?php include_once 'footer.php'?>
</body>
</html>