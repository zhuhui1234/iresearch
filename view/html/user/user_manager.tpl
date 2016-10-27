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
            <li class="active">用户管理</li>
        </ol>
        <div class="manage-menu">
            <form class="form-inline" role="form">
                <div class="input-group">
                    <select class="form-control" data-toggle="select">
                        <option value="0" selected>全部用户</option>
                        <option value="1">高级用户</option>
                        <option value="2">普通用户</option>
                        <option value="3">已冻结用户</option>
                    </select>
                </div>
                <button type="button" class="btn btn-primary pull-right">预设权限用户</button>
            </form>
        </div>
        <div class="user-table">
            <table class="table table-hover" id="user-manger-tb">
                <thead>
                <tr>
                    <th>用户名</th>
                    <th>邮箱</th>
                    <th>职位</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- 开发环境 -->
<script src="{WEBSITE_SOURCE_URL}/js/lib/requirejs/requirejs.js"></script>
<script src="{WEBSITE_SOURCE_URL}/js/config.js"></script>
<script type="text/javascript">
    require.config({baseUrl: '{WEBSITE_SOURCE_URL}/js'});
    require([
        'app/user/usermanger'
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