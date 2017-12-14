/**
 * Created by syw on 17-3-28.
 */
$(document).ready(function(){
    host=location.host;
    $("button[name='tip']").attr('id','loginSuccess');
    $("#loginSuccess").hide();

    $("input").keyup(function(){
        $("#login").attr("disabled",$("#button_reference").prop("disabled"));
    });
    var autoLogin;
    $("#login").click(function(){
        if($("input[name='username']").val()=='')
        {
            $("#form div").eq(0).addClass('has-error');
            $("small:hidden").eq(0).css('display','');
            $("#login").attr("disabled","disabled");
            return false;
        }
        else if($("input[name='password']").val()=='')
        {
            $("#form div").eq(3).addClass('has-error');
            $("small:hidden").eq(2).css('display','');
            $("#login").attr("disabled","disabled");
            return false;
        }
        else if($("input[name='vCode']").val()=='')
        {
            $("#form div").eq(6).addClass('has-error');
            $("small:hidden").eq(4).css('display','');
            $("#login").attr("disabled","disabled");
            return false;
        }
        if($("input[type='checkbox']").is(':checked'))
        {
            autoLogin=1;
        }
        else
        {
            autoLogin=0;
        }
        $.post("http://"+host+"/wind/login/login",
            {
                username:$("input[name='username']").val(),
                password:$("input[name='password']").val(),
                vCode:$("input[name='vCode']").val(),
                autoLogin:autoLogin
            },
            function(data,status){
               if(data=='vCode_error')
               {
                   $("#message").text("验证码错误！");
                   $('#myModal').modal();
               }
               else if(data=='success')
               {
                    $("#message").text("登录成功！");
                    $("#loginSuccess").text("直接进入");
                    $("#loginSuccess").show();
                    $('#myModal').modal();
               }
               else if(data=='password_error')
               {
                   $("#message").text("密码错误！");
                   $('#myModal').modal();
               }
               else if(data=='user_error')
               {
                   $("#message").text("用户不存在！");
                   $('#myModal').modal();
               }
            });
    });

    $("#loginSuccess").click(function () {
        window.location.href="http://"+host+"/wind";
    })


});
