/**
 * Created by syw on 17-4-7.
 */
$(document).ready(function () {
    host=location.host;
    $("button[name='tip']").attr('id','followStatus');

    if($("#follow").hasClass('btn-warning'))
    {
        $("#isFollow").text('已');
    }
    $("#follow").click(function (){

        if($("#alreadyLogin").text()=='')
        {
            $("#message").text("请先登录后操作！");
            $("#followStatus").text("确定");
            $('#myModal').modal();
            return false;
        }

        if($("#follow").hasClass('btn-warning'))
        {
            $("#followNumber").text(parseInt($("#followNumber").text())-1);
            $("#isFollow").text('');
            $("#follow").toggleClass('btn-warning');
            $.post("http://"+host+"/wind/member/follow",
                {
                    followStatus:true,
                    username:$("#username").text()
                });
        }
        else
        {
            $("#followNumber").text(parseInt($("#followNumber").text())+1);
            $("#isFollow").text('已');
            $("#follow").toggleClass('btn-warning');
            $.post("http://"+host+"/wind/member/follow",
                {
                    followStatus:false,
                    username:$("#username").text()
                });
        }
    });

    $("#logout").click(function () {
        $.post("http://"+host+"/wind/index/logout",
            function(data,status){
                if(data=='logoutSuccess')
                {

                    $("#message").text("登出成功！");
                    $("#buttonStatus").text("确定");
                    $('#myModal').modal();
                }

            });
    });


    $('#myModal').on('shown.bs.modal', function (e) {
        location.href="http://"+host+"/wind/index/login";
    })
});