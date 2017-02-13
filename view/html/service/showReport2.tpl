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
    <title>{title}</title>
    <link href="./public/css/docs.min.css" rel="stylesheet">
</head>
<!-- INCLUDE ../nav.tpl -->

<div class="report">
    <div class="report-menu toggle">
        <h4>
            <img src="./public/img/mVideoTracker.png" width="150" height="40"/>
        </h4>
        <ul>
            <li class="open">
                <a href="#" class="_showReport"
                   cfg_url="http://irv.iresearch.com.cn/iReport/?m=service&a=showReport&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B604"
                   cfg_name="{cfg_name}">首页</a>
            </li>
            <li class="open">
                <a href="#">榜单排行<i class="fa fa-angle-right"></i></a>
                <ul>
                    <li>
                        <a href="#" class="_showReport"
                           cfg_url="http://irv.iresearch.com.cn/iReport/?m=service&a=showReport&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B614">
                            视频媒体
                        </a>
                    </li>
                    <li>
                        <a href="#" class="_showReport"
                           cfg_url="http://irv.iresearch.com.cn/iReport/?m=service&a=showReport&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B613">
                            频道
                        </a>
                    </li>
                    <li>
                        <a href="#" class="_showReport"
                           cfg_url="http://irv.iresearch.com.cn/iReport/?m=service&a=showReport&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B656">
                            性别
                        </a>
                    </li>
                    <li>
                        <a href="#" class="_showReport"
                           cfg_url="http://irv.iresearch.com.cn/iReport/?m=service&a=showReport&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B657">
                            年龄
                        </a>
                    </li>
                    <li>
                        <a href="#" class="_showReport"
                           cfg_url="http://irv.iresearch.com.cn/iReport/?m=service&a=showReport&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B659">
                            设备
                        </a>
                    </li>
                    <li>
                        <a href="#" class="_showReport"
                           cfg_url="http://irv.iresearch.com.cn/iReport/?m=service&a=showReport&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B660">
                            地区
                        </a>
                    </li>
                </ul>
            </li>
            <li class="open">
                <a href="#">媒体内容分析<i class="fa fa-angle-right"></i></a>
                <ul>
                    <li>
                        <a href="#" class="_showReport"
                           cfg_url="http://irv.iresearch.com.cn/iReport/?m=service&a=showReport&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B662">
                            媒体内容分析
                        </a>
                    </li>
                    <!--
                    <li>
                        <a href="#" class="_showReport" cfg_url="http://irv.iresearch.com.cn/iReport/?m=service&a=showReport&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B663">
                            媒体内容分析-日
                        </a>
                    </li>
                    -->
                </ul>
            </li>
            <li class="open">
                <a href="#">视频人群分析<i class="fa fa-angle-right"></i></a>
                <ul>
                    <li>
                        <a href="#" class="_showReport"
                           cfg_url="http://irv.iresearch.com.cn/iReport/?m=service&a=showReport&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B665">
                            视频人群分析
                        </a>
                    </li>
                </ul>
            </li>
            <li class="open">
                <a href="#">视频时段分析<i class="fa fa-angle-right"></i></a>
                <ul>
                    <li>
                        <a href="#" class="_showReport"
                           cfg_url="http://irv.iresearch.com.cn/iReport/?m=service&a=showReport&guid=8BDCF4C1-E1AB-FA26-4DE8-DA382156B666"
                           cfg_name="{cfg_name}" cfg_id="{cfg_id}">
                            视频时段分析
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="report-wrapper full">
        <div class="iframe-content full">
            <div class="loading-report" style="text-align: center; vertical-align: middle; margin-top: 10%">
                <i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>
            </div>
            <div class="show-report">
                <iframe id="frameReport" scrolling="no" width="100%" frameborder="0" default="{default.url}"></iframe>
                <div>
                </div>
            </div>
        </div>
    </div>
    <div class="full-screen">
        <i class="fa fa-bars"></i>
    </div>
    <!-- 开发环境 -->
    <script src="{WEBSITE_SOURCE_URL}/js/lib/requirejs/requirejs.js"></script>
    <script src="{WEBSITE_SOURCE_URL}/js/config.js"></script>
    <script type="text/javascript">
        require.config({baseUrl: '{WEBSITE_SOURCE_URL}/js'});
        require([
            'app/service/showReport',

        ]);
    </script>
    </body>
</html>