<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>登录页面</title>
    <link rel="shortcut icon" href="//data.iresearch.com.cn/images/favicon.ico"
          mce_href="http://data.iresearch.com.cn/images/favicon.ico" type="image/x-icon">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <!-- IE 兼容模式 -->
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=9;IE=EDGE">
    <!-- 国产浏览器高速模式 -->
    <meta name="renderer" content="webkit">
    <!-- bootstrap核心样式 -->
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="./public/css/b_login/index.css" rel="stylesheet">
    <script src="./dev/js/lib/intl-tel/js/utils.js"></script>
    <link rel="stylesheet" href="./dev/js/lib/intl-tel/css/intlTelInput.css ">
</head>
<body class="login-bg">
<div class="bg">
    <div class="main">
        <div class="jumbotron login" id="jumbotron">
            <div class="row" id="row1"><img src="./public/img/b_login/logo.png"></div>
            <form class="row" id="row2">
                <div class="col-md-7" id="login" >
                    <div id="form" method="POST">
                        <div class="row">
                            <p class="text-center tab-p">
                                <a class="tab actives" href="#phone" data-toggle="tab">手机登录</a>
                                <a class="tab" href="#email" data-toggle="tab">邮箱登录</a>
                            </p>
                        </div>
                        <div id="myTabContent" class="tab-content" >
                            <div class="tab-pane active" id="phone">
                                <div class="input-group" id="inputs" >
                                    <span class="input-group-addon user" ></span>
                                    <input type="tel" class="form-control ipt" id="tel" placeholder="请输入手机号" autocomplete="tel"/>
                                </div>
                            </div>
                            <div class="tab-pane " id="email">
                                <div class="input-group" id="inputs" >
                                    <span class="input-group-addon user" ></span>
                                    <input type="email" class="form-control ipt" id="Emails" placeholder="请输入邮箱" autocomplete="email"/>
                                </div>
                            </div>
                            <div class="input-group two" >
                                <span class="input-group-addon key"></span>
                                <input id="vernum" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" autocomplete="off"  placeholder="请输入验证码">
                                <span class="input-group-addon" id="code"><img id="code_img" src="?m=service&a=charCode"></span>
                            </div>
                            <div class="pull-right" >
                                <button  type="button" class="loading"  id="send_code" >
                                    <svg viewBox="25 25 50 50" class="circular" style="display: none"><circle cx="50" cy="50" r="20" fill="none" class="path"></circle>
                                    </svg>
                                    <span id="sent">发送验证码</span>
                                </button>
                            </div>
                            <div id="tipone" style="display: none">手机号或邮箱账号输入不对！</div>
                        </div>
                    </div>

                </div>
                <div class="col-md-7" id="test" style="display: none">
                    <div class="row">
                        <div class="tit">
                            <a href=""><h4 id="tab-p"><span id="spaner">&lt;</span> 手机或邮箱验证</h4></a>
                        </div>

                        <h5>请输入6位手机或邮箱验证码</h5>
                        <div class="input-item">
                            <input type="number" name="code" fvalue="" class="now" min="0" max="9" maxlength="1" autocomplete="off"/>
                            <input type="number" name="code" fvalue="" class="now" min="0" max="9" maxlength="1" autocomplete="off"/>
                            <input type="number" name="code" fvalue="" class="now" min="0" max="9" maxlength="1" autocomplete="off"/>
                            <input type="number" name="code" fvalue="" class="now" min="0" max="9" maxlength="1" autocomplete="off"/>
                            <input type="number" name="code" fvalue="" class="now" min="0" max="9" maxlength="1" autocomplete="off"/>
                            <input type="number" name="code" fvalue="" class="now" min="0" max="9" maxlength="1" autocomplete="off"/>
                        </div>
                        <div id="spinner_icon" style="height: 40px;margin-top: 20px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="tip" class="text-center"></div>
                                </div>
                                <div class="col-md-12" style="margin-bottom: 30px">
                                    <!--loading加载-->
                                    <div class="spinner test-center" id="spinner" style="margin: 0 auto;"><i></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5" >
                    <div class="box" >
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <div  class="wxlogin" id="wxLogin" style="text-align: center">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="footer">
                <h5 class="text-center" >提示：如果你没有艾瑞数据账号，可以用手机号、企业邮箱直接注册或微信扫码注册；</h5>
                <h5 class="text-center" >如果您已经是艾瑞数据用户可以尝试用手机号或者微信扫码直接登录。</h5>
            </div>
        </div>
    </div>
    <script src="{WEBSITE_SOURCE_URL}/js/lib/requirejs/requirejs.js"></script>
    <script src="{WEBSITE_SOURCE_URL}/js/config.js"></script>
    <script type="text/javascript">
        require.config({baseUrl: '{WEBSITE_SOURCE_URL}/js'});
        require([
            'app/user/b_login'
        ]);
    </script>
</body>
</html>