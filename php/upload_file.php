<?php

    // print_r($_FILES);
    // echo '<hr>';
    // print_r($_POST);

    if(file_exists($_FILES['file']['tmp_name'])){
        $targetFolder = $_POST['save_path'];
        $fileName = $_FILES['file']['name'];
        if(move_uploaded_file($_FILES['file']['tmp_name'],"../".$targetFolder.$fileName)){
            echo 'yes';
        }
        else{
            echo '確認'.$_POST['save_path'].'可寫入';
        }
    }else{
        echo '檔案不存在';
    }
?>