<?php

    require_once '../php/db.php';
    require_once '../php/functions.php';

    if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']){
        header('location: login.php');
    }

    $member = get_user($_GET['i']);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/frontDest_index.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <title>後台-編輯會員</title>
    <style>
        .container{
            width:50%;
            text-align:initial;
        }
        form{
            display:flex;
            flex-direction:column;
            border:1px solid #fff;
            border-radius:5px;
        }
        form .item{
            margin:10px;
        }
        .item p{
            margin-bottom:5px;
        }
        .item #submit{
            padding:5px;
            border:1px solid #aaa;
            border-radius:5px;
            background-color:#137ef0;
            color:#fff;
            font-weight:700;
        }
        .has_error{
            border:2px solid red;
        }
        .has_succeed{
            border:2px solid green;
        }
    </style>
</head>
<body>
    <?php include_once 'menu.php'?>
    <div class="wrap">
        <div class="container">
            <form class='edit'>
                <input type="hidden" value='<?php echo $member['id'];?>'>
                <div class="item">
                    帳號:
                    <input type="text" name='username' id='username' value='<?php echo $member['username']?>' required>
                </div>
                <div class="item">
                    密碼:
                    <input type="password" name='password' id='password' value='<?php echo $member['password'];?>'>
                </div>
                <div class="item">
                    暱稱:
                    <input type="text" name='name' id='name' value='<?php echo $member['name'];?>'>
                </div>
                <div class="item">
                    <input type="submit" id='submit' name='submit' value='發布'>
                </div>
            </form>
        </div>
    </div>
    <?php include_once 'footer.php'?>
    <script>
        window.onload = (function(){
            $('#username').on('focusout',function(){
                const uname = $(this).val();
                if($(this).val()!=''){
                    $.ajax({
                        type:'POST',
                        url:'../php/checkUser.php',
                        data:{
                            un:$(this).val()
                        },
                        datatype:'html'
                    }).done(function(data){
                        console.log(data);
                        if(data=='yes'){
                            $("#username").addClass('has_error').removeClass('has_succeed');
                        }else{
                            $("#username").addClass('has_succeed').removeClass('has_error');
                        }
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        //失敗的時候
                        alert("有錯誤產生，請看 console log");
                        console.log(jqXHR.responseText);
                    });
                }else{
                    $("#username").removeClass('has_error').removeClass('has_succeed');
                }
                return false;
            })
            $('.edit').on('submit',function(){
                $.ajax({
                        type:'POST',
                        url:'../php/update_member.php',
                        data:{
                            member_id:$("input[type='hidden']").val(),
                            un:$('#username').val(),
                            pw:$('#password').val(),
                            name:$('#name').val()
                        },
                        datatype:'html'
                    }).done(function(data){
                        console.log(data);
                        if(data=='yes'){
                            alert('修改成功');
                            window.location.href = 'index.php';
                        }else{
                            alert('修改發生錯誤');
                        }
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        //失敗的時候
                        alert("有錯誤產生，請看 console log");
                        console.log(jqXHR.responseText);
                    });
                    return false;
            })
        })
    </script>
</body>
</html>