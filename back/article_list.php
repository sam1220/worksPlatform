<?php

    require_once '../php/db.php';
    require_once '../php/functions.php';

    if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']){
        header('location: login.php');
    }

    $datas = get_all_article();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/frontDest_index.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <title>後台-文章列表</title>
    <style>
        .wrapper{
            width:80%;
        }
        .wrapper>a{
            text-decoration:none;
            display:block;
            border:1px solid #444444;
            border-radius:5px;
            background-color:#137ef0;
            color:#fff;
            font-weight:bold;
            padding:3.5px;
            align-self:flex-start;
            width:8%;
            text-align:center;
        }
        table{
            width:100%;
        }
        table tr{
            display:flex;
            border-radius:5px;
            padding:5px;
        }
       .first{
            background-color:#444444;
            color:#fff;
        }
        table tr th,table tr td{
            width:20%;
        }
        tr td{
            text-align:center;
        }
        tr:not([class='first']):hover{
            background:#aaa;
        }
        td a{
            display:inline-block;
            border:1px solid #444444;
            border-radius:5px;
            background-color:#137ef0;
            color:#fff;
            font-weight:bold;
            padding:5px;
            text-decoration:none;
        }
    </style>
</head>
<body>
    <?php include_once 'menu.php'?>
    <div class="wrap">
        <div class="wrapper">
            <a href="article_add.php">新增文章</a>
            <table>
                <tr class='first'>
                    <th>分類</th>
                    <th>標題</th>
                    <th>是否發布</th>
                    <th>發布時間</th>
                    <th>管理動作</th>
                </tr>
                <?php if(!empty($datas)):?>
                    <?php foreach($datas as $a_data):?>
                        <tr>
                            <td><?php echo $a_data['category']?></td>
                            <td><?php echo $a_data['title']?></td>
                            <td><?php echo ($a_data['publish'])?'發布中':'下架中'?></td>
                            <td><?php echo $a_data['create_time']?></td>
                            <td>
                                <a href="article_edit.php?i=<?php echo $a_data['id']?>">編輯</a>
                                <a href="javascript:void(0);" class='del' data-id='<?php echo $a_data['id'];?>'>刪除</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                <?php else:?>
                    <tr>
                        <td colspan='5'>無資料</td>
                    </tr>
                <?php endif;?>
            </table>
        </div>
    </div>
    <?php include_once 'footer.php'?>
    <script>
        window.onload = (function(){
            $('.del').on('click',function(){
                let c = confirm('確定刪除這篇文章嗎?');
                let this_tr = $(this).parent().parent();
                if(c){
                    $.ajax({
                        type:'POST',
                        url:'../php/delete_article.php',
                        data:{
                            article_id:$('.del').attr("data-id")
                        },
                        datatype:'html'
                    }).done(function(data){
                        console.log(data);
                        if(data=='yes'){
                            alert('刪除成功');
                            this_tr.fadeOut();
                        }else{
                            alert('刪除發生錯誤');
                        }        
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        //失敗的時候
                        alert("有錯誤產生，請看 console log");
                        console.log(jqXHR.responseText);
                    });
                }
            })
        })
    </script>
</body>
</html>