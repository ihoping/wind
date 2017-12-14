<hr/>
<input name="articleId" type="text" placeholder="输入文章ID"/>&nbsp;<button type="button" id="findArticle" class="btn">查找</button>

<div id="searchResult">

</div>
<hr/>
<em>只显示最近50条数据</em>
<table class="table table-striped table-bordered">
    <tr><th>#</th><th>文章名</th><th>作者</th><th>发布时间</th><th>所属于</th><th>点击数</th><th>点赞人数</th><th>踩人数</th><th>操作</th></tr>
    <?php //dump($data['articlesDocument'])
    $i=1;
        foreach ($data['articlesDocument'] as $item)
        {
            echo '<tr><td>'.$i++.'</td><td>'.$item['title'].'</td><td>'.$item['author'].'</td><td>'.$item['created_time'].'</td><th>'.$item['classify'].'/'.$item['tab'].'</th><td>'.$item['browses'].'</td><td>'.count($item['likes']).'</td><td>'.count($item['dislikes']).'</td><td><a href="#"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;<a href="http://'.$_SERVER["SERVER_NAME"].'/wind/article/remove/id/'.$item['_id'].'"><span class="glyphicon glyphicon-remove"></span></a></td></tr>';
        }

    ?>
</table>