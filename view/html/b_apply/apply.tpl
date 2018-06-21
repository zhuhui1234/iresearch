<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>登录页面</title>
    <link rel="shortcut icon" href="//data.iresearch.com.cn/images/favicon.ico" mce_href="http://data.iresearch.com.cn/images/favicon.ico"
          type="image/x-icon">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <!-- IE 兼容模式 -->
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=9;IE=EDGE">
    <!-- 国产浏览器高速模式 -->
    <meta name="renderer" content="webkit">
    <!-- bootstrap核心样式 -->
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link href="http://data.iresearch.com.cn/css/bootstrap.min.css" rel="stylesheet">
    <link href="./public/css/b_login/index.css" rel="stylesheet">

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="//data.iresearch.com.cn/js/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="//data.iresearch.com.cn/js/bootstrap.min.js"></script>

</head>

<body>
<div class="main-background"></div>
<div class="main">
    <div class="jumbotron four">
        <div class="row" id="row1">
            <img src="./public/img/b_login/logo.png">
        </div>
        <div class="row" id="row2">
            <div class="col-md-7">
                <form id="form">
                    <div class="form-group clearfix">
                        <label class="col-sm-3 control-label">姓名
                            <span class="spans">*</span>
                        </label>
                        <div class="col-sm-9 text-left">
                            <input type="text" class="form-control newv" id="name" placeholder="请输入名字" autocomplete="off" value="{username}">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-sm-3 control-label">手机号
                            <span class="spans">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control newv" id="phone" type="tel" placeholder="请输入手机号" autocomplete="off" value="{mobile}">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-sm-3 control-label">邮箱
                            <span class="spans">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control newv" id="mail" type="email" placeholder="请输入邮箱" autocomplete="off" value="{u_mail}">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-sm-3 control-label">公司
                            <span class="spans">*</span>
                        </label>
                        <div class="col-sm-9 text-left">
                            <input type="text" class="form-control newv" id="company" placeholder="请输入公司" autocomplete="off" value="{company}">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-sm-3 control-label">职位
                            <span></span>
                        </label>
                        <div class="col-sm-9 text-left">
                            <input type="text" class="form-control newt" id="job" placeholder="请输入职位" autocomplete="off" value="{position}">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-sm-3 control-label newt">行业
                            <span class="spans">*</span>
                        </label>
                        <div class="col-sm-9 text-left">
                            <select class="form-control" id="industry">
                            <option value="0" selected="selected">请选择行业(必填)</option>
                            <!-- BEGIN industrylist -->
                            <option value='{id}'>{title}</option>
                            <!-- END industrylist -->
                            </select>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-sm-3 control-label newt" id="adr">地区
                            <span class="spans">*</span>
                        </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="city">
                                <option value="0" selected="selected">请选择地区(必填)</option>
                                <!-- BEGIN regionList -->
                                <option value='{id}'>{title}</option>
                                <!-- END regionList -->
                            </select>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-sm-3 control-label">验证码
                            <span>*</span>
                        </label>
                        <div class="col-sm-6 text-left">
                            <input type="text" class="form-control newv" id="code" placeholder="请输入验证码" autocomplete="off">
                        </div>
                        <div class="col-sm-3 Verification" id="identifying"><img id="charCode" src="?m=service&a=charCode" alt=""></div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button class="btn btn-success" type="button" id="applyToTrial"
                            >提交申请</button>
                        </div>
                    </div>
                    <div class="tips">请输入完成信息!</div>
                </form>
            </div>
            <div class="col-md-5 wxright" style="padding: 60px;">
                <div class="row" id="bot">
                    <img src="{productLogoUrl}" style="text-align: center">
                    <div class=" tits">
                        {productIntroduce}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 开发环境 -->
<script src="{WEBSITE_SOURCE_URL}/js/lib/requirejs/requirejs.js"></script>
<script src="{WEBSITE_SOURCE_URL}/js/config.js"></script>
<script type="text/javascript">
    require.config({baseUrl: '{WEBSITE_SOURCE_URL}/js'});
    require([
        'app/home/trail_b'
    ]);
</script>
<script src="//irv.iresearch.com.cn/iResearchDataWeb/dev/js/header.js"></script>
</body>
</html>