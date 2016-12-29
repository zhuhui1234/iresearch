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
    <link href="./public/css/app.css" rel="stylesheet">
    <!-- 自定义 -->
    <link href="./public/css/docs.min.css" rel="stylesheet">
    <title>{title}</title>
</head>
<body>
<!-- INCLUDE ../nav.tpl -->
<div class="container">
    <div class="focus-main">
        <div class="focus-main-right">
            <ul>
                <li class="active">
                    <a href="#">
                        <i class="iconfont icon-iResearchData"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="iconfont icon-iKolTracker"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="iconfont icon-mVideoTracker"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="iconfont icon-MUTmeijieban"></i>
                    </a>
                </li>
            </ul>
            <div class="menu_bg"></div>
        </div>
        <div class="focus-main-left">
            <ul>
                <li class="active">
                    <h1>
                        <img src="./public/img/iResearchData.png" height="55" alt="">
                    </h1>
                    <p>iResearchData是艾瑞咨询集团推出的互联网综合数据服务平台，整合了艾瑞旗下所有数据产品，实现数据互联互通，为互联网企业提供杰出数据服务</p>
                    <img src="./public/img/iResearchData.jpg" alt="" class="img-responsive center-block">
                    <!-- <p class="text-center">
                        <a href="#" class="btn btn-outline-warning" data-toggle="modal" data-target="#myModal">绑定历史版 <i class="fa fa-angle-right"></i></a>
                    </p> -->
                </li>
                <li>
                    <h1>
                        <img src="./public/img/IKOlogo.png" height="55" alt="">
                    </h1>
                    <p></p>
                    <img src="./public/img/iko.jpg" alt="" class="img-responsive center-block">
                    <p class="text-center">
                        <!-- IF role="0" -->
                        <span class="btn btn-outline-warning">未开通</span>
                        <!-- ELSE -->
                        <a href="#" class="btn btn-outline-warning">即将上线<i class="fa fa-angle-right"></i></a>
                        <!-- ENDIF -->
                    </p>
                </li>
                <li>
                    <h1>
                        <img src="./public/img/mvtlogo.png" height="55" alt="">
                    </h1>
                    <p>mVideoTracker基于运营商级别的家庭用户观看移动网络视频内容的收视行为数据，助力广告主优化广告投放策略，提升广告投放效果。</p>
                    <img src="./public/img/MVT.jpg" alt="" class="img-responsive center-block">
                    <p class="text-center">
                        <!-- IF role="0" -->
                        <span class="btn btn-outline-warning">未开通</span>
                        <!-- ELSE -->
                        <a href="?m=industry&a=showIndustryReport" class="btn btn-outline-warning">立即进入 <i class="fa fa-angle-right"></i></a>
                        <!-- ENDIF -->
                    </p>
                </li>
                <li>
                    <h1>
                        <img src="./public/img/MUTlogo.png" height="25" alt="">
                    </h1>
                    <p>MUT媒介版是基于艾瑞全终端海量用户数据，用规则识别，机器学习等方法进行用户属性，习惯，兴趣，偏好等的知识挖掘，形成强大的人群规划用于用户画像与媒介计划。助力媒体公司更全面的发现自己的优势，帮助广告公司更精准的广告投放。</p>
                    <img src="./public/img/MUT.jpg" alt="" class="img-responsive center-block">
                    <p class="text-center">
                        <!-- IF role="0" -->
                        <span class="btn btn-outline-warning">未开通</span>
                        <!-- ELSE -->
                        <a href="?m=index&a=mutMedia" class="btn btn-outline-warning">立即进入 <i class="fa fa-angle-right"></i></a>
                        <!-- ENDIF -->
                    </p>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- --INCLUDE ../foot.tpl -->
<!-- 开发环境 -->
<script src="{WEBSITE_SOURCE_URL}/js/lib/requirejs/requirejs.js"></script>
<script src="{WEBSITE_SOURCE_URL}/js/config.js"></script>
<script type="text/javascript">
    require.config({baseUrl: '{WEBSITE_SOURCE_URL}/js'});
    require([
        'app/home/index'
    ]);
</script>
<!-- 生产环境 -->
<!--<script src="./public/js/lib/requirejs/requirejs.js"></script>-->
<!--<script src="./public/js/config.js"></script>-->
<!--<script type="text/javascript">-->
    <!--require.config({baseUrl: './public/js'});-->
    <!--require([-->
        <!--'app/swiper',-->
        <!--'app/wow'-->
    <!--]);-->
<!--</script>-->
</body>
</html>