<?php

    require_once 'db.php';
    require_once 'functions.php';

    $check = update_article($_POST['title'],$_POST['category'],$_POST['content'],$_POST['publish'],$_POST['article_id']);
    if($check){
        echo 'yes';
    }else{
        echo 'no';
    }

?>