/**
 * Created by syw on 17-3-28.
 */
$(document).ready(function(){
    host=location.host;
    $("#registerSuccess").hide();

    $("input").keyup(function(){
        $("#register").attr("disabled",$("#button_reference").prop("disabled"));
    });


    $("#register").click(function(){
        if($("input[name='username']").val()=='')
        {
            $("#form div").eq(0).addClass('has-error');
            $("small:hidden").eq(0).css('display','');
            $("#register").attr("disabled","disabled");
            return false;
        }
        else if($("input[name='password']").val()=='')
        {
            $("#form div").eq(3).addClass('has-error');
            $("small:hidden").eq(2).css('display','');
            $("#register").attr("disabled","disabled");
            return false;
        }
        else if($("input[name='confirmPassword']").val()=='')
        {
            $("#form div").eq(6).addClass('has-error');
            $("small:hidden").eq(4).css('display','');
            $("#register").attr("disabled","disabled");
            return false;
        }
        else if($("input[name='vCode']").val()=='')
        {
            $("#form div").eq(9).addClass('has-error');
            $("small:hidden").eq(7).css('display','');
            $("#register").attr("disabled","disabled");
            return false;
        }
        $.post("http://"+host+"/wind/register/register",
            {
                username:$("input[name='username']").val(),
                password:$("input[name='password']").val(),
                confirmPassword:$("input[name='confirmPassword']").val(),
                vCode:$("input[name='vCode']").val()
            },
            function(data,status){
                if(data=='vCode_error')
                {
                    $("#message").text("验证码错误！");
                    $('#myModal').modal();
                }
                else if(data=='success')
                {
                    $("#message").text("注册成功！");
                    $("#registerSuccess").show();
                    $('#myModal').modal();
                }
                else if(data='user_exist')
                {
                    $("#message").text("用户名已存在，请重新输入！");
                    $('#myModal').modal();
                }
                else
                {
                    $("#message").text("因为未知原因，注册失败！");
                    $('#myModal').modal();
                }
            });
    });

    $("#registerSuccess").click(function () {
        window.location.href="http://"+host+"/wind/index/login";
    })


});
