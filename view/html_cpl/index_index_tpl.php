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
    <link href="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/css/app.css" rel="stylesheet">
    <!-- 自定义 -->
    <link href="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/css/docs.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed bootsnav">
    <div class="container-fluid">
        <!-- Start Atribute Navigation -->
        <div class="attr-nav">
            <?php
if (!empty($_obj['loginStatus'])){
?>
            <ul>
                <li class="attr-btn">
                    <a href="" data-toggle="modal" data-target="#login">登录</a>
                </li>
                <li class="attr-btn">
                    <a href="?m=user&a=register">注册</a>
                </li>
            </ul>
            <?php
} else {
?>
            <ul>
                <!-- <li>
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="搜索">
                        <i class="iconfont icon-my-search"></i>
                    </a>
                </li>
                <li>
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="消息">
                        <i class="iconfont icon-my-msg"></i>
                        <span class="badge">3</span>
                    </a>
                </li> -->
                <li>
                    <a href="?m=user&a=editUserInfo" data-toggle="tooltip" data-placement="bottom" title="个人中心">
                        <i class="iconfont icon-my-user"></i>
                    </a>
                </li>
                <li>
                    <a href="?m=user&a=loginOut" data-toggle="tooltip" data-placement="bottom" title="退出登录">
                        <i class="iconfont icon-my-logout"></i>
                    </a>
                </li>
            </ul>
            <?php
}
?>
        </div>
        <!-- End Atribute Navigation -->
        <!-- Start Header Navigation -->
        <div class="navbar-header">
            <a class="navbar-brand" href="?"><img src="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/img/irv_logo.png" class="logo" alt=""></a>
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
                                        <?php
if (!empty($_obj['userIndustry']['max'])){
if (!is_array($_obj['userIndustry']['max']))
$_obj['userIndustry']['max']=array(array('max'=>$_obj['userIndustry']['max']));
$_tmp_arr_keys=array_keys($_obj['userIndustry']['max']);
if ($_tmp_arr_keys[0]!='0')
$_obj['userIndustry']['max']=array(0=>$_obj['userIndustry']['max']);
$_stack[$_stack_cnt++]=$_obj;
foreach ($_obj['userIndustry']['max'] as $rowcnt=>$max) {
$max['ROWCNT']=$rowcnt;
$max['ROWNUM']=$rowcnt+1;
$max['ALTROW']=$rowcnt%2;
$max['ROWBIT']=$rowcnt%2;
$_obj=&$max;
?>
                                        <li><a href="#tab<?php
echo $_obj['ity_id'];
?>
" data-toggle="tab" data-hover="tab"><?php
echo $_obj['ity_name'];
?>
</a>
                                        </li>
                                        <?php
}
$_obj=$_stack[--$_stack_cnt];}
?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-menu col-xs-6">
                                <div class="tab-content">
                                    <?php
if (!empty($_obj['userIndustry']['min'])){
if (!is_array($_obj['userIndustry']['min']))
$_obj['userIndustry']['min']=array(array('min'=>$_obj['userIndustry']['min']));
$_tmp_arr_keys=array_keys($_obj['userIndustry']['min']);
if ($_tmp_arr_keys[0]!='0')
$_obj['userIndustry']['min']=array(0=>$_obj['userIndustry']['min']);
$_stack[$_stack_cnt++]=$_obj;
foreach ($_obj['userIndustry']['min'] as $rowcnt=>$min) {
$min['ROWCNT']=$rowcnt;
$min['ROWNUM']=$rowcnt+1;
$min['ALTROW']=$rowcnt%2;
$min['ROWBIT']=$rowcnt%2;
$_obj=&$min;
?>
                                    <div class="tab-pane" id="tab<?php
echo $_obj['pid'];
?>
">
                                        <div class="content">
                                            <ul class="menu-col">
                                                <?php
if (!empty($_obj['info'])){
if (!is_array($_obj['info']))
$_obj['info']=array(array('info'=>$_obj['info']));
$_tmp_arr_keys=array_keys($_obj['info']);
if ($_tmp_arr_keys[0]!='0')
$_obj['info']=array(0=>$_obj['info']);
$_stack[$_stack_cnt++]=$_obj;
foreach ($_obj['info'] as $rowcnt=>$info) {
$info['ROWCNT']=$rowcnt;
$info['ROWNUM']=$rowcnt+1;
$info['ALTROW']=$rowcnt%2;
$info['ROWBIT']=$rowcnt%2;
$_obj=&$info;
?>
                                                <?php
if ($_obj['ity_name'] == "暂无数据"){
?>
                                                <li>
                                                    <a href="#"><?php
echo $_obj['ity_name'];
?>
</a>
                                                </li>
                                                <?php
} else {
?>
                                                <li>
                                                    <a href="?m=industry&a=showIndustryReport&cfg_model=<?php
echo $_obj['ity_id'];
?>
&ity_name=<?php
echo $_obj['ity_name'];
?>
&pname=<?php
echo $_obj['pname'];
?>
"><?php
echo $_obj['ity_name'];
?>
</a>
                                                </li>
                                                <?php
}
?>

                                                <?php
}
$_obj=$_stack[--$_stack_cnt];}
?>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php
}
$_obj=$_stack[--$_stack_cnt];}
?>
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
                    <li><a href="/MUTmedia/?m=index&a=index&token=<?php
