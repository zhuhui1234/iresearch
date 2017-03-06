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
    <style>
        {
            overflow-y:hidden
        }
    </style>
</head>
<!-- INCLUDE ../nav.tpl -->


<iframe id="mut_iFrame" style="width: 100%;height: 1525px" src="http://irv.iresearch.com.cn/iReport/?m=service&a=showReport&guid=8BDCF4C1-E2AB-FA26-4DE8-DA382156B670" ></iframe>
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