<table class="table table-bordered table-hover m10">

    <tr>
        <td class="tableleft">标签名称</td>
        <td><input style="width: 30%" type="text" name="tabName"/></td>
    </tr>
    <tr>
        <td class="tableleft">一句话描述</td>
        <td><input  style="width:70%;" type="text" name="description"/></td>
    </tr>
    <tr>
        <td width="10%" class="tableleft">增加标签至</td>
        <td>
            <select style="width: 30%" id="attribute">
                <?php
                foreach ($data['classifysDocument'] as $item)
                {
                    echo ' <option>'.$item['classifyName'].'</option>';
                }
                ?>

            </select>
        </td>
    </tr>
    <tr>
        <td class="tableleft">状态</td>
        <td>
            <input type="radio" name="status" value="0" checked/> 启用
            <input type="radio" name="status" value="1"/> 禁用
        </td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <button class="btn btn-default" type="button" id="newTab">保存</button> &nbsp;&nbsp;<button type="button" class="btn btn-default" id="returnHome" name="backid">返回主页</button>
        </td>
    </tr>
</table>