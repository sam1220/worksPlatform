<?php

    require_once '../php/db.php';
    require_once '../php/functions.php';

    if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']){
        header('location: login.php');
    }

    $article = get_article_from_back($_GET['i']);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/frontDest_index.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <title>編輯文章</title>
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
            <form class='publish'>
                <input type="hidden" value='<?php echo $article['id'];?>'>
                <div class="item">
                    標題:
                    <input type="text" name='title' id='title' value='<?php echo $article['title']?>' required>
                </div>
                <div class="item">
                    分類:
                    <select name="category" id='category'>
                        <option value="新聞" <?php echo ($article['category']=='新聞')?'checked':''?>>新聞</option>
                        <option value="心得" <?php echo ($article['category']=='心得')?'checked':''?>>心得</option>
                    </select>
                </div>
                <div class="item">
                    <p>內容:</p>
                    <textarea name="content" id="content" cols="60" rows="10"><?php echo $article['content']?></textarea>
                </div>
                <div class="item">
                    是否發布:
                    <input type="radio" name="publish" value='1' <?php echo ($article['publish']==1)?'checked':''?>>發布
                    <input type="radio" name="publish" value='0' <?php echo ($article['publish']==0)?'checked':''?>>不發布
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

            // edit article and return result
            $(".publish").on('submit',function(e){    
                    if($("#title").val()!='' && $("#content").val()!=''){
                        $.ajax({
                            type:'POST',
                            url:'../php/update_article.php',
                            data:{
                                title:$('#title').val(),
                                category:$('#category').val(),
                                content:$('#content').val(),
                                publish:$("input[name='publish']:checked").val(),
                                article_id:$("input[type='hidden']").val()
                            },
                            datatype:'html'
                        }).done(function(data){
                            console.log(data);
                            if(data=='yes'){
                                alert('編輯成功');
                                window.location.href = 'article_list.php';
                            }else{
                                alert('編輯發生錯誤');
                            }
                        }).fail(function(jqXHR, textStatus, errorThrown) {
			      	        //失敗的時候
			      	        alert("有錯誤產生，請看 console log");
			                console.log(jqXHR.responseText);
			            });
                    }else{
                        alert('有資料未填寫');
                    }
                    return false;
                }
            )

        });
        

    </script>
</body>
</html>