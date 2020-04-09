<?php

    require_once '../php/db.php';
    require_once '../php/functions.php';

    if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']){
        header('location: login.php');
    }

    $works = get_all_work();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/frontDest_index.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <title>後台-作品列表</title>
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
            <a href="work_add.php">新增作品</a>
            <table>
                <tr class='first'>
                    <th>簡介</th>
                    <th>圖片路徑</th>
                    <th>影片路徑</th>
                    <th>是否發布</th>
                    <th>發布時間</th>
                    <th>管理動作</th>
                </tr>
                <?php if(!empty($works)):?>
                    <?php foreach($works as $a_work):?>
                        <tr>
                            <td><?php echo $a_work['intro']?></td>
                            <td><?php echo $a_work['image_path']?></td>
                            <td><?php echo $a_work['video_path']?></td>
                            <td><?php echo ($a_work['publish'])?'發布中':'下架中'?></td>
                            <td><?php echo $a_work['create_time']?></td>
                            <td>
                                <a href="work_edit.php?i=<?php echo $a_work['id']?>">編輯</a>
                                <a href="javascript:void(0);" class='del' data-id='<?php echo $a_work['id'];?>'>刪除</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                <?php else:?>
                    <tr>
                        <td colspan='6'>無資料</td>
                    </tr>
                <?php endif;?>
            </table>
        </div>
    </div>
    <?php include_once 'footer.php'?>
    <script>
        window.onload = (function(){
            $('.del').on('click',function(){
                const del_id = $(this).attr('data-id');
                // console.log(del_id);
                let c = confirm('確定刪除這個作品嗎?');
                let this_tr = $(this).parent().parent();
                if(c){
                    $.ajax({
                        type:'POST',
                        url:'../php/delete_work.php',
                        data:{
                            work_id:del_id
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
                return false;
            })
        })
    </script>
</body>
</html>