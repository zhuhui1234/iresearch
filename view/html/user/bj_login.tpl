<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>登录页面</title>
    <link rel="shortcut icon" href="//data.iresearch.com.cn/images/favicon.ico" mce_href="http://data.iresearch.com.cn/images/favicon.ico"
          type="image/x-icon">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <!-- IE 兼容模式 -->
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=9;IE=EDGE">
    <!-- 国产浏览器高速模式 -->
    <meta name="renderer" content="webkit">
    <!-- bootstrap核心样式 -->
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link href="http://data.iresearch.com.cn/css/bootstrap.min.css" rel="stylesheet">
    <link href="./public/css/bj_login/index.css" rel="stylesheet">
    <link href="./public/css/bj_login/wechat.css" rel="stylesheet">
    <link rel="stylesheet" href="mobileSelect.js-master/css/mobileSelect.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="http://data.iresearch.com.cn/js/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="http://data.iresearch.com.cn/js/bootstrap.min.js"></script>
    <script src="./dev/js/lib/intl-tel/js/utils.js"></script>
    <link rel="stylesheet" href="./dev/js/lib/intl-tel/css/intlTelInput.css ">
</head>

<body>
<div class="main-image"></div>
<div class="main">
    <div class="alert">
        <img class="alert_img" src="./public/img/bj_login/csicon.png"/>
        <div class="alert_txt">登录超时，请重新登录</div>
    </div>
    <div class="row jumbotron login" id="jumbotron">
        <!-- +row-->
        <div class="row" style="margin:0;" id="row1"><img class="row_img" src="./public/img/bj_login/logo1.png"></div>
        <div class="row" id="row2">
            <div class="main_left" style="display:block">
                <form autocomplete="off">
                    <div class="find_nav">
                        <div class="find_nav_left">
                            <div class="find_nav_list" id="pagenavi1">
                                <ul>
                                    <li id="phone"><a class="active">手机登录</a></li>
                                    <li id="yx"><a>邮箱登录</a></li>
                                    <li class="sideline"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="main_left_body">
                        <div class="main_left_body_line" id="phoneLine">
                            <div class="main_left_body_line_icon"></div>
                            <div class="main_left_body_line_icon2Pc " id="triggerPc">

                            </div>
                            <select class="main_left_body_line_icon2" id="trigger1">
                                <option>+86</option>
                                <option>+86</option>
                                <option>+86</option>
                                <option>+86</option>
                                <option>+86</option>
                            </select>
                            <input type="text" class="main_left_body_line_input" id="tel" placeholder="请输入手机号..." autocomplete="off" />
                        </div>
                        <div class="main_left_body_line" id="yxLine" style="display: none;">
                            <div class="main_left_body_line_icon"></div>
                            <input type="text" class="main_left_body_line_input" id="yxInput" placeholder="请输入邮箱..." autocomplete="off"
                            />
                        </div>
                        <div class="main_left_body_line" >
                            <div class="main_left_body_line_icon3"></div>
                            <input type="text" class="main_left_body_line_input" id="Emails" placeholder="请输入图形验证码..." autocomplete="off"
                            />
                            <div class="main_left_body_line_yzm"><img src="?m=service&a=charCode"></div>
                        </div>
                    </div>
                    <button class="loading main_left_button" id="h" onclick="aaa()" onclick="checkStart()">
                        <svg viewBox="25 25 50 50" class="circular" style="display: none" ><circle cx="50" cy="50" r="20" fill="none" class="path"></circle>
                        </svg>
                        <span>发送验证码</span>
                    </button>
                    <div id="tipone">手机号或邮箱账号不正确！</div>
                </form>
            </div>
            <div class="col-md-7" id="test" style="display:none;">
                <div class="row coderow" id="codeRow">
                    <div class="tit">
                        <a href="">
                            <h4 class="return"><span id="spaner"></span>返回登录页</h4>
                        </a>
                    </div>
                    <h5>请输入6位手机或邮件验证码</h5>
                    <div class="input-item">
                        <input type="number" name="code" fvalue="" class="now" min="0" max="9" maxlength="1" data-index="" autocomplete="off" />
                        <input type="number" name="code" fvalue="" class="now" min="0" max="9" maxlength="1" data-index="" autocomplete="off" />
                        <input type="number" name="code" fvalue="" class="now" min="0" max="9" maxlength="1" data-index="" autocomplete="off" />
                        <input type="number" name="code" fvalue="" class="now" min="0" max="9" maxlength="1" data-index="" autocomplete="off" />
                        <input type="number" name="code" fvalue="" class="now" min="0" max="9" maxlength="1" data-index="" autocomplete="off" />
                        <input type="number" name="code" fvalue="" class="now" min="0" max="9" maxlength="1" data-index="" autocomplete="off" />
                    </div>
                    <div id="spinner_icon" style="height: 40px;margin-top: 20px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="tip" class="text-center"></div>
                            </div>
                            <div class="col-md-12" style="margin-bottom: 30px;height: 30px">
                                <!--loading加载-->
                                <div class="spinner test-center" id="spinner" style="margin: 0 auto;"><i></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main_right" id="main_right_tohiden">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <div class="wxlogin" id="wxLogin">
                            <iframe src="https://open.weixin.qq.com/connect/qrconnect?appid=wxd96928ba062cffec&amp;scope=snsapi_login&amp;redirect_uri=http%3A%2F%2Firv.iresearch.com.cn%2FiResearchDataWeb%2F%3Fm%3Dwechat%26a%3DwxLoginAPI&amp;state=wxLogin&amp;login_type=jssdk&amp;self_redirect=default&amp;href=%2F%2Firv.iresearch.com.cn%2FiResearchDataWeb%2Fpublic%2Fcss%2Fwechat2.css"
                                    frameborder="0" scrolling="no" margin="0 auto">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bgBack_opa"></div>
            <div class="bgBack_opa2"></div>
        </div>
        <div style="clear: both;"></div>
        <div class="footer">
            提示：如果您已经是艾瑞数据用户可以尝试用手机号或者微信扫码直接登录。
        </div>
    </div>
</div>
<script>
    function aaa() {
        document.getElementById("h").innerHTML = "发送中...";
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
</script>
<script src="{WEBSITE_SOURCE_URL}/js/lib/requirejs/requirejs.js"></script>
<script src="{WEBSITE_SOURCE_URL}/js/config.js"></script>
<script type="text/javascript">
    require.config({baseUrl: '{WEBSITE_SOURCE_URL}/js'});
    require([
        'app/user/bj_login'
    ]);
</script>
</body>

</html>