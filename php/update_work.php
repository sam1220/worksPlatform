<?php

    require_once 'db.php';
    require_once 'functions.php';

    $check = update_work($_POST['id'],$_POST['intro'],$_POST['imagePath'],$_POST['videoPath'],$_POST['publish']);
    if($check){
        echo 'yes';
    }else{
        echo 'no';
    }

?>