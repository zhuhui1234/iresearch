<!-- INCLUDE ../header.tpl -->
<style>
    html { overflow: hidden; }
</style>
<div class="left-menu">
    <a href="#" class="active">
        <i></i>
        <i></i>
        <i></i>
    </a>
</div>
<div class="sidebar show">
    <h4>{pname}</h4>
    <ul>
        <li class="submenu open"><a href="#">{ity_name}</a>
            <ul style="display: block">
                <!-- BEGIN listInfo -->
                <li><a href="#" class="_showReport" cfg_url="{cfg_url}"><i class="fa fa-angle-right"></i>{cfg_name}</a></li>
                <!-- END listInfo -->
            </ul>
        </li>
        <li class="submenu"><a href="#">控股公司资产排名</a>
            <ul>
                <li><a href="#"><i class="fa fa-angle-right"></i> PC网站公司资产排名趋势</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i> 移动端安卓系统公司资产排名趋势</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i> 移动端IOS系统公司资产排名趋势</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i> 控股公司资产构成信息</a></li>
            </ul>
        </li>
    </ul>
</div>
<div class="wrap active">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="#">{pname}</a></li>
            <li><a href="#">{ity_name}</a></li>
            <li class="active">{default.name}</li>
            <a href="#" class="btn btn-outline btn-primary pull-right">下载研究方案说明文档</a>
        </ol>
        <div>
            <div class="loading-report" style="text-align: center; vertical-align: middle; margin-top: 10%">
                <i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>
            </div>
            <div class="show-report">
            <iframe id="frameReport" scrolling="no" width="100%" frameborder="0" default="{default.url}"></iframe>
            <div>
        </div>
    </div>
</div>
<!-- 开发环境 -->
<script src="{WEBSITE_SOURCE_URL}/js/lib/requirejs/requirejs.js"></script>
<script src="{WEBSITE_SOURCE_URL}/js/config.js"></script>
<script type="text/javascript">
    require.config({baseUrl: '{WEBSITE_SOURCE_URL}/js'});
    require([
        'app/service/showReport'
    ]);
</script>
<!-- 生产环境 -->
<!--<script src="../public/js/lib/requirejs/requirejs.js"></script>-->
<!--<script src="../public/js/config.js"></script>-->
<!--<script type="text/javascript">-->
<!--require.config({baseUrl: '../public/js'});-->
<!--require(['app/select2','app/slider']);-->
<!--</script>-->
</body>
</html>