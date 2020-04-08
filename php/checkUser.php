<?php

    require_once 'db.php';
    require_once 'functions.php';
    $check = checkHasUser($_POST['un']);
    
    if($check){
        echo 'yes';
    }else{
        echo 'no';
    }

?>