<!DOCTYPE HTML>
<html>
<?php include VIEWS.'/head/head.php'?>
<!-- Modal -->
<?php include VIEWS.'/modal/modal.php';?>
<!-- Modal结束 -->
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/secret/admin">Wind后台管理</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">文章管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/secret/admin?q=AManager">文章列表</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">用户管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/secret/admin?q=UManager">用户列表</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">分类&标签<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/secret/admin?q=CTManager">全部分类&标签</a></li>
                        <li><a href="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/secret/admin?q=ACManager">新增分类</a></li>
                        <li><a href="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/secret/admin?q=ATManager">新增标签</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">权限控制<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">角色管理</a></li>
                        <li><a href="#">权限管理</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div style="margin-top: 50px" class="container-fluid">
    <div class="row">
        <div class="col-md-1 row-node"></div>
        <div style="background: white" class="col-md-10 row-node">

            <?php
                if(isset($data['articles']))
                {
                    include APP.'/views/admin/articles.php';

                }
                else if(isset($data['users']))
                {
                    include APP.'/views/admin/users.php';
                }
                else if(isset($data['CT']))
                {
                    include APP.'/views/admin/CT.php';
                }
                else if(isset($data['AC']))
                {
                    include APP.'/views/admin/AC.php';
                }
                else if(isset($data['AT']))
                {
                    include APP.'/views/admin/AT.php';
                }
                else
                {
                    dump($_SERVER);
                }



            ?>


        </div>
        <div class="col-md-1 row-node"></div>
    </div>
<!-- container-fluid结束 -->
    <script type="text/javascript" src="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/app/common/js/admin.js"></script>
</body>
</html>