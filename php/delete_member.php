<?php

    require_once 'db.php';
    require_once 'functions.php';

    $check = delete_member($_POST['member_id']);
    if($check){
        echo 'yes';
    }else{
        echo 'no';
    }

?>