<?php

    session_start();

    if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']){
        header('location: login.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/frontDest_index.css">
    <title>後台首頁</title>
</head>
<body>
    <?php include_once 'menu.php'?>
    <div class="wrap">
        <div class="container">
            <p>歡迎來到我的網站</p>
        </div>
    </div>
    <?php include_once 'footer.php'?>
</body>
</html>