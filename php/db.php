<?php

    @session_start();

    $host = 'localhost';
    $username = 'root';
    $password = 'sam1010160';
    $db = 'my_db';

    $_SESSION['link'] = mysqli_connect($host,$username,$password,$db);
    if(!$_SESSION['link']){
        echo 'connect error:'.mysqli_connect_error();
    }else{
        mysqli_query($_SESSION['link'],"SET NAMES utf8");
        // echo 'connect successful';
    }

?>