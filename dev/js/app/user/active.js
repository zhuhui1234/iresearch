define(['helper', 'app/main', 'validator', 'canvas'], function (Helper) {
    ;(function ($) {
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
        })
    })(jQuery)

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

    $(function () {
        $('#verification').getSms()
        $('#step2').hide()
        $('#step3').hide()
        $('#setpBtn1').click(function () {
            $('#step1').hide()
            $('#step2').show()
            $('.step-con')
                .children('li')
                .eq(0)
                .removeClass('active')
            $('.step-con')
                .children('li')
                .eq(1)
                .addClass('active')
        })

        $("#login_action").submit(function (e) {
            e.preventDefault();
            if (checkLoginFormat()) {
                $(".alert").fadeOut();
                pdtID = Helper.getQuery('pro');
                ppName = Helper.getQuery('ppname');
                cb = Helper.getQuery('cb');
                Helper.post('login', {
                    mobile: $("#mobile").val(),
                    verNum: $("#vernum").val(),
                    vCode: $("#vcode").val()
                }, function (ret) {
                    console.log(ret.data.wechat == null);
                    if (ret.resCode == "000000") {
                        if (typeof ret.data.bind_state != 'undefined'
                            && ret.data.bind_state) {
                            $('#step2').hide()
                            $('#step3').show()
                            $('.step-con')
                                .children('li')
                                .eq(1)
                                .removeClass('active')
                            $('.step-con')
                                .children('li')
                                .eq(2)
                                .addClass('active');
                            e.preventDefault();

                            if (ret.data.wechat == null) {
                                $(".scan_qrcode").show();
                                Helper.WeChatQRCode("qrcode_wechat",
                                    "bindingUserFromIRD",
                                    "https://irv.iresearch.com.cn/iResearchDataWeb/public/css/wechat_mini.css");
                            }
                        } else {
                            alert('您使用的手机号已经绑定其它账号。')
                            window.close()
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
                            window.close()
                        }
                    }

                });
            }
        });


        $('#setpBtn3').click(function () {
            console.log(cb)
            if (typeof pdtID == 'string' || typeof ppName == 'string' || typeof cb == 'string') {
                if (pdtID !== null) {
                    if (pdtID.length > 0) {
                        window.location.reload();
                    } else {
                        window.location.href = '?m=index&a=index';
                    }
                } else if (ppName !== null) {
                    if (ppName.length > 0) {
                        window.location.reload();
                    } else {
                        window.location.href = '?m=index&a=index';
                    }
                } else if (cb !== null) {
                    if (cb == 'usercenter') {
                        window.location.href = 'http://irv.iresearch.com.cn/user-center/check/'
                    } else {
                        console.log(cb);
                    }
                }

            } else {
                // console.log('no all');
                window.location.href = '?m=index&a=index';
            }
        })
    })
})