echo $_obj['token'];
?>
&u_account=<?php
echo $_obj['u_account'];
?>
">媒体计划</a></li>
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

<div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide" style="background-image:url('<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/img/map_bg.png')">
            <h1 data-swiper-parallax="-100">343,43.445 <span class="fa fa-long-arrow-up"></span></h1>
            <h4 data-swiper-parallax="-500">总览网民覆盖</h4>
            <div class="container">
                <div class="row">
                    <div class="col-xs-3 text-center" data-swiper-parallax="-500">
                        <div class="index-data">
                            <h5>视频全民覆盖</h5>
                            <h4>343,43.44</h4>
                            <div class="indicator1"></div>
                            <p><span class="fa fa-caret-up"></span> 环比30%</p>
                        </div>
                    </div>
                    <div class="col-xs-3 text-center" data-swiper-parallax="-1000">
                        <div class="index-data">
                            <h5>视频全民覆盖</h5>
                            <h4>343,43.44</h4>
                            <div class="indicator2"></div>
                            <p><span class="fa fa-caret-up"></span> 环比30%</p>
                        </div>
                    </div>
                    <div class="col-xs-3 text-center" data-swiper-parallax="-1500">
                        <div class="index-data">
                            <h5>视频全民覆盖</h5>
                            <h4>343,43.44</h4>
                            <div class="indicator3"></div>
                            <p><span class="fa fa-caret-up"></span> 环比30%</p>
                        </div>
                    </div>
                    <div class="col-xs-3 text-center" data-swiper-parallax="-2000">
                        <div class="index-data">
                            <h5>视频全民覆盖</h5>
                            <h4>343,43.44</h4>
                            <div class="indicator4"></div>
                            <p><span class="fa fa-caret-up"></span> 环比30%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-slide">
            <h1 data-swiper-parallax="-100">343,43.445</h1>
            <h4 data-swiper-parallax="-1500">总览网民覆盖</h4>
        </div>
        <div class="swiper-slide">
            <h1 data-swiper-parallax="-100">343,43.445</h1>
            <h4 data-swiper-parallax="-1500">总览网民覆盖</h4>
        </div>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination-white"></div>
