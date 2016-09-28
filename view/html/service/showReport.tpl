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
    <h4>{ity_name}</h4>
    <ul>
        <!-- BEGIN listInfo -->
        <li class=" <!-- IF cfg_name = top.default.pname -->open<!-- ENDIF --> <!-- IF ConfigMinList = "" -->_showReport<!-- ELSE -->submenu<!-- ENDIF -->"  cfg_url="{cfg_url}" cfg_name="{cfg_name}"><a href="#">{cfg_name}</a>
            <ul <!-- IF cfg_name = top.default.pname -->style="display: block"<!-- ENDIF -->>
                <!-- BEGIN ConfigMinList -->
                <li><a href="#" class="_showReport" cfg_url="{cfg_url}" cfg_name="{cfg_name}"><i class="fa fa-angle-right"></i>{cfg_name}</a></li>
                <!-- END ConfigMinList -->
            </ul>
        </li>
        <!-- END listInfo -->
    </ul>
</div>
<div class="wrap active">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="#">{pname}</a></li>
            <li><a href="#">{ity_name}</a></li>
            <!-- IF level = 4 -->
            <li><a href="#" class="_nowReportPname">{default.pname}</a></li>
            <!-- ENDIF -->
            <li class="active _nowReport" >{default.name}</li>
            <!--<a href="#" class="btn btn-outline btn-primary pull-right">下载研究方案说明文档</a>-->
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
    require.config({
        baseUrl: '{WEBSITE_SOURCE_URL}/js'
    });
    require([
        'app/service/showReport'
    ]);
</script>
</body>
</html>