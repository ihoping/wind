<!DOCTYPE HTML>
<html>
<?php include VIEWS.'/head/head.php'?>
<body>
<?php include VIEWS.'/navi/navi.php' ?>
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
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="http://<?php echo $_SERVER['SERVER_NAME']?>/wind">wind</a>&nbsp;›&nbsp;<a href="http://localhost/wind/classify/<?php echo $data['tabAttribute']?>"><?php echo $data['tabAttribute']?></a>&nbsp;›&nbsp;<?php echo $data['tabName']?></h4>
                            <em><?php echo $data['tabDescription']?></em>
                        </div>
                    </div>
                </li>
                <?php
                for($i=0;$i<count($data['articles']);$i++)
                {
                    echo '<li class="list-group-item">
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="'.getHeaderImage($data['articles'][$i]['author']).'" alt="..." height="40px">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="http://'.$_SERVER["SERVER_NAME"].'/wind/article/getC/id/'.$data['articles'][$i]['_id'].'">'.$data['articles'][$i]['title'].'</a></h4>
                           <div class="article-detail">
                               <a href="http://'.$_SERVER["SERVER_NAME"].'/wind/" class="classify">'.$data['articles'][$i]['tab'].'</a>
                            <span class="cut">•</span>
                            <a href="http://'.$_SERVER["SERVER_NAME"].'/wind/user/member/name/'.$data['articles'][$i]['author'].'" class="author">'.$data['articles'][$i]['author'].'</a>
                            <span class="cut">• </span>
                            <span href="#" class="gray">'.timediff(strtotime($data['articles'][$i]['created_time']),time()).'</span>
                            <span class="cut">• </span>
                            <a href="#" class="gray">'.$data['articles'][$i]['replyNumber'].'条回复</a>';
                    if($data['articles'][$i]['replyNumber']>0)
                    {
                        echo '<span class="cut">• </span>
                               <span href="#" class="gray">最后回复来自</span>
                               <a href="#" class="author">'.$data['articles'][$i]['lastRname'].'</a>
                               <span class="cut">• </span>
                               <span href="#" class="gray">'.timediff(strtotime($data['articles'][$i]['lastRtime']),time()).'</span>';
                    }
                    echo '</div></div></div></li>';
                }

                ?>
                <li class="list-group-item">
                    <nav aria-label="page">
                        <ul class="pager">
                            <li class="previous"><a href="http://<?php echo $_SERVER["SERVER_NAME"]?>/wind/tab/<?php echo $data['tabName']?>?p=<?php echo $data['prePage']?>"><span aria-hidden="true">&larr;</span> Older</a></li>
                            <li class="next"><a href="http://<?php echo $_SERVER["SERVER_NAME"]?>/wind/tab/<?php echo $data['tabName']?>?p=<?php echo $data['nextPage']?>">Newer <span aria-hidden="true">&rarr;</span></a></li>
                        </ul>
                    </nav>
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
</body>
<script type="text/javascript" src="http://<?php echo $_SERVER["SERVER_NAME"]?>/wind/app/common/js/logout.js"></script>
</html>