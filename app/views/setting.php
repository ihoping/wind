<!DOCTYPE HTML>
<html>
<?php include VIEWS.'/head/head.php'?>
<style>
    .file {
        position: relative;
        display: inline-block;
        background: #D0EEFF;
        border: 1px solid #99D3F5;
        border-radius: 4px;
        padding: 4px 12px;
        overflow: hidden;
        color: #1E88C7;
        text-decoration: none;
        text-indent: 0;
        line-height: 20px;
    }
    .file input {
        position: absolute;
        font-size: 100px;
        right: 0;
        top: 0;
        opacity: 0;
    }
    .file:hover {
        background: #AADFFD;
        border-color: #78C3F3;
        color: #004974;
        text-decoration: none;
    }
</style>
<body>
<!--  导航条 -->
<?php include VIEWS.'/navi/navi.php';?>
<!-- 导航条结束 -->
<!-- Modal -->
<?php include VIEWS.'/modal/modal.php';?>
<!-- Modal结束 -->
<!-- container-fluid -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-1 row-node"></div>
        <div class="col-md-7 row-node">
            <ul class="list-group">
                <li class="list-group-item">
                    <ol class="breadcrumb">
                        <li><a href="#">WIND</a></li>
                        <li><a href="#">设置</a></li>
                    </ol>
                </li>
                <li class="list-group-item register">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">唯一标识</span></div>
                                <input class="form-control" placeholder="<?php echo $data['userInformation']['name']?>" name="username" type="text" readonly/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">电子邮件</span></div>
                                <input class="form-control" placeholder="<?php echo $data['userInformation']['email']?>" name="email" type="text"/>
                            </div>
                        </div>
                        <button type="button" id="alterEmail" class="btn btn-default btn-block">保存设置</button>
                </li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">更换头像</h3>
                </div>
                <div class="panel-body register text-center">
                    <form action="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/image/upload" method="post" enctype="multipart/form-data">
                        <div id="preview">
                            <img id="imghead" width=100 height=100 border=0 src='<?php echo getHeaderImage($_SESSION['username'])?>'>
                        </div>
                        <hr/>
                        <a href="javascript:;" class="file" id="file"><label>从本地选择图片</label>
                            <input type="file" class="btn btn-primary"  name="file" id="" onchange="previewImage(this)" accept="image/*">
                        </a>
                        <hr/>
                            <button type="submit"  id="alterHeaderImage" class="btn btn-default btn-block hidden">立即上传</button>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">更改密码</h3>
                </div>
                <div class="panel-body register">
                    <form role="form" method="get" action="index.html">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">旧密码</span></div>
                                <input class="form-control" placeholder="" name="oldPassword" type="password"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">新密码</span></div>
                                <input class="form-control" placeholder="" name="newPassword" type="password"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">再密码</span></div>
                                <input class="form-control" placeholder="" name="againPassword" type="password"/>
                            </div>
                        </div>
                        <button type="submit" id="button_reference" style="display: none"></button>
                        <button type="button" id="alterPassword" class="btn btn-default btn-block">更改</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
        if(isset($_SESSION['username']))
            include VIEWS.'/profile.php';
        else
            include VIEWS.'/rPanel.php';
        ?>
        <div class="col-md-1 row-node"></div>
    </div>
    <?php include VIEWS.'/footer/footer.php'?>
</div>
<!-- container-fluid结束 -->
<script type="text/javascript" src="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/app/common/js/validator.js"></script>
<script type="text/javascript" src="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/app/common/validator/js/bootstrapValidator.min.js"></script>
<script src="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/app/common/js/alter.js"></script>
<script type="text/javascript">


    //图片上传预览    IE是用了滤镜。
    function previewImage(file)
    {
        $("label").text('重新选择');
        $("#alterHeaderImage").removeClass('hidden');
        var MAXWIDTH  = 260;
        var MAXHEIGHT = 180;
        var div = document.getElementById('preview');
        if (file.files && file.files[0])
        {
            div.innerHTML ='<img id=imghead>';
            var img = document.getElementById('imghead');
            img.onload = function(){
                var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
                img.width  =  rect.width;
                img.height =  rect.height;
//                 img.style.marginLeft = rect.left+'px';
                img.style.marginTop = rect.top+'px';
            }
            var reader = new FileReader();
            reader.onload = function(evt){img.src = evt.target.result;}
            reader.readAsDataURL(file.files[0]);
        }
        else //兼容IE
        {
            var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
            file.select();
            var src = document.selection.createRange().text;
            div.innerHTML = '<img id=imghead>';
            var img = document.getElementById('imghead');
            img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
            var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
            status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
            div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;"+sFilter+src+"\"'></div>";
        }
    }
    function clacImgZoomParam( maxWidth, maxHeight, width, height ){
        var param = {top:0, left:0, width:width, height:height};
        if( width>maxWidth || height>maxHeight )
        {
            rateWidth = width / maxWidth;
            rateHeight = height / maxHeight;

            if( rateWidth > rateHeight )
            {
                param.width =  maxWidth;
                param.height = Math.round(height / rateWidth);
            }else
            {
                param.width = Math.round(width / rateHeight);
                param.height = maxHeight;
            }
        }

        param.left = Math.round((maxWidth - param.width) / 2);
        param.top = Math.round((maxHeight - param.height) / 2);
        return param;
    }
</script>
</body>
</html>