<?php 

    if(file_exists('../'.$_POST['file'])){
        unlink('../'.$_POST['file']);
        echo 'yes';
    }else{
        echo 'not found';
    }

?>