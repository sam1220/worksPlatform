<?php

    require_once 'db.php';
    require_once 'functions.php';

    $check = delete_article($_POST['article_id']);
    if($check){
        echo 'yes';
    }else{
        echo 'no';
    }

?>