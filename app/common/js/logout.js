/**
 * Created by syw on 17-3-28.
 */
$(document).ready(function(){

    host = window.location.host;

    $("button[name='tip']").attr('id','logoutSuccess');
    $("#logout").click(function(){

        $("#message").text("您已经登录，确定登出吗？");
        $("button[name='tip']").text("确定");
        $('#myModal').modal();
    });

    $("#logoutSuccess").click(function () {

        $.post("http://"+host+"/wind/index/logout",
            function(data,status){
                if(status=='success')
                {
                    $('#myModal').modal('hide');
                    location.reload();
                }

            });
    })


});
