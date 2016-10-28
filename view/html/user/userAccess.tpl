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
            <li><a href="?m=user&a=usermanger">用户管理</a></li>
            <li class="active">用户详情</li>
        </ol>
        <div class="manage-menu">
            <div class="row user-info">
                <!-- BEGIN getUser -->
                <div class="col-xs-6">
                    <img src="{u_head}" alt="">
                    <span>

                        <h4>{u_name}</h4>
                        <p>{u_account}</p>
                        <p>{u_department}/{u_position}</p>

                    </span>
                </div>
                <div class="col-xs-4">
                    注册时间：{u_cdate}
                </div>
                <div class="col-xs-2">
                    <button type="button" class="btn btn-primary setStatus" u_state="{u_state}">冻结用户</button>
                </div>
                <!-- END getUser -->
            </div>
        </div>
        <h5 class="mtl">权限设置</h5>
        <div class="manage-menu">
            <form class="form-inline" role="form">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" checked value="" data-toggle="checkbox">
                        全部
                    </label>
                </div>
                <div class="input-group pull-right">
                    <select class="form-control" data-toggle="select">
                        <option value="0" selected>全部小行业</option>
                        <option value="1">高级用户</option>
                        <option value="2">普通用户</option>
                        <option value="3">已冻结用户</option>
                    </select>
                </div>
                <div class="input-group pull-right">
                    <select class="form-control" data-toggle="select">
                        <option value="0" selected>全部大行业</option>
                        <option value="1">网络应用数据</option>
                        <option value="2">普通用户</option>
                        <option value="3">已冻结用户</option>
                    </select>
                </div>
                <div class="input-group pull-right">
                    <select class="form-control" data-toggle="select">
                        <option value="0" selected>全部状态</option>
                        <option value="1">有权限</option>
                        <option value="2">无权限</option>
                        <option value="3">隐藏</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="panel panel-default ass-set">
            <div class="panel-heading">
                <b>控股公司资产排名趋势</b>
                <span class="pull-right fa fa-angle-down"></span>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                    <tr>
                        <td></td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="" data-toggle="checkbox">
                                    全部权限
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="" data-toggle="checkbox">
                                    全部隐藏
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>PC网站公司资产排名趋势</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="" data-toggle="checkbox">
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="" data-toggle="checkbox">
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>PC网站公司资产排名趋势</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="" data-toggle="checkbox">
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="" data-toggle="checkbox">
                                </label>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-default ass-set">
            <div class="panel-heading">
                <b>控股公司资产排名趋势</b>
                <span class="pull-right fa fa-angle-down"></span>
            </div>
            <div class="panel-body">
                <table class="table user-allocated">
                    <tbody>
                    <tr>
                        <td></td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="" data-toggle="checkbox" id="checkAll">
                                    全部权限
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="" data-toggle="checkbox">
                                    全部隐藏
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>PC网站公司资产排名趋势</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="" data-toggle="checkbox" name="checkList">
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="" data-toggle="checkbox">
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>PC网站公司资产排名趋势</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="" data-toggle="checkbox" name="checkList">
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="" data-toggle="checkbox">
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>PC网站公司资产排名趋势</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="" data-toggle="checkbox" name="checkList">
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="" data-toggle="checkbox">
                                </label>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
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
        'app/user/useraccess'
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