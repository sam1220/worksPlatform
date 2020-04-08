<?php

    @session_start();

    function get_publish_article(){
        $datas = array();
        $sql = "SELECT *FROM `article` WHERE `publish`=1;";
        $query = mysqli_query($_SESSION['link'],$sql);
        if(mysqli_num_rows($query)>0){
            while($row = mysqli_fetch_assoc($query)){
                $datas[]=$row;
            }
            mysqli_free_result($query);
        }else{
            echo 'error'.mysqli_error($_SESSION['link']);
        }
        return $datas;
    }

    function get_article($id){
        $result = null;
        $sql = "SELECT *FROM `article` WHERE `publish`=1 AND `id`={$id}";
        $query = mysqli_query($_SESSION['link'],$sql);
        if($query){
            if(mysqli_num_rows($query)==1){
                $result = mysqli_fetch_assoc($query);
            }
            mysqli_free_result($query);
        }else{
            echo 'error:'.mysqli_error($_SESSION['link']);
        }
        // mysqli_cloese($_SESSION['link']);
        return $result;
    }
    function get_publish_works(){
        $datas = array();
        $sql = "SELECT *FROM `works` WHERE `publish`=1; ";
        $query = mysqli_query($_SESSION['link'],$sql);
        if(mysqli_num_rows($query)>0){
            while($row = mysqli_fetch_assoc($query)){
                $datas[]=$row;
            }
        }else{
            echo 'error'.mysqli_error($_SESSION['link']);
        }
        return $datas;
    }
    function get_work($id){
        $result = null;
        $sql = "SELECT *FROM `works` WHERE `publish`=1 AND `id`={$id}";
        $query = mysqli_query($_SESSION['link'],$sql);
        if($query){
            if(mysqli_num_rows($query)==1){
                $result = mysqli_fetch_assoc($query);
            }
            mysqli_free_result($query);
        }else{
            echo "error".mysqli_error($_SESSION['link']);
        }
        return $result;
    }
    function checkHasUser($username){
        $result = null;
        $sql = "SELECT *FROM `user` WHERE `username`='$username';";
        $query = mysqli_query($_SESSION['link'],$sql);
        if($query){
            if(mysqli_num_rows($query)>=1){
                $result = true;
            }
            mysqli_free_result($query);
        }else{
            echo 'error:'.mysqli_error($_SESSION['link']);
        }
        return $result;
    }
    function addUser($username,$password,$name){
        $result = null;
        $password = md5($password);
        $sql = "INSERT INTO `user` (`username`,`password`,`name`) VALUE ('$username','$password','$name')";
        $query = mysqli_query($_SESSION['link'],$sql);
        if(mysqli_affected_rows($_SESSION['link'])==1){
            $result = true;
        }else{
            echo 'error'.mysqli_error($_SESSION[link]);
        }
        return $result;
    }
    function verifyUser($username,$password){
        $datas = null;
        $sql = "SELECT *FROM `user` WHERE `username`='$username' AND `password`='$password';";
        $query = mysqli_query($_SESSION['link'],$sql);
        if($query){
            if(mysqli_num_rows($query)==1){
                $user = mysqli_fetch_assoc($query);
                $_SESSION['login_user_id'] = $user['id'];
                $_SESSION['is_login'] = true;
                $result = true;
            }
            mysqli_free_result($query);
        }else{
            echo 'error'.mysqli_error($_SESSION[link]);
        }
        return $result;
    }
    function get_all_article(){
        $datas = array();
        $sql = "SELECT *FROM `article`;";
        $query = mysqli_query($_SESSION['link'],$sql);
        if($query){
            if(mysqli_num_rows($query)>0){
                while($row = mysqli_fetch_assoc($query)){
                    $datas[] = $row;
                }
            }
            mysqli_free_result($query);
        }else{
            echo 'error'.mysqli_error($_SESSION['link']);
        }
        return $datas;
    }
    function add_article($title,$category,$content,$publish){
        $result = null;
        $create_date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `article`
         (`title`,`category`,`content`,`publish`,`create_time`,`create_user_id`)
         VALUE ('$title','$category','$content',{$publish},'$create_date',{$_SESSION['login_user_id']});";
         $query = mysqli_query($_SESSION['link'],$sql);
         if($query){
            if(mysqli_affected_rows($_SESSION['link'])==1){
                $result = true;
            }
         }else{
             echo 'error'.mysqli_error($_SESSION['link']);
         }
         return $result;
    }
    function get_article_from_back($id){
        $result = null;
        $sql = "SELECT *FROM `article` WHERE `id`={$id};";
        $query = mysqli_query($_SESSION['link'],$sql);
        if($query){
            if(mysqli_num_rows($query)==1){
                $result = mysqli_fetch_assoc($query);
            }
            mysqli_free_result($query);
        }else{
            echo 'error:'.mysqli_error($_SESSION['link']);
        }
        return $result;
    }
    function update_article($title,$category,$content,$publish,$article_id){
        $result = null;
        date_default_timezone_set("Asia/Taipei");
        date_default_timezone_get();
        $modify_date = date('Y/m/d h:i:s a', time());
        $sql = "UPDATE `article` 
        SET `title`='$title',`category`='$category',`content`='$content',`publish`={$publish},`modify_time`='$modify_date'
        WHERE `id`={$article_id};";
        $query = mysqli_query($_SESSION['link'],$sql);
        if($query){
            if(mysqli_affected_rows($_SESSION['link'])==1){
                $result = true;
            }
        }else{
            echo 'error:'.mysqli_error($_SESSION['link']);
        }
        return $result;
    }
    function delete_article($id){
        $result = null;
        $sql = "DELETE FROM `article` WHERE `id`={$id};";
        $query = mysqli_query($_SESSION['link'],$sql);
        if($query){
            if(mysqli_affected_rows($_SESSION['link'])==1){
                $result = true;
            }
        }else{
            echo 'error:'.mysqli_error($_SESSION['link']);
        }
        return $result;
    }
    function get_all_member(){
        $datas = array();
        $sql = "SELECT *FROM `user`;";
        $query = mysqli_query($_SESSION['link'],$sql);
        if($query){
            if(mysqli_num_rows($query)>0){
                while($row = mysqli_fetch_assoc($query)){
                    $datas[] = $row;
                }
            }
            mysqli_free_result($query);
        }else{
            echo 'error:'.mysqli_error($_SESSION['link']);
        }
        return $datas;
    }
    function delete_member($id){
        $result = null;
        $sql = "DELETE FROM `user` WHERE `id`={$id};";
        $query = mysqli_query($_SESSION['link'],$sql);
        if($query){
            if(mysqli_affected_rows($_SESSION['link'])==1){
                $result = true;
            }
        }else{
            echo 'error:'.mysqli_error($_SESSION['link']);
        }
        return $result;
    }
    function get_user($id){
        $data = null;
        $sql = "SELECT *FROM `user` WHERE `id`={$id};";
        $query = mysqli_query($_SESSION['link'],$sql);
        if($query){
            if(mysqli_num_rows($query)==1){
                $data = mysqli_fetch_assoc($query);
            }
            mysqli_free_result($query);
        }else{
            echo 'error:'.mysqli_error($_SESSION['link']);
        }
        return $data;
    }
    function update_member($id,$username,$password,$name){
        $result = null;
        $sql = "UPDATE `user` SET `username`='$username',`password`='$password',`name`='$name' WHERE `id`={$id};";
        $query = mysqli_query($_SESSION['link'],$sql);
        if($query){
            if(mysqli_affected_rows($_SESSION['link'])==1){
                $result = true;
            }
        }else{
            echo 'error:'.mysqli_error($_SESSION['link']);
        }
        return $result;
    }
    function get_all_work(){
        $datas = array();
        $sql = "SELECT *FROM `works`;";
        $query = mysqli_query($_SESSION['link'],$sql);
        if($query){
            if(mysqli_num_rows($query)>0){
                while($row = mysqli_fetch_assoc($query)){
                    $datas[] = $row;
                }
            }
            mysqli_free_result($query);
        }else{
            echo 'error:'.mysqli_error($_SESSION['link']);
        }
        return $datas;
    }
    function add_work($intro,$image_path,$video_path,$publish){
        $result = null;
        date_default_timezone_set("Asia/Taipei");
        date_default_timezone_get();
        $create_date = date('Y/m/d h:i:s a', time());
        $image_path_value = "'{$image_path}'";
        $video_path_value = "'{$video_path}'";
        if($image_path==''){
            $image_path_value = "NULL";
        }
        if($video_path==''){
            $video_path_value = "NULL";
        }
        $sql = "INSERT INTO `works`
         (`intro`,`image_path`,`video_path`,`publish`,`create_time`,`create_user_id`)
         VALUE ('$intro',{$image_path_value},{$video_path_value},{$publish},'$create_date',{$_SESSION['login_user_id']});";
         $query = mysqli_query($_SESSION['link'],$sql);
         if($query){
            if(mysqli_affected_rows($_SESSION['link'])>=1){
                $result = true;
            }
         }else{
             echo 'error:'.mysqli_error($_SESSION['link']);
         }
         return $result;
    }
    function get_work_from_back($id){
        $data = null;
        $sql = "SELECT *FROM `works` WHERE `id`={$id};";
        $query = mysqli_query($_SESSION['link'],$sql);
        if($query){
            if(mysqli_num_rows($query)>0){
                $data = mysqli_fetch_assoc($query);
            }
            mysqli_free_result($query);
        }else{
            echo 'error:'.mysqli_error($_SESSION['link']);
        }
        return $data;
    }
    function update_work($id,$intro,$image_path,$video_path,$publish){
        $result = null;
        $work = get_work_from_back($id);
        if(!is_null($work['image_path'])){
            if(file_exists('../'.$work['image_path'])){
                if($work['image_path']!=$image_path){
                    unlink('../'.$work['image_path']);
                }
            }
        }
        
        if(!is_null($work['video_path'])){
            if(file_exists('../'.$work['video_path'])){
                if($work['video_path']!=$video_path){
                    unlink('../'.$work['video_path']);
                }
            }
        }
        
        $image_path_value = "'{$image_path}'";
        $video_path_value = "'{$video_path}'";
        if($image_path=='../' || $image_path==''){
            $image_path = "NULL";
        }
        if($video_path=='../' || $video_path==''){
            $video_path = "NULL";
        }
        date_default_timezone_set("Asia/Taipei");
        date_default_timezone_get();
        $modify_date = date('Y/m/d h:i:s a', time());
        
        $sql = "UPDATE `works` SET 
            `intro`='$intro',`image_path`={$image_path_value}
            ,`video_path`={$video_path_value},`modify_time`='$modify_date',`publish`={$publish}
            WHERE `id`={$id};";
        $query = mysqli_query($_SESSION['link'],$sql);
        if($query){
            if(mysqli_affected_rows($_SESSION['link'])==1){
                $result = true;
            }
        }else{
            echo 'error:'.mysqli_error($_SESSION['link']);
        }
        return $result;
    }
    function del_work($id){
        $result = null;
        $work = get_work_from_back($id);
        if($work['image_path']!=null){
            if(file_exists('../'.$work['image_path'])){
                unlink('../'.$work['image_path']);
            }
        }
        if($work['video_path']!=null){
            if(file_exists('../'.$work['video_path'])){
                unlink('../'.$work['video_path']);
            }
        }
        $sql = "DELETE FROM `works` WHERE `id`={$id};";
        $query = mysqli_query($_SESSION['link'],$sql);
        if($query){
            if(mysqli_affected_rows($_SESSION['link'])==1){
                $result = true;
            }
        }else{
            echo 'error:'.mysqli_error($_SESSION['link']);
        }
        return $result;
        // return $work;
    }
    

?>