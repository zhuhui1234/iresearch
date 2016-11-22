/**
 * user login js
 */
define(['helper', 'app/main', 'validator', 'canvas'], function (Helper) {
    (function ($) {
        $.fn.extend({
            getSms: function (value) {
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
                        setTimeout(function () {
                            time(id)
                        }, 1000)
                    }
                }

                $(this).click(function () {
                    time(id);
                })
            }
        });
    })(jQuery);

    var checkLoginFormat = function () {
        var phoneVal = $("#mobile").val();
        if (phoneVal.length <= 0) {
            $(".alert:first").fadeIn().text("手机号码不能为空！");
            $("#mobile").focus();
            return false;
        }
        if (!(/^1[34578]\d{9}$/.test(phoneVal))) {
            $(".alert:first").fadeIn().text("手机号码有误，请重填！");
            return false;
        }
        return true;
    };

    //action
    $(function () {
        $("#verification").getSms();


        $("#login_action").submit(function (e) {
            e.preventDefault();
            if (checkLoginFormat()) {

                Helper.post('login', {
                    mobileNum: $("#mobile").val(),
                    verNum: $("#vernum").val(),
                    vCode: $("#vcode").val()
                }, function (ret) {
                    console.log(ret);
                    if (ret.resCode ==  "000000"){
                        window.location.href = '?m=index&a=index';
                    }else {
                        alert('验证错误');
                    }

                });
            }
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

    Helper.WeChatQRCode('wxLogin', 'wxLogin');
});