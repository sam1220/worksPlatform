<?php 

    require_once 'db.php';
    require_once 'functions.php';

    $check = del_work($_POST['work_id']);
    if($check){
        echo 'yes';
    }else{
        echo 'no';
    }

    // print_r($_POST);
    // print_r(del_work($_POST['work_id']));

?>