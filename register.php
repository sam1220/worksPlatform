<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/frontDest_index.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <title>註冊</title>
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
            <form class='register'>
                <div class="item">
                    帳號:
                    <input type="text" name='username' id='username' required>
                </div>
                <div class="item">
                    密碼:
                    <input type="password" name='password' id='password' required>
                </div>
                <div class="item">
                    確認密碼:
                    <input type="password" name='confirm_password' id='confirm_password' required>
                </div>
                <div class="item">
                    暱稱:
                    <input type="text" name='name' id='name' required>
                </div>
                <div class="item">
                    <input type="submit" name='submit' value='註冊'>
                </div>
            </form>
        </div>
    </div>
    <?php include_once 'footer.php'?>
    <script>
        window.onload = (function(){

            // check username whether exists
            $("#username").on('focusout',function(){
                const uname = $(this).val();
                if(uname!==''){
                    $.ajax({
                        type:"POST",
                        url:"php/checkUser.php",
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
            })

            // check password and confirm password is same
            $(".register").on('submit',function(e){    
                    if($("#password").val()!=$("#confirm_password").val()){
                        alert("密碼有誤");
                    }else{
                        $.ajax({
                            type:'POST',
                            url:'php/addUser.php',
                            data:{
                                un:$('#username').val(),
                                pw:$('#password').val(),
                                name:$('#name').val()
                            },
                            datatype:'html'
                        }).done(function(data){
                            console.log(data);
                            if(data=='yes'){
                                alert('註冊成功');
                                window.location.href = 'back/login.php';
                            }else{
                                alert('發生錯誤,請重新嘗試或與服務人員聯繫');
                            }
                        }).fail(function(jqXHR, textStatus, errorThrown) {
			      	        //失敗的時候
			      	        alert("有錯誤產生，請看 console log");
			                console.log(jqXHR.responseText);
			            });
                    }
                    return false;
                }
            )

        });
        

    </script>
</body>
</html>