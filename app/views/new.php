<!DOCTYPE HTML>
<html>
<?php include VIEWS.'/head/head.php'?>
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
                        <li><a href="#">发布新主题</a></li>
                    </ol>
                </li>
                <li class="list-group-item">
                    <form method="post" action="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/article/newArticle">
                        <div class="form-group">
                            <label for="exampleInputEmail1">标题</label>
                            <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="这里输入标题">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">内容</label>
                            <script id="editor" type="text/plain"  style="width:100%;height:300px;"></script>
                        </div>
                            <label for="exampleInputPassword1">选择一个分类</label>
                            <select style="width: 20%" id="classify">
                                <?php
                                    foreach ($data['classifys'] as $item)
                                    {
                                        echo '<option style="font-weight: bolder;" disabled>'.$item['classifyName'].'/</option>';
                                       foreach ($item['tab'] as $tab)
                                       {
                                           echo '<option value="'.$item['classifyName'].'/'.$tab.'">'.$tab.'</option>';
                                       }
                                    }
                                ?>
                            </select>
                        <hr/>
                        <button type="button" class="btn btn-default btn-block" id="new">New一个主题</button>
                    </form>
                </li>
            </ul>
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
<script type="text/javascript" charset="utf-8" src="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/app/lib/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/app/lib/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/app/lib/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" src="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/app/common/js/new.js"></script>
</body>
</html>