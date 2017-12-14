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
                        <li>Search</li>
                        <li><?php echo $data['searchName']?></li>
                    </ol>
                </li>
                <li class="list-group-item">
                    <em>经过<?php echo $data['searchTime']?>ms，共找到<?php echo count($data['articles'])?>条结果</em>
                </li>
                <?php
                if(empty($data['articles']))
                {
                    echo '<li class="list-group-item"><em>No Data!</em></li>';
                }
                else {
                    foreach ($data['articles'] as $item) {
                        echo '<li class="list-group-item">
                    <div class="media">
                        <div class="media-left media-middle">
                        </div>
                        <div class="media-body">
                            <a href="http://'.$_SERVER["SERVER_NAME"].'/wind/article/getC/id/' . $item['id'] . '"><h4 class="media-heading"><em>' . $item['title'] . '</em></h4></a>
                            ' . $item['content']. '
                            ......
                        </div>
                        <em>文章作者:' . $item['author'] . '</em>
                    </div>
                </li>';
                    }
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
</body>
<script type="text/javascript" src="http://<?php echo $_SERVER['SERVER_NAME']?>/wind/app/common/js/logout.js"></script>
</html>