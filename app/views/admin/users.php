<hr/>
<input type="text" name="userId" placeholder="输入用户名"/>&nbsp;<button type="button" id="findUser" class="btn">查找</button>
<hr/>
<div id="searchResult">
</div>
<em>只显示最近50条数据</em>
<table class="table table-striped table-bordered">
    <tr><th>#</th><th>用户名</th><th>注册时间</th><th>用户组</th><th>邮箱</th><th>关注人数</th><th>粉丝</th><th>操作</th></tr>
    <?php //dump($data['articlesDocument'])
    $i=1;
    foreach ($data['usersDocument'] as $item)
    {
        echo '<tr><td>'.$i++.'</td><td>'.$item['name'].'</td><td>'.$item['created_time'].'</td><td>普通会员</td><td>'.$item['email'].'</td><td>'.count($item['follows']).'</td><td>'.count($item['fans']).'</td><td><a href="#"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;<a href="http://'.$_SERVER['SERVER_NAME'].'/wind/member/remove/id/'.$item['_id'].'"><span class="glyphicon glyphicon-remove"></span></a></td></tr>';
    }

    ?>
</table>