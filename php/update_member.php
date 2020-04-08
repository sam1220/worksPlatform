<?php

 require_once 'db.php';
 require_once 'functions.php';

 $check = update_member($_POST['member_id'],$_POST['un'],$_POST['pw'],$_POST['name']);
 if($check){
     echo 'yes';
 }else{
     echo 'no';
 }

?>