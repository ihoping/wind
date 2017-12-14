/**
 * Created by syw on 17-4-11.
 */
$(document).ready(function () {

    host=location.host;
    $("button[name='tip']").attr('id','buttonStatus');
    $("input").keyup(function(){
        $("#alterPassword").attr("disabled",$("#button_reference").prop("disabled"));
    });
    $("#alterEmail").click(function (){
            $.post("http://"+host+"/wind/member/alter",
                {
                    alterName:'email',
                    email:$("input[name='email']").val()
                },function (data,status) {
                    if(data=='alterEmailSuccess')
                    {
                        $("#message").text("更改成功！");
                        $("#buttonStatus").text("确定");
                        $('#myModal').modal();
                    }
                });
    });

    $("#alterPassword").click(function (){

        if($("input[name='oldPassword']").val()=='')
        {
            $(".has-feedback").eq(0).addClass('has-error');
            $("small:hidden").eq(1).css('display','');
            $("#alterPassword").attr("disabled","disabled");
            return false;
        }
        else if($("input[name='newPassword']").val()=='')
        {
            $(".has-feedback").eq(1).addClass('has-error');
            $("small:hidden").eq(2).css('display','');
            $("#alterPassword").attr("disabled","disabled");
            return false;
        }
        else if($("input[name='againPassword']").val()=='')
        {
            $(".has-feedback").eq(2).addClass('has-error');
            $("small:hidden").eq(4).css('display','');
            $("#alterPassword").attr("disabled","disabled");
            return false;
        }

        $.post("http://"+host+"/wind/member/alter",
            {
                alterName:'password',
                oldPassword:$("input[name='oldPassword']").val(),
                newPassword:$("input[name='newPassword']").val()
            },function (data,status) {
                if(data=='alterPasswordSuccess')
                {
                    $("#message").text("更改成功！");
                    $("#buttonStatus").text("确定");
                    $('#myModal').modal();
                }
                else if(data=='oldPasswordError')
                {
                    $("#message").text("旧密码输入错误！");
                    $("#buttonStatus").text("确定");
                    $('#myModal').modal();
                }
            });
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
        location.reload();
    })
});