<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="//data.iresearch.com.cn/images/favicon.ico"
          mce_href="//data.iresearch.com.cn/images/favicon.ico" type="image/x-icon">

    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <!-- IE 兼容模式 -->
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=9;IE=EDGE">
    <!-- 国产浏览器高速模式 -->
    <meta name="renderer" content="webkit">
    <!-- bootstrap核心样式 -->
    <link href="./public/css/app.css" rel="stylesheet">
    <!-- 自定义 -->
    <link href="./public/css/docs.min.css" rel="stylesheet">
    <title>{title}</title>
    <style>
        #mobile {
            height: 24px;
        }
    </style>
</head>
<body class="login">
<div id="particles" class="particles"></div>
<div class="login-wrap">
    <div class="login-header">
        <img src="./public/img/irs-data.png" class="img-responsive center-block" alt="">
    </div>
    <div class="row" id="timeout_msg" style="display: none">
        <div class="col-xs-12">
            <p class="text-center alert alert-danger" >您的登录已超时，或已在其他终端登录，请重新登录。</p>
        </div>
    </div>
    <!-- IF mobile!=="1" -->
    <div class="row" id="timeout_msg2" >
        <div class="col-xs-12">
            <p class="text-center alert alert-warning" >您已升级完毕，请使用 {mobile} 手机直接登录艾瑞睿见。</p>
        </div>
    </div>
    <!-- ENDIF -->
    <div class="row">
        <div class="col-xs-5">
            <div id="wxLogin" class=""></div>
        </div>
        <div class="col-xs-7">
            <h4>账号登录</h4>
            <form id="login_action" method="POST">
                <div class="form-group">
                    <span>手机号码</span>
                    <div class="form-right">
                        <input style="height:24px;" type="text" id="mobile" placeholder="请输入绑定的手机号码">
                    </div>
                </div>
                <div class="alert alert-danger">手机号不存在</div>
                <div class="form-group">
                    <span>手机验证码</span>
                    <div class="form-right">
                        <input style="width: 60%;height:24px;" id="vernum" type="text" placeholder="请输入手机验证码" autocomplete="off">
                        <a class="btn btn-warning" id="verification">获取验证码</a>
                    </div>
                </div>
                <div class="alert alert-danger">验证码不正确</div>
                <div class="form-group">
                    <span>验证码</span>
                    <div class="form-right">
                        <input style="width: 60%;height:24px;" id="vcode" type="text" placeholder="请输入验证码" autocomplete="off">
                        <div class="code-img" style="cursor: pointer">
                            <img id="g_code" src="?m=service&a=authImg" alt="">
                        </div>
                    </div>
                </div>
                <div class="alert alert-danger">验证码不正确</div>
                <button type="submit" class="btn btn-primary btn-block">登录</button>
            </form>
        </div>
    </div>
</div>
<!-- IF expired=="1" -->
<div style="display: none" id="expired"></div>
<!-- ENDIF -->
<!-- 开发环境 -->
<script src="{WEBSITE_SOURCE_URL}/js/lib/requirejs/requirejs.js"></script>
<script src="{WEBSITE_SOURCE_URL}/js/config.js"></script>
<script type="text/javascript">
    require.config({baseUrl: '{WEBSITE_SOURCE_URL}/js'});
    require([
        'app/user/login'
    ]);
</script>
<!-- 生产环境 -->
<!--<script src="../public/js/lib/requirejs/requirejs.js"></script>-->
<!--<script src="../public/js/config.js"></script>-->
<!--<script type="text/javascript">-->
<!--require.config({baseUrl: '../public/js'});-->
<!--require([-->
<!--'app/swiper',-->
<!--'app/wow'-->
<!--]);-->
<!--</script>-->
</body>
</html>