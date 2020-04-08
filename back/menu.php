<?php 
    $page = $_SERVER['PHP_SELF'];
    $page = basename($page,".php");

    switch($page){
        case "article":
        case "article_add":
        case "article_edit":    
            $index=1;
            break;
        case "work_list":    
        case "work_add":
        case "work_edit":    
            $index=2;
            break;
        case "memeber_list":
            $index=3;
            break;    
        default:
            $index=0;
            break;
    }
?>
<div class="menu">
        <h1>作品網站</h1>
        <ul>
            <li><a href="../index.php">回前台首頁</a></li>
            <li><a <?php if($index==0):echo "class='active'"; endif;?> href="index.php">後台首頁</a></li>
            <li><a <?php if($index==1):echo "class='active'"; endif;?> href="article_list.php">文章管理</a></li>
            <li><a <?php if($index==2):echo "class='active'"; endif;?> href="work_list.php">作品管理</a></li>
            <li><a <?php if($index==3):echo "class='active'"; endif;?> href="member_list.php">會員管理</a></li>
            <li><a href="../php/logout.php">登出</a></li>
        </ul>
    </div>