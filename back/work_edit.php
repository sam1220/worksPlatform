<?php

    require_once '../php/db.php';
    require_once '../php/functions.php';

    if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']){
        header('location: login.php');
    }

    $work = get_work_from_back($_GET['i']);

    // echo file_exists($work['image_path']);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/frontDest_index.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <title>編輯作品</title>
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
        .item a{
            text-decoration:none;
            display:block;
            border:1px solid #444444;
            border-radius:5px;
            background-color:#137ef0;
            color:#fff;
            font-weight:bold;
            padding:3.5px;
            align-self:flex-start;
            width:5%;
            font-size:10pt;
            text-align:center;
            margin-top:5px;
        }
        img,video{
            width:300px;
            height:auto;
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
                <input type="hidden" id='work_id' value='<?php echo $work['id'];?>'>
                <div class="item">
                    <p>簡介</p>
                    <textarea name="intro" id="intro" cols="60" rows="10"><?php echo $work['intro']?></textarea>
                </div>
                <div class="item">
                    圖片上傳:
                    <input type="file" name="image" id="images">    
                    <input type="hidden" class='image_path' value='<?php echo '../'.$work['image_path']; ?>'>
                    <div class="image_upload">
                        <?php if($work['image_path']!=null):?>
                            <img src="<?php echo '../'.$work['image_path']?>" alt="">
                        <?php endif;?>    
                    </div>
                    <a href="javascript:void(0);" class='image_del'>刪除</a>
                </div>
                <div class="item">
                    影片上傳:
                        <input type="file" name="video" id="videos" >
                    <input type="hidden" class='video_path' value='<?php echo '../'.$work['video_path']; ?>'>
                    <div class="video_upload"></div>
                        <?php if($work['video_path']!=null):?>
                            <video src="<?php echo '../'.$work['video_path']; ?>" controls></video>
                        <?php endif;?>    
                    <a href="javascript:void(0);" class='video_del'>刪除</a>
                </div>
                <div class="item">
                    是否發布:
                    <input type="radio" name="publish" value='1' <?php echo ($work['publish']==1)?'checked':''?>>發布
                    <input type="radio" name="publish" value='0' <?php echo ($work['publish']==0)?'checked':''?>>不發布
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

            $('#images').on('change',function(){
                const form_data = new FormData();
                const save_path = 'files/images/';
                const upload_filename = $(this)[0].files[0];
                form_data.append('save_path',save_path);
                form_data.append('file',upload_filename);

                $.ajax({
                    type:'POST',
                    url:'../php/upload_file.php',
                    data:form_data,
                    cache:false,
                    processData:false,
                    contentType:false,
                    datatype:'html'
                }).done(function(data){
                    console.log(data);
                    if(data=='yes'){
                        $('.image_upload').html(`<img src='../${save_path}${upload_filename.name}'>`)
                        $('.image_path').val(save_path+upload_filename.name);
                    }else{
                        alert('檔案上傳失敗');
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    //失敗的時候
                    alert("有錯誤產生，請看 console log");
                    console.log(jqXHR.responseText);
                });
            })

            $('.image_del').on('click',function(){
                if($('.image_path').val()!=='' || $('.image_path').val()!=='../'){
                    let c = confirm('確定刪除將上傳的檔案嗎?');
                    if(c){
                        $.ajax({
                            type:'POST',
                            url:'../php/delete_file.php',
                            data:{
                                file:$('.image_path').val()
                            },
                            datatype:'html'
                            }).done(function(data){
                                console.log(data);
                                if(data=='yes'){
                                    $('.image_upload').html('');
                                    $('.image_path').val('');
                                }else{
                                    alert('檔案刪除失敗');
                                }
                            }).fail(function(jqXHR, textStatus, errorThrown) {
                                //失敗的時候
                                alert("有錯誤產生，請看 console log");
                                console.log(jqXHR.responseText);
                            });
                        }
                }else{
                    alert('查無檔案');
                }
            })

            $('#videos').on('change',function(){
                const form_data = new FormData();
                const save_path = 'files/videos/';
                const upload_filename = $(this)[0].files[0];
                form_data.append('save_path',save_path);
                form_data.append('file',upload_filename);

                $.ajax({
                    type:'POST',
                    url:'../php/upload_file.php',
                    data:form_data,
                    cache:false,
                    processData:false,
                    contentType:false,
                    datatype:'html'
                }).done(function(data){
                    console.log(data);
                    if(data=='yes'){
                        $('.video_upload').html(`<video src='../${save_path}${upload_filename.name}' controls></video>`)
                        $('.video_path').val(save_path+upload_filename.name);
                    }else{
                        alert('檔案上傳失敗');
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    //失敗的時候
                    alert("有錯誤產生，請看 console log");
                    console.log(jqXHR.responseText);
                });
            })

            $('.video_del').on('click',function(){
                if($('.video_path').val()!=='' || $('.video_path').val()!=='../'){
                    let c = confirm('確定刪除將上傳的檔案嗎?');
                    if(c){
                        $.ajax({
                            type:'POST',
                            url:'../php/delete_file.php',
                            data:{
                                file:$('.video_path').val()
                            },
                            datatype:'html'
                            }).done(function(data){
                                console.log(data);
                                if(data=='yes'){
                                    $('.video_upload').html('');
                                    $('.video_path').val('');
                                }else{
                                    alert('檔案刪除失敗');
                                }
                            }).fail(function(jqXHR, textStatus, errorThrown) {
                                //失敗的時候
                                alert("有錯誤產生，請看 console log");
                                console.log(jqXHR.responseText);
                            });
                        }
                }else{
                    alert('查無檔案');
                }
            })

            // edit article and return result
            $(".publish").on('submit',function(e){    
                if($('#intro').val()!='' && ($('#images').val()!='' || $('videos').val()!='') ){
                        $.ajax({
                            type:'POST',
                            url:'../php/update_work.php',
                            data:{
                                id:$('#work_id').val(),
                                intro:$('#intro').val(),
                                imagePath:$('.image_path').val(),
                                videoPath:$('.video_path').val(),
                                publish:$("input[name='publish']:checked").val()
                            },
                            datatype:'html'
                        }).done(function(data){
                            console.log(data);
                            if(data=='yes'){
                                alert('編輯成功');
                                window.location.href = 'work_list.php';
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