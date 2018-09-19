/**
 * user login js
 */
define(['helper', 'app/main', 'validator', 'canvas'], function (Helper) {

    var expired = Helper.getQuery('expired');

    if (expired == '1' || $('#expired').length > 0) {
        $("#timeout_msg").show();
    }


    $(".find_nav_list li").each(function () {
        $(".sideline").css({
            left: 0
        });
        $(".find_nav_list li").eq(0).addClass("find_nav_cur").siblings().removeClass("find_nav_cur");
    });
    var nav_w = $(".find_nav_list li").first().width();
    $(".sideline").width(nav_w);
    $(".find_nav_list li").on('click', function () {
        var id = $(this).attr('id');
        if (id == 'yx') {
            $("#yxLine").show();
            $("#phoneLine").hide();
        } else {
            $("#yxLine").hide();
            $("#phoneLine").show();
        }
        nav_w = $(this).width();
        $(".sideline").stop(true);
        $(".sideline").animate({
            left: $(this).position().left
        }, 300);
        $(".sideline").animate({
            width: nav_w
        });
        $(this).addClass("find_nav_cur").siblings().removeClass("find_nav_cur");
        var fn_w = ($(".find_nav").width() - nav_w) / 2;
        var fnl_l;
        var fnl_x = parseInt($(this).position().left);
        if (fnl_x <= fn_w) {
            fnl_l = 0;
        } else if (fn_w - fnl_x <= flb_w - fl_w) {
            fnl_l = flb_w - fl_w;
        } else {
            fnl_l = fn_w - fnl_x;
        }
        $(".find_nav_list").animate({
            "left": fnl_l
        }, 300);

    });

    var resizeBackground = function () {
        var height = window.innerHeight || (document.documentElement && document.documentElement.clientHeight) ||
            document.body.clientHeight;
        var width = window.innerWidth || (document.documentElement && document.documentElement.clientWidth) ||
            document.body.clientWidth;
        $(".main-image").css({
            height: height
        });
        $(".main").css({
            height: height
        });

        if (width >= 1000) {
            var bodyH = (height - 563) / 2
            $("#jumbotron").css({"height": height + "px", "padding-top": bodyH + "px", "padding-bottom": bodyH + "px"});
        }
    };

    resizeBackground();

    window.onresize = function () {
        resizeBackground();
    }



    $('.tab-p a').click(function () {
        $(this).addClass('actives').siblings().removeClass('actives');
    });


    $(document).ready(function () {
        $('#spinner').css('display',"none");

    });


    var checkFormat = function (lt) {
        var Emails = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/;

        // var tel = /^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/;

        switch (lt) {

            case 'mobile':
                if ($("#tel").intlTelInput("isValidNumber")) {
                    $('#tipone').fadeOut();
                } else {
                    $('#code_img').attr('src', '?m=service&a=charCode&' + Math.random());
                    $('#tipone').fadeIn().text('手机为空或不正确');
                }
                return $("#tel").intlTelInput("isValidNumber");
                break;

            case 'mail':
                var ret = Emails.test($('#yxInput').val());
                if (!ret) {
                    $('#code_img').attr('src', '?m=service&a=charCode&' + Math.random());
                    $('#tipone').fadeIn().text('邮箱为空或不符合格式规范');
                    return false;

                } else {
                    $('#tipone').fadeOut();
                    return true;
                }
                break;
            default:
                // $('#tipone').fadeIn();
                return false;
                break;
        }

    };

    var checkCaptcha = function () {
        if ($('#vernum').val().length <= 0) {
            $('#tipone').fadeIn().text('图形验证码不能为空');
            return false;
        } else {
            return true;
        }
    }


    var login_check = function (cb) {

        $('#spinner').css('display', "none");
        $('.input-item .now:first').focus();
        $('.now').keydown(function (e) {
            e = window.event || evt; //解决兼容问题
            if (e.keyCode >= 48 && e.keyCode <= 57) {
                $(this).attr("type", "text");
            }

            return e.keyCode === 8 || (e.keyCode >= 48 && e.keyCode <= 57)
        });
        $('.now').keyup(function (e) {
            $(this).attr("type", "number");
            if (e.keyCode === 8 && $(this).index() !== 0 && !($(this).attr('fvalue'))) {
                $(this).prev().focus();
            } else if (e.keyCode >= 48 && e.keyCode <= 57) {
                //$(this).attr("type", "text");
                $(this).val(String.fromCharCode(e.keyCode));
            }
            $(this).attr('fvalue', $(this).val());
            //$(this).attr("type", "number");
            if (e.keyCode >= 48 && e.keyCode <= 57)
                if ($(this).index() < 6 && $(this).val() !== '') {
                    $(this).next('input').focus();
                }
            if ($(this).val() !== '' && $(this).next().val() !== '' && $(this).prev().val() !== '' && $(this).siblings()
                .val() !== '') {
                var Arr = [];
                var value = $('.input-item').find('.now');
                for (var i = 0; i < value.length; i++) {
                    Arr.push(value.eq(i).val())
                }
                $('#result').html(Arr.join(','));
                $('#spinner').css('display', 'block')

                if (typeof cb == 'function') {
                    cb();
                }
            }
        });


    };

    var login_type = function () {
        var lt = 'mobile';
        if ($('.find_nav_cur > a').html() == '邮箱登录') {
            lt = 'mail'
            $("#warning_overseas").fadeIn();
            $("#warning_mobile").fadeOut();
        } else {
            $("#warning_mobile").fadeIn();
            $("#warning_overseas").fadeOut();
        }
        return lt;
    };


    //action
    $(function () {

        $('.tab-p a').click(function () {
            $(this).addClass('actives').siblings().removeClass('actives');
        });
        var resource = Helper.getQuery('resource');

        if (resource == 'overseas') {
            // $("#yx").hidden();
            $("#phone").show();
            $("#yx").show();
            // $("#phone").fadeIn();
            // $("#yx").fadeIn();
            $("#yxLine").css({display: "block"});
            $("#phoneLine").css({display:"none"});
            // $("#yx").addClass('find_nav_cur');
            // $("#warning_overseas").show();
            // $("#warning_mobile").hide();


        } else {

            // $("#phone").attr("style", "border:none!important");
            $("#phoneLine").show();
            $("#phone").show();
            $("#yx").hide();

            // $('#input_v').css({visibility: "visible"});
            // $("#email").removeClass('find_nav_cur');
            // $("#mail_login").removeClass('find_nav_cur');
            // $('#email').css({visibility: "hidden"});
            // $('#phone').addClass('find_nav_cur');
            // $('#mobile_login').addClass('find_nav_cur');
            // $("#warning_overseas").hide();
            // $("#warning_mobile").show();
        }

        $("#send_code").fadeIn();

        $("#code_img").click(function () {
            $(this).attr('src', '?m=service&a=charCode&' + Math.random());
        });

        $("#tel").intlTelInput({
            formatOnDisplay: false,
            preferredCountries: ["cn", "hk", "tw", "us", "jp"],
            onlyCountries: ["cn", "hk", "mo", "tw", "us", "gb", "fr", "de", "au", "kr", "jp", "sg"],
            initialCountry: "cn",
            utilsScript: "./dev/js/lib/intl-tel/js/utils.js"
        });


        $('#tipone').fadeOut();
        window.localStorage.clear();

        // $("#verification").getSms();
        $("#send_code").click(function (e) {
            console.log('send code');
            var regExp = /[A-Za-z]+/;
            if (!regExp.test($('#tel').val())) {
                var countryCode = $("#tel").intlTelInput("getSelectedCountryData").iso2.toUpperCase();

                var find_mob = function () {
                    // var country_code = $("#tel").intlTelInput("getSelectedCountryData").dialCode
                    // if (country_code == 86) {
                    //     return $('#tel').val();
                    // } else {
                    //     country_code = country_code;
                    return String(parseInt($('#tel').val()))
                    // }
                }

                if (checkFormat(login_type()) && checkCaptcha()) {

                    var da = {
                        vCode: $("#vernum").val(),
                        login_type: login_type(),
                        mobile: find_mob(),
                        email: $('#yxInput').val(),
                        country_code: countryCode
                    };

                    $('.circular').show();
                    $("#sent").text("发送中 ...");
                    $("#send_code").prop('disabled', true);

                    Helper.post("sendCode", da, function (ret) {
                        console.log(ret);
                        if (ret.resCode == "000000") {
                            var pdtID = Helper.getQuery('pro');
                            var ppName = Helper.getQuery('ppname');
                            var cb = Helper.getQuery('cb');

                            $("#login").fadeOut();
                            $('#test').fadeIn();
                            login_check(function () {
                                var code = null;
                                $('.now').each(function (i, n) {
                                    if (code !== null) {
                                        code = code + $(n).val();
                                    } else {
                                        code = $(n).val();
                                    }
                                });

                                console.log(code);
                                var login_data = {
                                    mobile: da.mobile,
                                    mail: $('#yxInput').val(),
                                    verNum: code,
                                    vCode: da.vCode,
                                    login_type: da.login_type
                                }
                                console.log(login_data);
                                if (String(code).length == 6) {
                                    Helper.post('b_login', login_data, function (ret) {
                                        if (ret.resCode == "000000") {
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
                                            $('.spinner').fadeOut();
                                            $('.now').val(null);
                                            $('.input-item .now:first').focus();
                                            $('#tip').fadeIn().text(ret.resMsg);

                                        }

                                    })
                                } else {
                                    $("#tipone").fadeIn().text('验证码字数错误');
                                }
                            });

                        } else {
                            // $("#loading_send_code").fadeOut();
                            $("#sent").text("发送验证码");
                            $('.circular').hide();
                            $("#send_code").prop('disabled', false);
                            $("#tipone").fadeIn().text(ret.resMsg);
                        }
                    });


                } else {
                    da = null;
                }
            } else {
                $('#tipone').fadeIn().text('手机为空或不正确');
            }


        });


        if (Helper.getQuery('recode') == '404') {
            alert('账号被冻结')
        }

    });


    // WeChat login

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
                Helper.WeChatQRCode('wxLogin', 'wxLoginUserCenter', '//irv.iresearch.com.cn/iResearchDataWeb/public/css/wechat2.css');
                break;
            case 'k':
                Helper.WeChatQRCode('wxLogin', 'wxLoginKnowledge', '//irv.iresearch.com.cn/iResearchDataWeb/public/css/wechat2.css');
                break;
            case 'm':
                Helper.WeChatQRCode('wxLogin', 'wxLoginMsg', '//irv.iresearch.com.cn/iResearchDataWeb/public/css/wechat2.css');
                break;
            case 'ut':
                Helper.WeChatQRCode('wxLogin', 'goToUt', '//irv.iresearch.com.cn/iResearchDataWeb/public/css/wechat2.css');
                break;
            case 'vt':
                Helper.WeChatQRCode('wxLogin', 'goToVT', '//irv.iresearch.com.cn/iResearchDataWeb/public/css/wechat2.css');
                break;
            default:
                Helper.WeChatQRCode('wxLogin', 'wxLogin', '//irv.iresearch.com.cn/iResearchDataWeb/public/css/wechat2.css');
                break;
        }

    } else {
        Helper.WeChatQRCode('wxLogin', 'wxLogin', '//irv.iresearch.com.cn/iResearchDataWeb/public/css/wechat2.css');
    }


});