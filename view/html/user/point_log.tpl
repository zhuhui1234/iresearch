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
    <link href="./public/css/app.min.css" rel="stylesheet">
    <!-- 自定义 -->
    <link href="./public/css/docs.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="//data.iresearch.com.cn/images/favicon.ico" mce_href="http://data.iresearch.com.cn/images/favicon.ico" type="image/x-icon">
</head>
<body>

<div class="container">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> 个人中心首页</a></li>
        <li class="active">账户设置</li>
    </ol>
    <div class="user-center">
        <div class="user-left">
            <div class="user-header">
                <!-- IF avatar = "upload/head/" -->
                <img class="userAvatar" src="./public/img/head_default.png" alt="">
                <!-- ELSE -->
                <img class="userAvatar" src="{avatar}" alt="">
                <!-- ENDIF -->
                <p class="mts">

                    <span class="label label-warning">
                        <!-- IF permissions="1" -->
                        管理员
                        <!-- ELSE -->
                        游客
                        <!-- ENDIF -->
                    </span>
                </p>
                <h4>{username}</h4>
                <!-- <p class="user-time">
                    <i class="iconfont icon-clock"></i>
                    <span>{expireDate}到期</span>
                </p> -->
            </div>
            <!-- INCLUDE ./sidebar.tpl -->
        </div>
        <div class="user-right">
            <h5>积分日志信息</h5>
            <div class="col-sm-12 ">剩余积分:</div>
            <hr>
            <div class="col-sm-12">
                <table class="table table-striped manage" id="point_log">
                    <thead>
                    <tr>
                        <th>内容</th>
                        <th>用户</th>
                        <th>类型</th>
                        <th>消费积分</th>
                        <th>之前余额</th>
                        <th>创建时间</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!--<footer class="inner-footer">-->
<!--<div class="container">-->
<!--<p class="cpr">2002 - 2016 Copyright© 艾瑞数据  31010402000584104020104020</p>-->
<!--</div>-->
<!--</footer>-->

<!-- 开发环境 -->
<script src="{WEBSITE_SOURCE_URL}/js/lib/requirejs/requirejs.js"></script>
<script src="{WEBSITE_SOURCE_URL}/js/config.js"></script>
<script type="text/javascript">
    require.config({baseUrl: '{WEBSITE_SOURCE_URL}/js'});
    require([
        'app/user/point_log',
        'app/home/index'
    ]);
</script>
<script src="//irv.iresearch.com.cn/iResearchDataWeb/dev/js/header.js"></script>
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