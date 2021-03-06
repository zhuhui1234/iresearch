/**
 * Created by robinwong51 on 28/11/2016.
 */
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
                    if (checkLoginFormat()) {
                        time(id);
                        //send sms
                        Helper.post("sendSms", {mobile: $("#mobile").val()}, function (ret) {
                            console.log(ret);
                        });
                    }
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
        if (!(/^(0|86|17951)?(13[0-9]|15[012356789]|16[012356789]|17[678]|18[0-9]|19[0-9]|14[57])[0-9]{8}$/.test(phoneVal))) {
            $(".alert:first").fadeIn().text("手机号码有误，请重填！");
            return false;
        }
        return true;
    };

    //action
    $(function () {
        $("#verification").getSms();


        $("#bindWx").submit(function (e) {
            e.preventDefault();
            if (checkLoginFormat()) {
                $(".alert").fadeOut();
                Helper.post('bingWx', {
                    mobile: $("#mobile").val(),
                    verNum: $("#vernum").val(),
                    vCode: $("#vcode").val()
                }, function (ret) {
                    console.log(ret);
                    if (ret.resCode == "000000") {
                        window.location.href = '?m=index&a=index';
                    } else {
                        if (ret.resCode == -1) {
                            $('.alert').eq(1).fadeIn().text('手机验证码失败')
                        } else if (ret.resCode == "1") {
                            $('.alert').eq(2).fadeIn().text('验证码失败')
                        } else if (ret.resCode == '000002') {
                            $(".alert").eq(1).fadeIn().text('请不要重复发送验证码')
                        } else if (ret.resCode == '000001') {
                            alert(ret.resMsg);
                        } else {
                            alert(ret.resMsg);
                        }
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

});