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
    <div class="trial_wrap">
        <h4>艾瑞睿见 - 申请试用</h4>
        <form role="form">
            <div class="input-group">
                <span class="input-group-addon">公司名称</span>
                <input type="text" id="company" class="form-control" placeholder="填写您所在公司全称">
                <p class="text-danger"></p>
                <span class="tip">*必填</span>
            </div>
            <div class="input-group">
                <span class="input-group-addon">姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名</span>
                <input type="text" id="name" class="form-control" placeholder="填写您的真实姓名">
                <p class="text-danger"></p>
                <span class="tip">*必填</span>
            </div>
            <div class="input-group">
                <span class="input-group-addon">公司职位</span>
                <input type="text" id="title" class="form-control" placeholder="填写您目前的职位名称">
                <p class="text-danger"></p>
                <span class="tip">*必填</span>
            </div>
            <div class="input-group">
                <span class="input-group-addon">手机号码</span>
                <input type="text" id="mobile" class="form-control" placeholder="填写您的手机号码">
                <p class="text-danger"></p>
                <span class="tip">*必填</span>
            </div>
            <div class="input-group">
                <span class="input-group-addon">企业邮箱</span>
                <input type="text" id="email" class="form-control" placeholder="此邮箱将绑定您的账号，请认真填写">
                <p class="text-danger"></p>
                <span class="tip">*必填</span>
            </div>
        </form>
        <div class="panel panel-default">
            <div class="panel-heading">申请试用内容</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="媒介计划1" data-toggle="checkbox">
                                媒介计划
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="媒介计划2" data-toggle="checkbox">
                                媒介计划
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="媒介计划3" data-toggle="checkbox">
                                媒介计划
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="媒介计划4" data-toggle="checkbox">
                                媒介计划
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="媒介计划5" data-toggle="checkbox">
                                媒介计划
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="媒介计划6" data-toggle="checkbox">
                                媒介计划
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p class="text-danger text-center"></p>
        <button type="submit" class="btn btn-block btn-primary btn-lg">提交申请</button>
        <p class="text-center mtm text-muted">如有账号问题请拨打***********</p>
    </div>
</div>

<!-- INCLUDE ../foot.tpl -->

<!-- 开发环境 -->
<script src="{WEBSITE_SOURCE_URL}/js/lib/requirejs/requirejs.js"></script>
<script src="{WEBSITE_SOURCE_URL}/js/config.js"></script>
<script type="text/javascript">
    require.config({baseUrl: '{WEBSITE_SOURCE_URL}/js'});
    require([
        'app/home/intermediary'
    ]);
</script>
<!-- 生产环境 -->
<!--<script src="{WEBSITE_SOURCE_URL}/js/lib/requirejs/requirejs.js"></script>-->
<!--<script src="{WEBSITE_SOURCE_URL}/js/config.js"></script>-->
<!--<script type="text/javascript">-->
<!--require.config({baseUrl: '{WEBSITE_SOURCE_URL}/js'});-->
<!--require(['app/select2','app/slider']);-->
<!--</script>-->
</body>
</html>