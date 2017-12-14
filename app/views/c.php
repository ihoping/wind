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
                    <ol class="breadcrumb">
                        <li><a href="http://<?php echo $_SERVER['SERVER_NAME']?>/wind">WIND</a></li>
                        <li><a href="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/tab/<?php echo $data['article']['tab']?>"><?php echo $data['article']['tab']?></a></li>
                    </ol>
                    <div class="media">
                        <div class=" pull-right media-middle">
                                <img class="media-object img-rounded" src="<?php echo getHeaderImage($data['article']['author'])?>" height="60px">
                        </div>
                        <div class="media-body">
                            <h3><?php echo $data['article']['title']?></h3>
                            <div class="article-detail">
                                <a href="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/user/show/name/<?php echo $data['article']['author']?>" class="author"><?php echo $data['article']['author']?></a>
                                <span class="cut">• </span>
                                <span class="gray"><?php echo $data['article']['created_time']?></span>
                                <span class="cut">• </span>
                                <span class="gray"><?php echo $data['article']['browses']?>次浏览</span>
                                <span class="cut">• </span>
                                <span class="gray"><span id="enshrineNumber"><?php echo $data['enshrineNumber']?></span>人收藏</span>
                                <span hidden id="AId"><?php echo $data['article']['_id']?></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <?php echo $data['article']['content']?>
                </li>
                <li class="list-group-item LightGrey">
                    <button type="button" class="btn btn-default btn-sm <?php if(isset($data['islike'])){echo 'btn-warning';}?>" id="like"><span class="glyphicon glyphicon-thumbs-up"></span><span id="likeNumber"><?php echo count($data['article']['likes'])?></span></button><span class="cut">• </span>
                    <button type="button" class="btn btn-default btn-sm <?php if(isset($data['isdislike'])){echo 'btn-warning';}?>" id="dislike"><span class="glyphicon glyphicon-thumbs-down"></span><span id="dislikeNumber"><?php echo count($data['article']['dislikes'])?></span></button><span class="cut">• </span>
                    <button type="button" class="btn btn-default btn-sm <?php if($data['isenshrine']==true){echo 'btn-warning';}?>" id="enshrine"><span class="glyphicon glyphicon-heart-empty"></span><span id="isenshrine"></span>加入收藏</button>
                </li>
            </ul>
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="gray"><?php echo '共'.count($data['articleReplys']).'条回复';?><span class="cut">• </span>直到 <?php echo date('Y-m-d H:i:s',time());?></span>
                </li>
                <?php
                    for($i=0;$i<count($data['articleReplys']);$i++)
                    {
                        echo '<li class="list-group-item">
                                <div class="media">
                                    <div class="media-left media-top">
                                    <img class="media-object img-rounded" src="'.getHeaderImage($data["articleReplys"][$i]["username"]).'" height="50px">
                                 </div>
                                 <div class="media-body">
                                    <h4 class="media-heading"><a href="#">'.$data["articleReplys"][$i]["username"].'</a> <small class="gray">'.timediff(strtotime($data['articleReplys'][$i]['created_time']),time()).'</small></h4>
                              '.$data["articleReplys"][$i]['content'].'
                                 </div>
                                </div>
                </li>';
                    }
                ?>


            </ul>
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="gray">发表一条新回复</span>
                </li>
                <li class="list-group-item">
                    <form role="form">
                        <div class="form-group">
                            <div class="input-group">
                                <script id="editor" type="text/plain" style="width:100%;height:100px;"></script>
                            </div>
                        </div>
                        <button type="button" class="btn btn-default btn-block" id="reply">发布回复</button>
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
<script type="text/javascript" src="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/app/common/js/reply.js"></script>

</body>
</html>