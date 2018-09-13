<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="//data.iresearch.com.cn/images/favicon.ico" mce_href="//data.iresearch.com.cn/images/favicon.ico" type="image/x-icon">

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



<iframe id="mut_iFrame" style="width: 100%;" src="/MUTmedia/?m=index&a=intermediaryPlan&token={token}&guid={userID}" ></iframe>
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