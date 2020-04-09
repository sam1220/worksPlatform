<?php

    require_once 'db.php';
    require_once 'functions.php';

    $check = add_work($_POST['intro'],$_POST['imagePath'],$_POST['videoPath'],$_POST['publish']);
    if($check){
        echo 'yes';
    }else{
        echo 'no';
    }

    // print_r($_POST['intro']);

?>