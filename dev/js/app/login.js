define(['app/main','canvas'], function() {
    (function($) {
        $.fn.extend({
            getSms: function(value) {
                value = $.extend({
                    wait: 60, //参数, 默认60秒
                }, value);
                var id = $(this).attr('id');
                var wait = value.wait;
                //内部函数
                function time(id) {
                    if (wait == 0) {
                        $("#" + id).removeClass("disabled");
                        $("#" + id).text('获取验证码');
                        wait = value.wait;
                    } else {
                        $("#" + id).addClass("disabled");
                        $("#" + id).text("重新发送(" + wait + ")");
                        wait--;
                        setTimeout(function() {
                            time(id)
                        }, 1000)
                    }
                }
                $(this).click(function() {
                    time(id);
                })
            }
        });
    })(jQuery);
    $(function(){
        $("#verification").getSms();
        $("button[type='submit']").on('click',function () {
            var phoneVal = $("#mobile").val();
            if (phoneVal.length <= 0) {
                $(".alert:first").fadeIn().text("手机号码不能为空！");
                $("#mobile").focus();
                return false;
            }
            if(!(/^1[34578]\d{9}$/.test(phoneVal))){
                $(".alert:first").fadeIn().text("手机号码有误，请重填！");
                return false;
            }
            return true;
        });

        //登录背景
        $('#particles').particleground({
            dotColor: '#e7ebee',
            lineColor: '#e7ebee',
            density: 20000,
            proximity: 140,
            parallaxMultiplier: 30,
            curvedLines: true,
        });
    });
});