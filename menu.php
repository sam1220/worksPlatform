<?php 
    $page = $_SERVER['PHP_SELF'];
    $page = basename($page,".php");

    switch($page){
        case "article":
        case "article_list":
            $index=1;
            break;
        case "work":    
        case "work_list":
            $index=2;
            break;
        case "about":
            $index=3;
            break;
        case "register":
            $index=4;
            break;    
        default:
            $index=0;
            break;
    }
?>
<div class="menu">
        <h1>作品網站</h1>
        <ul>
            <li><a <?php if($index==0):echo "class='active'"; endif;?> href="index.php">首頁</a></li>
            <li><a <?php if($index==1):echo "class='active'"; endif;?> href="article_list.php">所有文章</a></li>
            <li><a <?php if($index==2):echo "class='active'"; endif;?> href="work_list.php">所有作品</a></li>
            <li><a <?php if($index==3):echo "class='active'"; endif;?> href="about.php">關於我們</a></li>
            <li><a <?php if($index==4):echo "class='active'"; endif;?> href="register.php">註冊</a></li>
        </ul>
    </div>