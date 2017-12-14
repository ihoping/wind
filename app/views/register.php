<!DOCTYPE HTML>
<html>
<?php include VIEWS.'/head/head.php'?>
<body>
<!--  导航条 -->
<?php include VIEWS.'/navi/navi.php' ?>

<link type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/app/common/validator/css/bootstrapValidator.min.css">

<!-- 导航条结束 -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">提示</h4>
            </div>
            <div class="modal-body">
                <span id="message"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="registerSuccess">前往登录</button>
            </div>
        </div>
    </div>
</div>
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
                        <li><a href="#">注册</a></li>
                    </ol>
                </li>
                <li class="list-group-item register">
                    <form role="form" id="form" method="post" onkeydown="if(event.keyCode==13)return false;">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                <input class="form-control" placeholder="用户名"  type="text" name="username"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                                <input class="form-control" name="password" placeholder="密码" type="password"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-book"></span></div>
                                <input class="form-control" name="confirmPassword" placeholder="再次输入密码" type="password"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-th-large"></span></div>
                                <input class="form-control" placeholder="验证码" name="vCode" type="text"/>
                            </div>
                            <img src="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/index/verify" style="cursor: pointer" class="pull-right" id="verify" alt="看不清，换一张？" onclick="this.src='http://<?php echo $_SERVER['SERVER_NAME']?>/wind/index/verify/id='+Math.random()">
                        </div>
                        <button type="submit" id="button_reference" style="display: none"></button>
                        <button type="button" class="btn btn-default btn-block" id="register">注册</button>
                        已经注册？请<a href="#">登录</a>
                    </form>
                </li>
            </ul>
        </div>
        <?php include VIEWS.'/rPanel.php';?>
        <div class="col-md-1 row-node"></div>
    </div>
    <?php include VIEWS.'/footer/footer.php'?>
</div>
<!-- container-fluid结束 -->
<script type="text/javascript" src="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/app/common/validator/js/bootstrapValidator.min.js"></script>
<script type="text/javascript" src="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/app/common/js/register.js"></script>
<script type="text/javascript" src="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/app/common/js/validator.js"></script>
</body>
</html>