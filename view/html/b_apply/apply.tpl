<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>申请试用</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <!-- IE 兼容模式 -->
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=9;IE=EDGE">
    <!-- 国产浏览器高速模式 -->
    <meta name="renderer" content="webkit">
    <!-- bootstrap核心样式 -->
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link href="./public/css/b_apply/index.css" rel="stylesheet">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="http://data.iresearch.com.cn/js/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
</head>

<body>
<div class="main-image"></div>
<div class="main">
    <div class="row jumbotron login" id="jumbotron">
        <!-- +row-->
        <div class="row" style="margin:0;" id="row1"><img class="row_img" src="./public/img/bj_login/logo1.png"></div>
        <div class="row" id="row2">
            <div class="main_left">
                <form autocomplete="off">
                    <div class="main_left_line_box">
                        <div class="main_left_line">
                            <div class="main_left_line_title">姓名<span class="main_left_line_title_re">*</span></div>
                            <input class="main_left_line_input" placeholder="填写您的姓名" autocomplete="off" id="name" type="text"/>
                        </div>
                        <div class="main_left_line">
                            <div class="main_left_line_title">手机号<span class="main_left_line_title_re">*</span></div>
                            <input class="main_left_line_input" placeholder="填写您的手机号" autocomplete="off" id="phone" type="text"/>
                        </div>
                        <div class="main_left_line">
                            <div class="main_left_line_title">邮箱<span class="main_left_line_title_re">*</span></div>
                            <input class="main_left_line_input" placeholder="填写您的邮箱地址" autocomplete="off" id="mail" type="text"/>
                        </div>
                        <div class="main_left_line">
                            <div class="main_left_line_title">职位<span class="main_left_line_title_re">*</span></div>
                            <input class="main_left_line_input" placeholder="填写您所在的公司" autocomplete="off" id="job" type="text"/>
                        </div>
                        <div class="main_left_line">
                            <div class="main_left_line_title">行业<span class="main_left_line_title_re">*</span></div>
                            <select class="main_left_line_input main_left_line_select" autocomplete="off" id="industry">
                                <option></option>
                                <option>报纸</option>
                                <option>电视台</option>
                                <option>杂志</option>
                            </select>
                            <img class="main_left_line_select_icon" src="./public/img/bj_login/jt.png"/>
                        </div>
                        <div class="main_left_line">
                            <div class="main_left_line_title">地区<span class="main_left_line_title_re">*</span></div>
                            <select class="main_left_line_input main_left_line_select" autocomplete="off" id="city">
                                <option></option>
                                <option>北京市</option>
                                <option>上海市</option>
                                <option>天津市</option>
                            </select>
                            <img class="main_left_line_select_icon" src="./public/img/bj_login/jt.png"/>
                        </div>
                        <div class="main_left_line">
                            <div class="main_left_line_title">验证码</div>
                            <div class="main_left_line_input_yzm">
                                <input class="main_left_line_input yzmInput" autocomplete="off" placeholder="请输入验证码" id="code" type="text"/>
                                <img class="yzmInput_img" src="img/yzm.jpg"/>
                            </div>
                        </div>
                        <div class="main_left_button">提交申请</div>
                    </div>
                </form>
            </div>

            <div class="main_right">
                <img src="./public/img/bj_login/right_logo.png" class="main_right_img"/>
                <div class="main_right_txt">
                    UserTracker为艾瑞自主研发的网民网络行为监测系统。包含Mobile、PC两端网民网络行为监测数据。自2007年开始，基于亿级PC及移动样本行为数据采集，获取中国网民网站浏览、软件使用、APP打开等行为数据，并通过海量数据分析建立了多个用户行为指标，真实反映PC及移动互联网市场客观情况
                </div>
                <div class="main_right_shebei">
                    <div class="main_right_shebei_tab" style="">
                        <img  class="main_right_shebei_tab_img" src="./public/img/bj_login/Group 45 Copy@3x.png"/>
                        <div class="main_right_shebei_tab_txt">移动终端</div>
                    </div>
                    <div class="main_right_shebei_tab">
                        <img  class="main_right_shebei_tab_img" src="./public/img/bj_login/Group 100 Copy@3x.png"/>
                        <div class="main_right_shebei_tab_txt">PC终端</div>
                    </div>
                    <div class="main_right_shebei_tab">
                        <img  class="main_right_shebei_tab_img" src="./public/img/bj_login/Group 4 Copy 2@3x.png"/>
                        <div class="main_right_shebei_tab_txt">OTT终端</div>
                    </div>
                </div>
                <div class="main_right_ewm">
                    <div class="main_right_ewm_left">
                        <img  class="main_right_ewm_left_img" src="./public/img/bj_login/Group 7@3x.png"/>
                        <div class="main_right_ewm_txt">艾瑞研究院APP</div>
                    </div>
                    <div class="main_right_ewm_left">
                        <img  class="main_right_ewm_left_img" src="./public/img/bj_login/Bitmap@3x.png"/>
                        <div class="main_right_ewm_txt">微信扫一扫使用小程序</div>
                    </div>
                </div>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>
</div>
<script src="{WEBSITE_SOURCE_URL}/js/lib/requirejs/requirejs.js"></script>
<script src="{WEBSITE_SOURCE_URL}/js/config.js"></script>
<script type="text/javascript">
    require.config({baseUrl: '{WEBSITE_SOURCE_URL}/js'});
    require([
        'app/home/trail_bj'
    ]);
</script>
<script src="//irv.iresearch.com.cn/iResearchDataWeb/dev/js/header.js"></script>
</body>

</html>