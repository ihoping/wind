/**
 * Created by syw on 17-4-14.
 */
$(document).ready(function(){

    host=location.host;
    $("button[name='tip']").hide();
    $("#findArticle").click(function () {
        $.post("http://"+host+"/wind/article/findArticle",
            {
                id:$("input[name='articleId']").val()
            },function (data,status) {
                if(data=='noData'||data=='idError')
                {
                    $("#message").text("没有查到数据！");
                    $("#buttonStatus").text("确定");
                    $('#myModal').modal();
                }
                else
                {
                    var obj = eval('(' + data + ')');
                    $("#searchResult").html(
                        '<table class="table table-striped table-bordered">' +
                        '<tr><th>#</th><th>文章名</th><th>作者</th><th>发布时间' +
                        '</th><th>所属于</th><th>点击数</th><th>点赞人数</th>' +
                        '<th>踩人数</th><th>操作</th></tr><tr><td>1</td><td>'+obj.title+'</td><td>'
                        +obj.author+'</td><td>'+obj.created_time+'</td><td>'+
                        obj.attribute+'</td><td>'+obj.browses+'</td><td>'+obj.likes+'</td><td>'+
                        obj.dislikes+'</td><td>'+'<a href="#"><span class="glyphicon glyphicon-edit">' +
                        '</span></a>&nbsp;<a href="http://'+host+'/wind/article/remove/id/'+obj.Aid+'">' + '<span class="glyphicon glyphicon-remove"></span></a>'+'</td></tr></table>'

                    );
                }
            });
    });


    $("#findUser").click(function () {
        $.post("http://"+host+"/wind/member/findUser",
            {
                name:$("input[name='userId']").val()
            },function (data,status) {
                if(data=='noData'||data=='idError')
                {
                    $("#message").text("没有查到数据！");
                    $("#buttonStatus").text("确定");
                    $('#myModal').modal();
                }
                else
                {
                    var obj = eval('(' + data + ')');
                    $("#searchResult").html(
                        '<table class="table table-striped table-bordered">' +
                        '<tr><th>#</th><th>用户名</th><th>注册时间' +
                        '</th><th>邮箱</th><th>用户组</th><th>关注人数</th>' +
                        '<th>粉丝数</th><th>操作</th></tr><tr><td>1</td><td>'+obj.username+'</td><td>'
                        +obj.created_time+'</td><td>'+obj.email+'</td><td>普通会员</td><td>'+obj.follows+'</td><td>'+obj.fans+'</td><td>'+'<a href="#"><span class="glyphicon glyphicon-edit">' +
                        '</span></a>&nbsp;<a href="http://'+host+'/wind/member/remove/id/'+obj.Uid+'">' + '<span class="glyphicon glyphicon-remove"></span></a>'+'</td></tr></table>'

                    );
                }
            });
    });



    $("#newClassify").click(function () {
        $.post("http://"+host+"/wind/classify/newClassify",
            {
                classifyName:$("input[name='classifyName']").val()
            },function (data,status) {
               if(data=='Success')
               {
                   alert('新增分类成功！');
                   location.href="http://"+host+"/wind/secret/admin/q/CTManager";
               }
               else
               {
                   alert('新增分类失败！');
                   location.href="http://"+host+"/wind/secret/admin/q/CTManager";
               }
            });

    });

    $("#newTab").click(function () {

        var classify=$('#attribute option:selected').val();
        $.post("http://"+host+"/wind/tab/newTab",
            {
                tabName:$("input[name='tabName']").val(),
                description:$("input[name='description']").val(),
                attribute:classify
            },function (data,status) {
                if(data=='Success')
                {
                    alert('新增标签成功！');
                    location.href="http://"+host+"/wind/secret/admin/q/CTManager";
                }
            });

    });
    
    
    $("#returnHome").click(function () {
        location.href="http://"+host+"/wind/secret/admin/";
    });


});
