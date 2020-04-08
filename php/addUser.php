<?php

    require_once 'db.php';
    require_once 'functions.php';

    $result = addUser($_POST['un'],$_POST['pw'],$_POST['name']);

    if($result){
        echo 'yes';
    }else{
        echo 'no';
    }

?>