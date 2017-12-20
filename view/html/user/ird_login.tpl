<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <!-- IE 兼容模式 -->
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- 国产浏览器高速模式 -->
    <meta name="renderer" content="webkit">
    <!-- bootstrap核心样式 -->
    <link href="./public/css/ird_app.css" rel="stylesheet">
    <!-- 自定义 -->
    <link href="./public/css/ird_docs.min.css" rel="stylesheet">
</head>

<body class="login">
<div id="particles" class="particles"></div>
<div class="login-wrap">
    <div class="login-header">
        <img src="./public/img/irs-data.png" class="img-responsive center-block" alt="">
    </div>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <ul class="step-con">
                <li class="active">
                    <span class="num">1</span>
                    <span>确认信息</span>
                </li>
                <li>
                    <span class="num">2</span>
                    <span>绑定账号</span>
                </li>
                <li>
                    <span class="num">3</span>
                    <span>完成</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="row" id="step1">
        <div class="col-xs-10 col-xs-offset-1">
            <div class="step-inner">
                <p style="margin-bottom: 30px; text-indent: 28px">我们将帮助您完成绑定艾瑞数据新版，请确认以下经典版iRD账号信息，如果确认无误，请点击“下一步”。</p>
                <div class="row" style="margin-bottom: 15px">
                    <div class="col-xs-3">用户姓名：</div>
                    <div class="col-xs-9">{TrueName}</div>
                </div>
                <div class="row" style="margin-bottom: 15px">
                    <div class="col-xs-3">邮箱：</div>
                    <div class="col-xs-9">{UserName}</div>
                </div>
                <div class="row" style="margin-bottom: 15px">
                    <div class="col-xs-3">公司：</div>
                    <div class="col-xs-9">{CompanyName}</div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-block" id="setpBtn1">下一步</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="step2">
        <div class="col-xs-10 col-xs-offset-1">
            <!-- <h4>绑定手机</h4> -->
            <div class="step-inner">
                <p style="margin-bottom: 30px; text-indent: 28px">
                    该手机号是将来用作登录艾瑞数据新版平台的账号，请妥善保存。如您已经开通过艾瑞数据下的艾瑞睿见或艾瑞智云产品的账号，请使用该手机账号进行绑定。我们将为您同步权限信息到新的产品平台上。</p>
                <form id="login_action" method="POST">
                    <div class="form-group">
                        <span>手机号码</span>
                        <div class="form-right">
                            <input type="text" id="mobile" placeholder="请输入绑定的手机号码">
                        </div>
                    </div>
                    <div class="alert alert-danger">手机号不存在</div>
                    <div class="form-group">
                        <span>手机验证码</span>
                        <div class="form-right">
                            <input type="text" id="vernum" placeholder="请输入手机验证码">
                            <a class="btn btn-warning" id="verification">获取验证码</a>
                        </div>
                    </div>
                    <div class="alert alert-danger">验证码不正确</div>
                    <div class="form-group">
                        <span>验证码</span>
                        <div class="form-right">
                            <input type="text" id="vcode" placeholder="请输入验证码">
                            <div class="code-img">
                                <img src="?m=service&a=authImg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-danger">验证码不正确</div>
                    <button class="btn btn-primary btn-block" type="submit">确 定</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row" id="step3">
        <div class="col-xs-10 col-xs-offset-1" style="text-align: center">
            <div class="step-inner">
                <i class="fa fa-check-circle" style="font-size: 48px; color: #69c72b"></i>
                <p style="margin: 30px 0">恭喜您已经成功绑定艾瑞数据新版和经典版iRD账号，请点击“开始使用”尝试新的体验吧。</p>

                <p style="margin: 30px 0;" class="scan_qrcode">
                <p style="margin: 30px 0; display:none" class="scan_qrcode">您也可以选择扫描二维码绑定微信，之后可以用微信账号扫码登录。</p>
                <div id="qrcode_wechat"></div>
                </p>

                <button class="btn btn-primary btn-block" id="setpBtn3">直接进入产品</button>
            </div>
        </div>
    </div>
    <p style="margin-top: 30px; text-align: center; color: #888; font-size: 12px; text-indent: 24px">
        如在绑定过程中遇到困难，请拨打客服热线：（北京）010-51283899-823
        （上海）021-51082699-881，或发送邮件至：ask@iresearch.com.cn，我们会帮助您解决任何在绑定账号和产品使用过程中遇到的任何问题。</p>
</div>
<!-- 开发环境 -->
<script src="{WEBSITE_SOURCE_URL}/js/lib/requirejs/requirejs.js"></script>
<script src="{WEBSITE_SOURCE_URL}/js/config.js"></script>
<script type="text/javascript">
    require.config({baseUrl: '{WEBSITE_SOURCE_URL}/js'});
    require([
        'app/user/active'
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