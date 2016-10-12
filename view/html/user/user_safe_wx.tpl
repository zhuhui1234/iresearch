
<!-- INCLUDE ../header.tpl -->
<div class="left-menu">
    <a href="#" class="active">
        <i></i>
        <i></i>
        <i></i>
    </a>
</div>
<div class="sidebar show">
    <div class="user-info">
        <img src="{u_head}" alt="" class="img-circle img-responsive">
        <p>{u_name}</p>
        <span class="btn btn-warning btn-xs">管理员</span>
    </div>
    <!-- INCLUDE sidebar.tpl -->
</div>

<div class="wrap active">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="?m=user&a=setSafe">安全设置</a></li>
            <li class="active">绑定微信</li>
        </ol>
        <div class="row">
            <div class="col-xs-6">
                <div class="user-center">
                    <div class="bind-wx">
                        <h4>扫一扫绑定微信</h4>
                        <!-- <img src="{WEBSITE_SOURCE_URL}/img/w3cplus-weixin.jpg" alt="">
                        <p><span class="fa fa-refresh"></span> 刷新</p> -->
                        <div id="bindWeChat"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 开发环境 -->
<script src="{WEBSITE_SOURCE_URL}/js/lib/requirejs/requirejs.js"></script>
<script src="{WEBSITE_SOURCE_URL}/js/config.js"></script>
<script type="text/javascript">
    require.config({baseUrl: '{WEBSITE_SOURCE_URL}/js'});
    require([
        'app/user/safewx'
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