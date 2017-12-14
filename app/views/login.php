<!DOCTYPE HTML>
<html>
<?php include VIEWS.'/head/head.php'?>
<link type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/app/common/validator/css/bootstrapValidator.min.css">
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
                        <li><a href="#">登录</a></li>
                    </ol>
                </li>
                <li class="list-group-item register">
                    <form role="form" action="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/login/login" method="post" id="form" onkeydown="if(event.keyCode==13)return false;" >
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                <input class="form-control" placeholder="用户名" name="username" type="text"/>
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
                                <div class="input-group-addon"><span class="glyphicon glyphicon-th-large"></span></div>
                                <input class="form-control" placeholder="验证码" name="vCode" type="text" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox">一星期内自动登录
                                </label>
                            </div>
                            <img src="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/index/verify" style="cursor: pointer" class="pull-right" id="verify" alt="看不清换一张？" onclick="this.src='http://localhost/wind/index/verify/id='+Math.random()">
                        </div>
                        <button type="submit" id="button_reference" style="display: none"></button>
                        <button type="button"  id="login" class="btn btn-default btn-block" >登录</button>
                    </form>
                </li>
            </ul>
        </div>
        <?php  include VIEWS.'/rPanel.php';?>
        <div class="col-md-1 row-node"></div>
    </div>
    <?php include VIEWS.'/footer/footer.php'?>
</div>
<!-- container-fluid结束 -->
<script type="text/javascript" src="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/app/common/js/validator.js"></script>
<script type="text/javascript" src="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/app/common/validator/js/bootstrapValidator.min.js"></script>
<script type="text/javascript" src="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/app/common/js/login.js"></script>
</body>
</html>