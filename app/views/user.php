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
                    <div class="media">
                        <div class="media-left media-middle">
                            <a href="#">
                                <img class="media-object img-rounded" src="<?php echo getHeaderImage($data['username'])?>" height="80px">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 id="username"><?php echo $data['username']?></h4>
                            <small class="gray">
                                <?php echo getEmail($data['username'])?>
                            </small>&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="button" id="follow" class="btn btn-default btn-xs <?php if(isset($data['isFollow'])){echo 'btn-warning';}?>"><span id="isFollow"></span>关注<span id="followNumber"><?php echo $data['followNumber']?></span></button>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <ul class="nav nav-tabs">
                        <li role="presentation" class="<?php echo $data['allAStatus']?>"><a href="http://<?php echo $_SERVER["SERVER_NAME"]?>/wind/member/<?php echo $data['username']?>"><?php echo $data['username']?>所创建的所有主题</a></li>
                        <?php
                            if($data['showAll'])
                            {
                                echo ' <li role="presentation" class="'.$data["favoriteStatus"].'"><a href="http://'.$_SERVER["SERVER_NAME"].'/wind/member/'.$data["username"].'/favorites">收藏的主题</a></li>
                                    <li role="presentation" class="'.$data["followStatus"].'"><a href="http://'.$_SERVER["SERVER_NAME"].'/wind/member/'.$data["username"].'/follows">特别关注</a></li>
                                    <li role="presentation" class="'.$data["fanStatus"].'"><a href="http://'.$_SERVER["SERVER_NAME"].'/wind/member/'.$data["username"].'/fans">我的关注者</a></li>';
                            }
                        ?>

                    </ul>

                </li>
            </ul>
            <ul class="list-group">

                <?php

                    $i=1;
                    if(isset($data['articleFavorites']))
                    {

                        echo '<div class="table-responsive" style="background: white">
                                <table class="table">
                                <tr><th>文章名</th><th>操作</th></tr>';
                        foreach ($data['articleFavorites'] as $item)
                        {
                            echo '<tr><td><em>'.$i++.'、</em><a href="#">'.$item['title'].'</a></td><td><a href="http://'.$_SERVER["SERVER_NAME"].'/wind/article/getC/id/'.$item['_id'].'" class="btn btn-sm btn-default" role="button">查看</a></td></tr>';
                        }
                        echo '</table>
                                </div>';
                    }
                    else if(isset($data['myArticles']))
                    {
                        for($i=0;$i<count($data['myArticles']);$i++)
                        {
                            echo '<li class="list-group-item">
                                    <span class="cut">'.timediff(strtotime($data['myArticles'][$i]['created_time']),time()).'</span>
                                    <span class="cut">• </span>
                                    <span class="classify">'.$data['myArticles'][$i]['classify'].'/'.$data['myArticles'][$i]['tab'].'</span>
                                    <span class="cut">• </span>
                                    <span class="cut">发表了</span>
                                    <span class="cut">• </span>
                                    <a href="http://'.$_SERVER["SERVER_NAME"].'/wind/article/getC/id/'.$data['myArticles'][$i]['_id'].'" class="">'.$data['myArticles'][$i]['title'].'</a>
                                    <div class="text-right gray ">
                                        <a href="#">'.$data['myArticles'][$i]['browses'].'</a>浏览
                                        <span class="cut">• </span>
                                        <a href="#">'.$data['myArticles'][$i]['replyNumber'].'</a>回复
                                    </div>
                                    </li>';
                        }
                    }
                    else if(isset($data['fans']))
                    {
                        echo '<div class="table-responsive" style="background: white">
                                <table class="table">
                                <tr><th>用户名</th><th>操作</th></tr>';
                        foreach ($data['fans'] as $item)
                        {
                            echo '<tr><td><em>'.$i++.'、</em><a href="#">'.$item.'</a></td><td><a href="http://'.$_SERVER["SERVER_NAME"].'/wind/member/'.$item.'" class="btn btn-sm btn-default" role="button">查看</a></td></tr>';
                        }
                        echo '</table>
                                </div>';
                    }
                    else if(isset($data['follows']))
                    {
                        echo '<div class="table-responsive" style="background: white">
                                <table class="table">
                                <tr><th>用户名</th><th>操作</th></tr>';
                        foreach ($data['follows'] as $item)
                        {
                            echo '<tr><td><em>'.$i++.'、</em><a href="#">'.$item.'</a></td><td><a href="http://'.$_SERVER["SERVER_NAME"].'/wind/member/'.$item.'" class="btn btn-sm btn-default" role="button">查看</a></td></tr>';
                        }
                        echo '</table>
                                </div>';
                    }
                    else
                    {
                        echo '<em>No data!</em>';
                    }

                ?>
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
<script type="text/javascript" src="http://<?php echo $_SERVER["SERVER_NAME"]?>/wind/app/common/js/user.js"></script>
</body>
</html>