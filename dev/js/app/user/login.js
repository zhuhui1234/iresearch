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
                        var mobile_number = $("#mobile").val();
                        console.log(/^4[0]\d{8}$/.test(mobile_number));
                        if (/^4[0]\d{9}$/.test(mobile_number)) {
                            $(".alert").eq(1).fadeIn().text('无需验证，请使用固定验证码');

                        } else {
                            Helper.post("sendSms", {mobile: mobile_number}, function (ret) {
                                console.log(ret);
                                if (ret.resCode == "000002") {
                                    $(".alert").eq(1).fadeIn().text('验证错误');
                                }
                            });
                        }
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
        if (!(/^1[34578]\d{9}$/.test(phoneVal)) && !(/^4[0]\d{9}$/.test(phoneVal))) {

            $(".alert:first").fadeIn().text("手机号码有误，请重填！");
            return false;
        }
        return true;
    };

    //action
    $(function () {
        window.localStorage.clear();
        var expired = Helper.getQuery('expired');

        if (expired == '1') {
            $("#timeout_msg").show();
        }

        $("#verification").getSms();
        $("#login_action").submit(function (e) {
            e.preventDefault();
            if (checkLoginFormat()) {
                $(".alert").fadeOut();
                var pdtID = Helper.getQuery('pro');
                // var u = new URL(window.location.href)
                // var ppName = u.searchParams.get('ppname');
                var ppName = Helper.getQuery('ppname');
                var cb = Helper.getQuery('cb');

                Helper.post('login', {
                    mobile: $("#mobile").val(),
                    verNum: $("#vernum").val(),
                    vCode: $("#vcode").val()
                }, function (ret) {
                    console.log(ret.resCode);
                    if (ret.resCode == "000000") {
                        // console.log(ppName);
                        // console.log(pdtID);

                        // if (typeof pdtID == 'string') {
                        //     if (pdtID.length > 0) {
                        //         window.location.reload();
                        //     } else {
                        //         window.location.href = '?m=index&a=index';
                        //     }
                        // } else if (typeof ppName == 'string') {
                        //     if (ppName.length > 0) {
                        //         window.location.reload();
                        //     } else {
                        //         window.location.href = '?m=index&a=index';
                        //     }
                        // } else {
                        //     window.location.href = '?m=index&a=index';
                        // }
                        // console.log(cb)
                        if (typeof pdtID == 'string' || typeof ppName == 'string' || typeof cb == 'string') {

                            if (pdtID !== null) {
                                if (pdtID.length > 0) {
                                    window.location.reload();
                                } else {
                                    // console.log('no pdtID');
                                    window.location.href = '?m=index&a=index';
                                }
                            } else if (ppName !== null) {
                                if (ppName.length > 0) {
                                    window.location.reload();
                                } else {
                                    window.location.href = '?m=index&a=index';
                                    // console.log('no ppName');
                                }
                            } else if (cb !== null) {
                                switch (cb) {
                                    case 'usercenter':
                                        window.location.href = 'http://irv.iresearch.com.cn/user-center/check';
                                        break;
                                    case 'k':
                                        window.location.href = 'http://irv.iresearch.com.cn/user-center/check??type=k';
                                        break;
                                    case 'm':
                                        window.location.href = 'http://irv.iresearch.com.cn/user-center/check??type=m';
                                        break;
                                }

                            }

                        } else {
                            // console.log('no all');
                            window.location.href = '?m=index&a=index';
                        }
                    } else {
                        if (ret.resCode == -1) {
                            $('.alert').eq(1).fadeIn().text('手机验证码失败');
                        } else if (ret.resCode == "1") {
                            $('.alert').eq(2).fadeIn().text('验证码失败');
                        } else if (ret.resCode == "000002") {
                            $(".alert").eq(1).fadeIn().text(ret.resMsg);
                        } else {
                            alert(ret.resMsg);
                        }
                    }

                });
            }
        });

        //登录背景
        // $('#particles').particleground({
        //     dotColor: '#e7ebee',
        //     lineColor: '#e7ebee',
        //     density: 20000,
        //     proximity: 140,
        //     parallaxMultiplier: 30,
        //     curvedLines: true,
        // });

        if (Helper.getQuery('recode') == '404') {
            alert('账号被冻结')
        }

    });

    console.log(Helper.userAgent);
    var pdtID = Helper.getQuery('pro');
    var ppName = Helper.getQuery('ppname');
    var cb = Helper.getQuery('cb');
    console.log(ppName);
    // var u = new URL(window.location.href)
    // var ppName = u.searchParams.get('ppname');
    if (pdtID !== null && ppName == null) {
        Helper.WeChatQRCode('wxLogin', 'wxLogin', '//irv.iresearch.com.cn/iResearchDataWeb/public/css/wechat.css', pdtID);
    } else if (ppName !== null) {
        Helper.WeChatQRCode('wxLogin', 'wxLogin', '//irv.iresearch.com.cn/iResearchDataWeb/public/css/wechat.css', pdtID, ppName);
    } else if (cb !== null) {
        console.log(cb);
        switch (cb) {
            case 'usercenter':
                Helper.WeChatQRCode('wxLogin', 'wxLoginUserCenter', '//irv.iresearch.com.cn/iResearchDataWeb/public/css/wechat.css');
                break;
            case 'k':
                Helper.WeChatQRCode('wxLogin', 'wxLoginKnowledge', '//irv.iresearch.com.cn/iResearchDataWeb/public/css/wechat.css');
                break;
            case 'm':
                Helper.WeChatQRCode('wxLogin', 'wxLoginMsg', '//irv.iresearch.com.cn/iResearchDataWeb/public/css/wechat.css');
                break;
            default:
                Helper.WeChatQRCode('wxLogin', 'wxLogin', '//irv.iresearch.com.cn/iResearchDataWeb/public/css/wechat.css');
                break;
        }

    } else {
        Helper.WeChatQRCode('wxLogin', 'wxLogin', '//irv.iresearch.com.cn/iResearchDataWeb/public/css/wechat.css');
    }

});