</div>
<div class="server-info">
    <div class="container">
        <h2 class="text-center wow fadeIn">服务内容</h2>
        <div class="row">
            <div class="col-xs-4 wow fadeIn">
                <a href="?m=industry&a=showIndustryReport&cfg_model=7&ity_name=公司资产服务排名&pname=网络应用行业">
                    <img src="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/img/icon-1.png" class="img-responsive center-block" alt="">
                    <h4>互联网行业</h4>
                    <p>PC端移动端用户网络行为等</p>
                </a>
            </div>
            <div class="col-xs-4 wow fadeIn">
                <a href="?m=industry&a=showIndustryReport&cfg_model=12&ity_name=视频跨屏行为研究&pname=网络视频行业">
                    <img src="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/img/icon-2.png" class="img-responsive center-block" alt="">
                    <h4>网络视频行业</h4>
                    <p>PC网站、移动App、电视盒子、KOL网红、PC网站、移动App、电视</p>
                </a>
            </div>
            <div class="col-xs-4 wow fadeIn">
                <a href="#">
                    <img src="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/img/icon-3.png" class="img-responsive center-block" alt="">
                    <h4>网络应用行业</h4>
                    <p>PC网站、移动App、电视盒子、KOL网红、PC网站、移动App、电视</p>
                </a>
            </div>
            <div class="col-xs-4 wow fadeIn">
                <a href="#">
                    <img src="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/img/icon-4.png" class="img-responsive center-block" alt="">
                    <h4>网络应用行业</h4>
                    <p>PC网站、移动App、电视盒子、KOL网红、PC网站、移动App、电视</p>
                </a>
            </div>
            <div class="col-xs-4 wow fadeIn">
                <a href="#">
                    <img src="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/img/icon-5.png" class="img-responsive center-block" alt="">
                    <h4>网络应用行业</h4>
                    <p>PC网站、移动App、电视盒子、KOL网红、PC网站、移动App、电视</p>
                </a>
            </div>
            <div class="col-xs-4 wow fadeIn">
                <a href="#">
                    <img src="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/img/icon-6.png" class="img-responsive center-block" alt="">
                    <h4>网络应用行业</h4>
                    <p>PC网站、移动App、电视盒子、KOL网红、PC网站、移动App、电视</p>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="news">
    <div class="container">
        <div class="row">
            <div class="col-xs-8">
                <div class="inner-news">
                    <h3 class="news-title">新闻资讯</h3>
                    <ul>
                        <li class="wow fadeIn">
                            <div class="row">
                                <div class="col-xs-3 text-center">
                                    <img src="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/img/img-1.png" alt="" class="img-responsive center-block">
                                </div>
                                <div class="col-xs-9">
                                    <h4>买下这家店后,联合利华终于有了剃须品牌</h4>
                                    <p>联合利华以 10 亿美金价格全资收购了一家做老朋友切赫的大门老朋友切赫的大门老朋友切赫</p>
                                    <p>一小时前 新浪</p>
                                </div>
                            </div>
                        </li>
                        <li class="wow fadeIn">
                            <div class="row">
                                <div class="col-xs-3 text-center">
                                    <img src="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/img/img-1.png" alt="" class="img-responsive center-block">
                                </div>
                                <div class="col-xs-9">
                                    <h4>买下这家店后,联合利华终于有了剃须品牌</h4>
                                    <p>联合利华以 10 亿美金价格全资收购了一家做老朋友切赫的大门老朋友切赫的大门老朋友切赫</p>
                                    <p>一小时前 新浪</p>
                                </div>
                            </div>
                        </li>
                        <li class="wow fadeIn">
                            <div class="row">
                                <div class="col-xs-3 text-center">
                                    <img src="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/img/img-1.png" alt="" class="img-responsive center-block">
                                </div>
                                <div class="col-xs-9">
                                    <h4>买下这家店后,联合利华终于有了剃须品牌</h4>
                                    <p>联合利华以 10 亿美金价格全资收购了一家做老朋友切赫的大门老朋友切赫的大门老朋友切赫</p>
                                    <p>一小时前 新浪</p>
                                </div>
                            </div>
                        </li>
                        <li class="wow fadeIn">
                            <div class="row">
                                <div class="col-xs-3 text-center">
                                    <img src="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/img/img-1.png" alt="" class="img-responsive center-block">
                                </div>
                                <div class="col-xs-9">
                                    <h4>买下这家店后,联合利华终于有了剃须品牌</h4>
                                    <p>联合利华以 10 亿美金价格全资收购了一家做老朋友切赫的大门老朋友切赫的大门老朋友切赫</p>
                                    <p>一小时前 新浪</p>
                                </div>
                            </div>
                        </li>
                        <li class="wow fadeIn">
                            <div class="row">
                                <div class="col-xs-3 text-center">
                                    <img src="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/img/img-1.png" alt="" class="img-responsive center-block">
                                </div>
                                <div class="col-xs-9">
                                    <h4>买下这家店后,联合利华终于有了剃须品牌</h4>
                                    <p>联合利华以 10 亿美金价格全资收购了一家做老朋友切赫的大门老朋友切赫的大门老朋友切赫</p>
                                    <p>一小时前 新浪</p>
                                </div>
                            </div>
                        </li>
                        <a href="#" class="btn btn-default btn-block wow fadeIn">查看更多</a>
                    </ul>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="download-app wow fadeIn">
                    <img src="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/img/img-2.png" alt="">
                    <ul>
                        <li>
                            <a href="#"><span class="fa fa-apple"></span> iOS版下载</a>
                        </li>
                        <li>
                            <a href="#"><span class="fa fa-android"></span> Android版下载</a>
                        </li>
                    </ul>
                </div>
                <div class="notice wow fadeIn">
                    <h4>公告 <span class="pull-right">
                        <a href="#">查看更多</a>
                    </span></h4>
                    <ul>
                        <li>
                            <a href="#">
                                <p>2016年艾瑞产品数据修正公告第一版</p>
                                <p>2016-7-12</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <p>2016年艾瑞产品数据修正公告第一版</p>
                                <p>2016-7-12</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <p>2016年艾瑞产品数据修正公告第一版</p>
                                <p>2016-7-12</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <p>2016年艾瑞产品数据修正公告第一版</p>
                                <p>2016-7-12</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <p>2016年艾瑞产品数据修正公告第一版</p>
                                <p>2016-7-12</p>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="contact-us wow fadeIn">
                    <h4>联系我们</h4>
                    <p><span class="fa fa-chevron-right"></span> 客服电话:400-026-2099</p>
                    <!-- <p><span class="fa fa-chevron-right"></span> 企业QQ:88888888</p> -->
                    <p><span class="fa fa-chevron-right"></span> Email:irv@iresearch.com.cn</p>
                    <p>工作时间:周一到周五 9:00-18:00</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <p>
        <a href="#">关于我们</a>
        <a href="#">加入我们</a>
        <a href="#">隐私</a>
        <a href="#">服务条款</a>
        <a href="#">法律条款</a>
    </p>
    <p>
        <span>Copyright© 2002-2016</span>
        <span>艾瑞咨询集团</span>
        <span>上海·北京·广州·东京·硅谷·香港</span>
    </p>
