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
    <link rel="stylesheet" type="text/css" href="./public/css/b_apply/public.css">

    <!-- 引入select样式和js文件 -->
    <link rel="stylesheet" type="text/css" href="./public/css/b_apply/mobileSelect.css">
    <script src="{WEBSITE_SOURCE_URL}/js/app/mobileSelect.min.js" type="text/javascript"></script>
    <script src="{WEBSITE_SOURCE_URL}/js/app/select2.min.js" type="text/javascript"></script>
    <link href="./public/css/b_apply/select2.min.css" rel="stylesheet">
</head>

<body>
<div class="main-image"></div>
<div class="main">
    <div class="alert" style="display: none">
        <img class="alert_img" src="./public/img/bj_login/csicon.png" />
        <div class="alert_txt">必填项不能为空</div>
    </div>
    <div class="row jumbotron login" id="jumbotron">
        <!-- +row-->
        <div class="row" style="margin:0;" id="row1"><img class="row_img" src="./public/img/bj_login/logo1.png"></div>
        <div class="row" id="row2">
            <div class="main_left">
                <form autocomplete="off">
                    <div class="main_left_line_box">
                        <div class="main_left_line">
                            <div class="main_left_line_title">姓名<span class="main_left_line_title_re">*</span></div>
                            <input class="main_left_line_input" placeholder="请输入名字" autocomplete="off" id="name" type="text"/ value="{username}">
                        </div>
                        <div class="main_left_line">
                            <div class="main_left_line_title">手机号<span class="main_left_line_title_re">*</span></div>
                            <input class="main_left_line_input" disabled="disabled" placeholder="填写您的手机号" autocomplete="off" id="phone" type="text" value="{u_mobile}" >
                        </div>
                        <div class="main_left_line">
                            <div class="main_left_line_title">邮箱<span class="main_left_line_title_re">*</span></div>
                            <input class="main_left_line_input" placeholder="请输入邮箱" autocomplete="off" id="mail" type="text"/  value="{u_mail}">
                        </div>
                        <div class="main_left_line">
                            <div class="main_left_line_title">公司<span class="main_left_line_title_re">*</span></div>
                            <input class="main_left_line_input" placeholder="请输入公司" autocomplete="off" id="company" type="text"/ value="{company}">
                        </div>
                        <div class="main_left_line">
                            <div class="main_left_line_title">职位<span class="main_left_line_title_re">*</span></div>
                            <input class="main_left_line_input" placeholder="请输入职位" autocomplete="off" id="job" type="text"/ value="{position}">
                        </div>
                        <div class="main_left_line">
                            <div class="main_left_line_title">行业<span class="main_left_line_title_re">*</span></div>
                            <!--pc的select-->
                            <select class="main_left_line_input main_left_line_select selectPc" autocomplete="off" id="industry">
                                <option value="0" selected="selected">请选择行业(必填)&#x200E</option>
                                <!-- BEGIN industrylist -->
                                <option value='{id}'>{title}</option>
                                <!-- END industrylist -->
                            </select>
                            <!--以下mobileSelect-->
                            <div class="selectMM" id="triggerM1"></div>
                            <script>
                                var weekdayArr1 = {mobile_industry};
                                var mobileSelect1 = new MobileSelect({
                                    trigger: '#triggerM1',
                                    title: '单项选择',
                                    wheels: [{
                                        data: weekdayArr1
                                    }],
                                    position: [0], //初始化定位 打开时默认选中的哪个 如果不填默认为0
                                });
                            </script>
                            <img class="main_left_line_select_icon" src="./public/img/bj_login/jt.png"/>
                        </div>
                        <div class="main_left_line">
                            <div class="main_left_line_title">地区<span class="main_left_line_title_re">*</span></div>
                            <!--pc的select-->
                            <select class="main_left_line_input main_left_line_select selectPc" autocomplete="off" id="city">
                                <option value="0" selected="selected">请选择地区(必填)&#x200E</option>
                                <!-- BEGIN regionList -->
                                <option value='{id}'>{title}</option>
                                <!-- END regionList -->
                            </select>
                            <!--以下mobileSelect-->
                            <div class="selectMM" id="triggerM2"></div>
                            <script>
                                var weekdayArr2 = {mobile_region};
                                var mobileSelect2 = new MobileSelect({
                                    trigger: '#triggerM2',
                                    wheels: [{
                                        data: weekdayArr2
                                    }],
                                    position: [0], //初始化定位 打开时默认选中的哪个 如果不填默认为0
                                });
                            </script>
                            <img class="main_left_line_select_icon" src="./public/img/bj_login/jt.png"/>
                        </div>
                        <div class="main_left_line">
                            <div class="main_left_line_title">验证码<span class="main_left_line_title_re">*</span></div>
                            <div class="main_left_line_input_yzm">
                                <input class="main_left_line_input yzmInput" autocomplete="off" placeholder="请输入验证码" id="code" type="text"/>
                                <img id="charCode" class="yzmInput_img" src="?m=service&a=charCode"/>
                            </div>
                        </div>
                        <div class="main_left_button" id="applyToTrial">提交申请</div>
                    </div>
                </form>
            </div>

            <div class="main_right">
                <img src="{productLogoUrl}" class="main_right_img"/>
                <div class="main_right_txt">
                    {productIntroduce}
                </div>
                <div class="main_right_shebei">
                    
                    

                    <div class="main_right_shebei_tab" style="display: {mobile};">
                        <img  class="main_right_shebei_tab_img" src="./public/img/bj_login/Group 45 Copy@3x.png"/>
                        <div class="main_right_shebei_tab_txt">移动终端</div>
                    </div>
                    <div class="main_right_shebei_tab" style="display: {pc};">
                        <img  class="main_right_shebei_tab_img" src="./public/img/bj_login/Group 100 Copy@3x.png"/>
                        <div class="main_right_shebei_tab_txt">PC终端</div>
                    </div>
                    <div class="main_right_shebei_tab" style="display: {ott};">
                        <img  class="main_right_shebei_tab_img" src="./public/img/bj_login/Group 4 Copy 2@3x.png" style="margin-left: 18px;"/>
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
</body>

</html>