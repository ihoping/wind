<!--  导航条 -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://<?php echo $_SERVER['SERVER_NAME']?>/wind"> <img alt="Brand" class="Brand-logo" src="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/app/common/images/logo.png"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="navbar-form navbar-left">
                <div class="form-group search">
                    <div class="input-group">
                        <span class="input-group-addon"><a href="#" id="elasticsearch"><span class="glyphicon glyphicon-search"></span></a> </span>
                        <input type="text" name="search" id="inputelasticsearch" class="form-control" placeholder="Search">
                    </div>
                </div>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="http://<?php echo $_SERVER['SERVER_NAME']?>/wind">首页</a></li>
                <?php
                if(isset($_SESSION['username']))
                {
                 echo '<li><a id="alreadyLogin" href="http://'.$_SERVER["SERVER_NAME"].'/wind/member/'.$_SESSION["username"].'">'.$_SESSION["username"].'</a></li><li><a href="http://'.$_SERVER["SERVER_NAME"].'/wind/index/setting">设置</a></li><li class="visible-xs visible-sm"><a href="http://'.$_SERVER["SERVER_NAME"].'/wind/index/newArticle">发布新主题</a></li><li><a href="javascript:void(0)" id="logout">登出</a></li>';
                }
                else
                {
                 echo '<li><a href="http://'.$_SERVER["SERVER_NAME"].'/wind/index/login">登录</a></li><li><a href="http://'.$_SERVER["SERVER_NAME"].'/wind/index/register">注册</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<!-- 导航条结束 -->
<script>
    $("#elasticsearch").click(function () {
        if($("input[name='search']").val()=='')
        {
            alert('搜索内容不能为空！');
            return false;
        }
        location.href="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/search/"+$("input[name='search']").val();

    });
    $("#inputelasticsearch").keydown(function (event) {
        if(event.keyCode == 13){
            if($("input[name='search']").val()=='')
            {
                alert('搜索内容不能为空！');
                return false;
            }
            location.href="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/search/"+$("input[name='search']").val();
        }
    })
</script>