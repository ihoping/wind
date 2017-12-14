/**
 * Created by syw on 17-4-3.
 */
$(document).ready(function(){
    host=location.host;
    var ue=UE.getEditor('editor',{
        toolbars: [[
            'source',  '|',
            'bold', 'italic', 'underline', 'strikethrough',  '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', '|',
            'paragraph', 'fontfamily', 'fontsize', '|',
            'justifyleft', 'justifycenter', 'justifyright',   '|', 'emotion',  'insertcode',
        ]]
    });

    $("button[name='tip']").attr('id','replyStatus');
    $("#reply").click(function(){
        if(ue.getContent()=='')
        {
            $("#message").text("内容不能为空！");
            $("#replyStatus").text("确定");
            $('#myModal').modal();
            return false;
        }
        $.post("http://"+host+"/wind/article/newReply",
            {
                AId:$("#AId").text(),
                content:ue.getContent()
            },
            function(data,status){
                if(data=='replySuccess')
                {
                    $("#message").text("回复成功！");
                    $("#replyStatus").text("确定");
                    $('#myModal').modal();

                }
                else if(data=='loginFirst')
                {
                    $("#message").text("请先登录后操作！");
                    $("#replyStatus").text("确定");
                    $('#myModal').modal();
                    return false;
                }
                else
                {
                    $("#message").text("回复失败！");
                    $("#replyStatus").text("确定");
                    $('#myModal').modal();
                }
            });
    });


    $("#logout").click(function () {
        $.post("http://"+host+"/wind/index/logout",
            function(data,status){
                if(status=='success')
                {

                    $("#message").text("登出成功！");
                    $("#replyStatus").text("确定");
                    $('#myModal').modal();
                }

            });
    });
    $("#like").click(function () {
        if($("#alreadyLogin").text()=='')
        {
            $("#message").text("请先登录后操作！");
            $("#replyStatus").text("确定");
            $('#myModal').modal();
            return false;
        }
        if($("#like").hasClass('btn-warning'))
        {
            $("#likeNumber").text(parseInt($("#likeNumber").text())-1);
            $("#like").toggleClass('btn-warning');
            $.post("http://"+host+"/wind/article/like",
                {
                    likeStatus:true,
                    AId:$("#AId").text()
                });
        }
        else
        {
            $("#likeNumber").text(parseInt($("#likeNumber").text())+1);
            $("#like").toggleClass('btn-warning');
            $.post("http://"+host+"/wind/article/like",
                {
                    likeStatus:false,
                    AId:$("#AId").text()
                });
        }
    });

    $("#dislike").click(function () {
        if($("#alreadyLogin").text()=='')
        {
            $("#message").text("请先登录后操作！");
            $("#replyStatus").text("确定");
            $('#myModal').modal();
            return false;
        }
        if($("#dislike").hasClass('btn-warning'))
        {
            $("#dislikeNumber").text(parseInt($("#dislikeNumber").text())-1);
            $("#dislike").toggleClass('btn-warning');
            $.post("http://"+host+"/wind/article/dislike",
                {
                    dislikeStatus:true,
                    AId:$("#AId").text()
                });
        }
        else
        {
            $("#dislikeNumber").text(parseInt($("#dislikeNumber").text())+1);
            $("#dislike").toggleClass('btn-warning');
            $.post("http://"+host+"/wind/article/dislike",
                {
                    dislikeStatus:false,
                    AId:$("#AId").text()
                });
        }
    });

    if($("#enshrine").hasClass('btn-warning'))
    {
        $("#isenshrine").text('已');
    }
    $("#enshrine").click(function () {

        if($("#alreadyLogin").text()=='')
        {
            $("#message").text("请先登录后操作！");
            $("#replyStatus").text("确定");
            $('#myModal').modal();
            return false;
        }


        if($("#enshrine").hasClass('btn-warning'))
        {
            $("#enshrine").toggleClass('btn-warning');
            $("#isenshrine").text('');
            $("#enshrineNumber").text(parseInt($("#enshrineNumber").text())-1);
            $.post("http://"+host+"/wind/article/enshrine",
                {
                    enshrineStatus:true,
                    AId:$("#AId").text()
                });
        }
        else
        {
            $("#enshrine").toggleClass('btn-warning');
            $("#isenshrine").text('已');
            $("#enshrineNumber").text(parseInt($("#enshrineNumber").text())+1);
            $.post("http://"+host+"/wind/article/enshrine",
                {
                    enshrineStatus:false,
                    AId:$("#AId").text()
                });
        }
    });
    $('#myModal').on('shown.bs.modal', function (e) {
        location.reload();
    })
});
