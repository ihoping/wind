<div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Warning!</strong> 删除分类会删除它的所有标签
</div>
<em>分类信息/</em>
<table class="table table-striped table-bordered">
    <tr><th>#</th><th>分类名</th><th colspan="6">所有标签</th>

    <?php
        $i=1;
        foreach ($data['classifysDocument'] as $item)
        {
            echo '<tr><td>'.$i++.'</td><td>'.$item["classifyName"].'&nbsp;<a href="#"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;<a href="http://'.$_SERVER['SERVER_NAME'].'/wind/classify/remove/name/'.$item["classifyName"].'"><span class="glyphicon glyphicon-remove"></span></a></td>';
            foreach ($item['tab'] as $tab)
            {

                echo '<td class="success">'.$tab.'&nbsp;<a href="#"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;<a href="http://'.$_SERVER['SERVER_NAME'].'/wind/tab/remove/tabName/'.$tab.'"><span class="glyphicon glyphicon-remove"></span></a></td>';

            }
            echo "</tr>";
        }
    ?>

</table>