</div>

<!-- Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">登录</h4>
            </div>
            <div class="modal-body" style="padding: 30px;">
                <form role="form" id="userLogin" action="?m=user&a=loginAPI" method="post">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>请输入企业邮箱</label>
                                <input type="email" class="form-control" name="loginAccount" placeholder="注册邮箱">
                            </div>
                            <div class="form-group">
                                <label>请输入密码</label>
                                <input type="password" class="form-control" name="loginPassword" placeholder="登入密码">
                            </div>
                            <p class="text-right"><a href="#">忘记密码？</a></p>
                            <button type="" class="btn btn-primary btn-block mbm">登录</button>
                            <a href="?m=user&a=register" class="btn btn-warning btn-block">注册</a>
                        </div>
                        <div class="col-xs-4 col-xs-offset-1 text-center">
                            <!-- <img  src="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/img/w3cplus-weixin.jpg" class="mtl img-thumbnail" width="200" alt=""> -->
                            <div id="wxLogin"></div>
                            <!--<p class="text-center mtm">已绑定微信扫一扫登录</p> -->
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- 开发环境 -->
<script src="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/js/lib/requirejs/requirejs.js"></script>
<script src="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/js/config.js"></script>
<script type="text/javascript">
    require.config({baseUrl: '<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/js'});
    require([
        'app/indicator',
        'app/swiper',
        'app/wow',
        //'app/validator',
        'app/user/index',
        'app/user/login'
    ]);
</script>
<!-- 生产环境 -->
<!--<script src="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/js/lib/requirejs/requirejs.js"></script>-->
<!--<script src="<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/js/config.js"></script>-->
<!--<script type="text/javascript">-->
<!--require.config({baseUrl: '<?php
echo $_obj['WEBSITE_SOURCE_URL'];
?>
/js'});-->
<!--require(['app/select2','app/slider']);-->
<!--</script>-->
</body>
</html>