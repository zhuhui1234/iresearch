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
    <link href="{WEBSITE_SOURCE_URL}/css/app.css" rel="stylesheet">
    <!-- 自定义 -->
    <link href="{WEBSITE_SOURCE_URL}/css/docs.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed bootsnav">
    <div class="container-fluid">
        <!-- Start Atribute Navigation -->
        <div class="attr-nav">
            <ul>
                <li class="attr-btn">
                    <a href="" data-toggle="modal" data-target="#login">登录</a>
                </li>
                <li class="attr-btn">
                    <a href="#">注册</a>
                </li>
            </ul>
        </div>
        <!-- End Atribute Navigation -->
        <!-- Start Header Navigation -->
        <div class="navbar-header">
            <a class="navbar-brand" href="#brand"><img src="{WEBSITE_SOURCE_URL}/img/irv_logo.png" class="logo" alt=""></a>
        </div>
        <!-- End Header Navigation -->
        <!-- Collect the nav links, forms, and other content for toggling -->
        <ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp">
            <li class="dropdown megamenu-sw">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="left-icon">
                            <i class="iconfont icon-my-nenu"></i>
                        </span>
                    <span class="right-text">
                            <b>行业导航</b>
                            <i>Ind. Map</i>
                        </span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">公司名录</a></li>
                    <li><a href="#">产品名录</a></li>
                    <li><a href="#">网站名录</a></li>
                </ul>
            </li>
            <li class="dropdown megamenu-fw">
                <a href="ui.html" class="dropdown-toggle" data-toggle="dropdown">
                           <span class="left-icon">
                            <i class="iconfont icon-my-chart"></i>
                        </span>
                    <span class="right-text">
                            <b>行业研究</b>
                            <i>Ind. Research</i>
                        </span>
                </a>
                <ul class="dropdown-menu megamenu-content" role="menu">
                    <li>
                        <div class="row">
                            <div class="col-menu col-xs-6">
                                <div class="content">
                                    <ul class="menu-col menu-tabs">
                                        <li class="active"><a href="#tab1" data-toggle="tab" data-hover="tab">用户行为研究</a></li>
                                        <li><a href="#tab2" data-toggle="tab" data-hover="tab">广告客户研究</a></li>
                                        <li><a id='demo' href="#tab3" data-toggle="tab" data-hover="tab">服务网络研究</a></li>
                                        <li><a href="#tab4" data-toggle="tab" data-hover="tab">其他研究</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-menu col-xs-6">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab2">
                                        <div class="content">
                                            <ul class="menu-col">
                                                <li><a href="#">静态框</a></li>
                                                <li><a href="#">下拉菜单</a></li>
                                                <li><a href="#">标签页</a></li>
                                                <li><a href="#">气泡</a></li>
                                                <li><a href="#">提示框</a></li>
                                                <li><a href="#">警告框</a></li>
                                                <li><a href="#">Collapse</a></li>
                                                <li><a href="#">静态框</a></li>
                                                <li><a href="#">下拉菜单</a></li>
                                                <li><a href="#">标签页</a></li>
                                                <li><a href="#">气泡</a></li>
                                                <li><a href="#">提示框</a></li>
                                                <li><a href="#">警告框</a></li>
                                                <li><a href="#">Collapse</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab1">
                                        <div class="content">
                                            <ul class="menu-col">
                                                <li><a href="#">111</a></li>
                                                <li><a href="#">222</a></li>
                                                <li><a href="#">333</a></li>
                                                <li><a href="#">444</a></li>
                                                <li><a href="#">555</a></li>
                                                <li><a href="#">666</a></li>
                                                <li><a href="#">111</a></li>
                                                <li><a href="#">222</a></li>
                                                <li><a href="#">333</a></li>
                                                <li><a href="#">444</a></li>
                                                <li><a href="#">555</a></li>
                                                <li><a href="#">666</a></li>
                                                <li><a href="#">111</a></li>
                                                <li><a href="#">222</a></li>
                                                <li><a href="#">333</a></li>
                                                <li><a href="#">444</a></li>
                                                <li><a href="#">555</a></li>
                                                <li><a href="#">666</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab3">
                                        <div class="content">
                                            <ul class="menu-col">
                                                <li><a href="#">777</a></li>
                                                <li><a href="#">888</a></li>
                                                <li><a href="#">999</a></li>
                                                <li><a href="#">000</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab4">
                                        <div class="content">
                                            <ul class="menu-col">
                                                <li><a href="#">aaa</a></li>
                                                <li><a href="#">bbb</a></li>
                                                <li><a href="#">ccc</a></li>
                                                <li><a href="#">ddd</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="dropdown megamenu-sw">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <span class="left-icon">
                            <i class="iconfont icon-my-tools"></i>
                        </span>
                    <span class="right-text">
                            <b>数据工具</b>
                            <i>Data Tools</i>
                        </span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">营销优化工具</a></li>
                    <li><a href="#">产品运营工具</a></li>
                </ul>
            </li>
            <li class="dropdown megamenu-sw">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <span class="left-icon">
                            <i class="iconfont icon-my-news"></i>
                        </span>
                    <span class="right-text">
                            <b>行业资讯</b>
                            <i>Ind. Information</i>
                        </span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">行业动态</a></li>
                    <li><a href="#">新媒体推荐</a></li>
                    <li><a href="#">案例分享</a></li>
                    <li><a href="#">招标公告</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>