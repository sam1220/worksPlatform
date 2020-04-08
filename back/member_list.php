<?php

    require_once '../php/db.php';
    require_once '../php/functions.php';

    if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']){
        header('location: login.php');
    }

    $members = get_all_member();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/frontDest_index.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <title>後台-會員列表</title>
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
            <a href="member_add.php">新增會員</a>
            <table>
                <tr class='first'>
                    <th>id</th>
                    <th>帳號</th>
                    <th>名稱</th>
                    <th>管理動作</th>
                </tr>
                <?php if(!empty($members)):?>
                    <?php foreach($members as $member):?>
                        <tr>
                            <td><?php echo $member['id']?></td>
                            <td><?php echo $member['username']?></td>
                            <td><?php echo $member['name']?></td>
                            <td>
                                <a href="member_edit.php?i=<?php echo $member['id']?>">編輯</a>
                                <a href="javascript:void(0);" class='del' data-id='<?php echo $member['id'];?>'>刪除</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                <?php else:?>
                    <tr>
                        <td colspan='4'>無資料</td>
                    </tr>
                <?php endif;?>
            </table>
        </div>
    </div>
    <?php include_once 'footer.php'?>
    <script>
        window.onload = (function(){
            $('.del').on('click',function(){
                let c = confirm('確定刪除這位會員嗎?');
                let this_tr = $(this).parent().parent();
                let id = $(this).attr('data-id');
                if(c){
                    $.ajax({
                        type:'POST',
                        url:'../php/delete_member.php',
                        data:{
                            member_id:id
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