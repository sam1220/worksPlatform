<?php 

    require_once 'db.php';
    require_once 'functions.php';

    $check = verifyUser($_POST['un'],$_POST['pw']);
    if($check){
        echo 'yes';
    }else{
        echo 'no';
    }

?>