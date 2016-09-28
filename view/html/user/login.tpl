<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- IE 兼容模式 -->
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- 国产浏览器高速模式 -->
    <meta name="renderer" content="webkit">
    <!-- bootstrap核心样式 -->
    <link href="{WEBSITE_SOURCE_URL}/css/app.min.css" rel="stylesheet">
    <!-- demo -->
    <link href="{WEBSITE_SOURCE_URL}/css/docs.min.css" rel="stylesheet">
</head>
<body class="login-body">
<div class="container">

    <form role="form" class="form-signin" id="userLogin" action="?m=user&a=loginAPI" method="post">
        <div class="form-signin-heading text-center">
            <img src="{WEBSITE_SOURCE_URL}/img/irv_logo.png" alt="" class="img-responsive"/>
        </div>
        <div class="login-wrap">
            <div class="form-group">
                <label>请输入企业邮箱</label>
                <input type="email" class="form-control" name="loginAccount" placeholder="注册邮箱">
            </div>
            <div class="form-group">
                <label>请输入密码</label>
                <input type="password" class="form-control" name="loginPassword" placeholder="登入密码">
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">
                登录
            </button>
            <div class="registration">
                <!--<div class="checkbox">
                    <label>
                        <input type="checkbox" value="" data-toggle="checkbox">
                        记住密码
                    </label>
                    <span class="pull-right">
                        <a data-toggle="modal" href="#myModal">忘记密码?</a>
                    </span>
                </div> -->
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <a href="?m=user&a=register" class="btn btn-block btn-default">免费注册</a>
                </div>
                <div class="col-xs-6">
                    <!-- <button class="btn btn-block btn-default">已绑定微信登录</button> -->
                    <a id="forgotPwd" class="btn btn-block btn-default">忘记密码?</a>
                </div>
            </div>
        </div>
    </form>
        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">找回密码</h4>
                    </div>
                    <form action="">
                    <div class="modal-body">

                        <p>输入您的邮箱找回密码</p>
                        <input type="text" name="user_email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                        <button class="btn btn-primary" type="button">确定</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- modal -->

</div>
<!-- 开发环境 -->
<script src="{WEBSITE_SOURCE_URL}/js/lib/requirejs/requirejs.js"></script>
<script src="{WEBSITE_SOURCE_URL}/js/config.js"></script>
<script>
    require.config({baseUrl: '{WEBSITE_SOURCE_URL}/js'});
    require([
//        'app/indicator',
//        'app/swiper',
//        'app/wow',
        //'app/validator',
//        'app/user/index',
        'app/user/login'
    ]);
</script>
<!-- 生产环境 -->
<!--<script src="{WEBSITE_SOURCE_URL}/js/lib/requirejs/requirejs.js"></script>-->
<!--<script src="{WEBSITE_SOURCE_URL}/js/config.js"></script>-->
<!--<script type="text/javascript">-->
<!--require.config({baseUrl: 'public/js'});-->
<!--</script>-->
</body>
</html>