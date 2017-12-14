/**
 * Created by syw on 17-3-28.
 */
$(document).ready(function(){
    host=location.host;
    $("button[name='tip']").attr('id','buttonStatus');
    $("#buttonStatus").hide();
    var ue = UE.getEditor('editor');
    var id;
    $("#new").click(function(){

        if(($("input[name='title']").val())=='')
        {
            $("#message").text("标题不能为空！");
            $('#myModal').modal();
            return false;
        }
        var classify=$('#classify option:selected').val().split('/');
        $.post("http://"+host+"/wind/article/newArticle",
            {
                title:$("input[name='title']").val(),
                content:ue.getContent(),
                classify:classify[0],
                tab:classify[1]
            },
            function(data,status){
                if(data=='error')
                {
                    $("#message").text("发布失败！");
                    $('#myModal').modal();
                }
                else if(data=='loginFirst')
                {
                    alert('请先登录后再操作！');
                    window.location.href="http://"+host+"/wind/index/login";
                }
                else
                {
                    id=data;
                    $("#message").text("发布成功！");
                    $("#buttonStatus").text("查看主题");
                    $("#buttonStatus").show();
                    $('#myModal').modal();
                }
            });
    });


    $("#buttonStatus").click(function () {
        window.location.href="http://"+host+"/wind/article/getC/id/"+id;
    });


});
