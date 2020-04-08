<?php

    require_once '../php/db.php';
    if(isset($_SESSION['is_login']) && $_SESSION['is_login']==true ){
        header('location: index.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/frontDest_index.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <title>作品網站</title>
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
            align-items:center;
        }
        form .item{
            margin:10px;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="container">
            <h2>後台登入</h2>
            <form id='login'>
                <div class="item">
                    帳號:
                    <input type="text" name='username' id='username' required>
                </div>
                <div class="item">
                    密碼:
                    <input type="password" name='password' id='password' required>
                </div>
                <div class="item">
                    <input type="submit" name='submit' value='登入' id='submit'>
                </div>
            </form>
        </div>
    </div>
    <?php include_once 'footer.php'?>
    <script>
        window.onload = (function(){
            $('form').on('submit',function(){
                $.ajax({
                    type:'POST',
                    url:'../php/verifyUser.php',
                    data:{
                        un:$('#username').val(),
                        pw:$('#password').val()
                    },
                    datatype:'html'
                }).done(function(data){
                    console.log(data);
                    if(data=='yes'){
                        window.location.href = 'index.php';
                    }else{
                        alert('帳號或密碼有誤');
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