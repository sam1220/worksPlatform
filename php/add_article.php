<?php

    require_once 'db.php';
    require_once 'functions.php';

    $check = add_article($_POST['title'],$_POST['category'],$_POST['content'],$_POST['publish']);
    if($check){
        echo 'yes';
    }else{
        echo 'no';
    }

?>