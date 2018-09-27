<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>登录页面</title>
    <link rel="shortcut icon" href="//data.iresearch.com.cn/images/favicon.ico"
          mce_href="http://data.iresearch.com.cn/images/favicon.ico"
          type="image/x-icon">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <!-- IE 兼容模式 -->
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=9;IE=EDGE">
    <!-- bootstrap核心样式 -->
    <link href="./public/css/app.css" rel="stylesheet">
    <!-- 国产浏览器高速模式 -->
    <meta name="renderer" content="webkit">
    <!-- bootstrap核心样式 -->
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link href="http://data.iresearch.com.cn/css/bootstrap.min.css" rel="stylesheet">
    <link href="./public/css/bj_login/index.css?2342" rel="stylesheet">
    <link href="./public/css/bj_login/wechat.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="mobileSelect.js-master/css/mobileSelect.css"> -->
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
    <div class="alert" id="timeout_msg" style="display: none;">
        <img class="alert_img" src="./public/img/bj_login/csicon.png"/>
        <div class="alert_txt" >登录超时，请重新登录</div>
    </div>
    <div class="row jumbotron login" id="jumbotron">
        <!-- +row-->
        <div class="row" style="margin:0;" id="row1"><img class="row_img" src="./public/img/bj_login/logo1.png"></div>
        <div class="row" id="row2">
            <div class="main_left" style="display:block" id="login">
                <form autocomplete="off">
                    <div class="find_nav">
                        <div class="find_nav_left">
                            <div class="find_nav_list" id="pagenavi1">
                                <ul>
                                    <li class="nav_tab" id="yx" style="display: none;"><a>邮箱登录</a></li>
                                    <li class="nav_tab" id="phone" style="display: none;"><a >手机登录</a></li>
                                    <li class="sideline" style="display: none;"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="main_left_body">
                        <div class="main_left_body_line" id="yxLine" style="display: none">
                            <div class="main_left_body_line_iconemail"></div>
                            <input type="text" class="yxInput" id="yxInput" placeholder="请输入邮箱..."
                                   autocomplete="off"
                            />
                        </div>
                        <div class="main_left_body_line" id="phoneLine">
                            <div class="main_left_body_line_icon"></div>

                            <input type="text" class="tel" id="tel" placeholder="请输入手机号..."
                                   autocomplete="off"/>
                        </div>

                        <div class="main_left_body_line">
                            <div class="main_left_body_line_icon3"></div>
                            <input type="text" class="main_left_body_line_input" id="vernum" placeholder="请输入图形验证码..."
                                   autocomplete="off"
                            />
                            <div class="main_left_body_line_yzm"><img src="?m=service&a=charCode" id="code_img"></div>
                        </div>
                    </div>
                    <button type="button" class="loading_app main_left_button" id="send_code">
                        <svg viewBox="25 25 50 50" class="circular" style="display: none">
                            <circle cx="50" cy="50" r="20" fill="none" class="path"></circle>
                        </svg>
                        <span id="sent">发送验证码</span>
                    </button>
                    <div id="tipone" style="display: none">手机号或邮箱账号不正确！</div>
                </form>
            </div>
            <div class="col-md-7" id="test" style="display:none;">
                <div class="row coderow" id="codeRow">
                    <div class="tit">
                        <a href="">
                            <h4 class="return"><span id="spaner"></span>返回登录页</h4>
                        </a>
                    </div>
                    <h5 id="login_tips">请输入6位手机验证码</h5>
                    <div class="input-item">
                        <input type="number" name="code" fvalue="" class="now expnum hid" min="0" max="9" maxlength="1"
                               data-index="" autocomplete="off" style="display: none"/>
                        <input type="number" name="code" fvalue="" class="now expnum hid" min="0" max="9" maxlength="1"
                               data-index="" autocomplete="off" style="display: none"/>
                        <input type="number" name="code" fvalue="" class="now expnum eightNow" min="0" max="9" maxlength="1"
                               data-index="" autocomplete="off"/>
                        <input type="number" name="code" fvalue="" class="now expnum eightNow" min="0" max="9" maxlength="1"
                               data-index="" autocomplete="off"/>
                        <input type="number" name="code" fvalue="" class="now expnum eightNow" min="0" max="9" maxlength="1"
                               data-index="" autocomplete="off"/>
                        <input type="number" name="code" fvalue="" class="now expnum eightNow" min="0" max="9" maxlength="1"
                               data-index="" autocomplete="off"/>
                        <input type="number" name="code" fvalue="" class="now expnum eightNow" min="0" max="9" maxlength="1"
                               data-index="" autocomplete="off"/>
                        <input type="number" name="code" fvalue="" class="now expnum eightNow" min="0" max="9" maxlength="1"
                               data-index="" autocomplete="off"/>
                    </div>
                    <div id="spinner_icon" style="height: 40px;margin-top: 20px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="tip" class="text-center"></div>
                            </div>
                            <div class="col-md-12" style="margin-bottom: 30px;height: 30px">
                                <!--loading加载-->
                                <div class="spinner_bak test-center" id="spinner" style="margin: 0 auto; display: none"><i></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main_right" id="main_right_tohiden">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <div class="wxlogin" id="wxLogin">

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