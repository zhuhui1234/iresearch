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
            <li class="active">个人资料</li>
        </ol>
        <div class="row">
            <div class="col-xs-8">
                <div class="user-center">
                    <ul class="list-group">
                        <!-- <li class="list-group-item">
                            <span class="fa fa-check text-primary"></span>
                            登录密码
                            <a class="pull-right" href="?m=user&a=changePwd">修改密码 <i class="fa fa-angle-right"></i></a>
                        </li> -->
                        <li class="list-group-item">
                            <!-- IF wechatStatus -->
                            <span class="fa fa-check text-primary"></span>
                            已绑定微信
                            <a class="pull-right" href="#">绑定微信 <i class="fa fa-angle-right"></i></a>
                            <!-- ELSE -->
                            <span class="fa fa-warning text-danger"></span>
                            未绑定微信
                            <a class="pull-right" href="?m=user&a=setSafeWeChat">绑定微信 <i class="fa fa-angle-right"></i></a>
                            <!-- ENDIF -->
                        </li>
                    </ul>
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
        'app/cropper'
    ]);
</script>

</body>
</html>