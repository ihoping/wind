<div class="col-md-3 hidden-sm hidden-xs row-right">
    <ul class="list-group">
        <li class="list-group-item">
            <div class="media">
                <div class="media-left media-middle">
                    <a href="#">
                        <img class="media-object img-rounded" src="<?php echo getHeaderImage($_SESSION['username'])?>" height="60px">
                    </a>
                </div>
                <div class="media-body">
                    <a href="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/member/<?php echo $_SESSION['username']?>"> <h4><?php echo $_SESSION['username']?></h4></a>
                    <h5 class="cut"><?php echo getEmail($_SESSION['username'])?></h5>
                </div>
            </div>
        </li>
        <li class="list-group-item ">
            <div class="row">
                <a href="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/member/<?php echo $_SESSION['username'].'/favorites'?>">
                    <div class="col-xs-4 text-center">
                        <span class="gray"><?php echo getEnshrineNumber()?></span>
                        <div><small class="gray">主题收藏</small></div>
                    </div>
                </a>
                <a href="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/member/<?php echo $_SESSION['username'].'/follows'?>">
                    <div class="col-xs-4 text-center">
                        <span class="gray"> <?php echo getFFNumber('follows')?></span>
                        <div><small class="gray">特别关注</small></div>
                    </div>
                </a>
                <a href="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/member/<?php echo $_SESSION['username'].'/fans'?>">
                    <div class="col-xs-4 text-center">
                        <span class="gray"><?php echo getFFNumber('fans')?></span>
                        <div><small class="gray">被关注</small></div>
                    </div>
                </a>
            </div>
        </li>
        <li class="list-group-item text-center">
            <span class="glyphicon glyphicon-pencil"></span><a href="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/index/newArticle">发布新主题</a>
        </li>
    </ul>

</div>