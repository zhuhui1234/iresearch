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
            <li class="active">申请管理</li>
        </ol>
        <div class="user-table">
            <table class="table table-hover" id="user-table">
                <thead>
                <tr>
                    <th>申请账号</th>
                    <th>姓名</th>
                    <th>手机号码</th>
                    <th>申请途经/内容</th>
                    <th>申请时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>herry@iresearch.com.cn</td>
                    <td>vivi</td>
                    <td>18666666666</td>
                    <td>PC网站应用资产排名分析</td>
                    <td>2016/5/5 12:22</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-xs mrm">通过</button>
                        <button type="button" class="btn btn-warning btn-xs">拒绝</button>
                    </td>
                </tr>
                <tr>
                    <td>herry@iresearch.com.cn</td>
                    <td>vivi</td>
                    <td>18666666666</td>
                    <td>PC网站应用资产排名分析</td>
                    <td>2016/5/5 12:22</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-xs mrm">通过</button>
                        <button type="button" class="btn btn-warning btn-xs">拒绝</button>
                    </td>
                </tr>
                <tr>
                    <td>herry@iresearch.com.cn</td>
                    <td>vivi</td>
                    <td>18666666666</td>
                    <td>PC网站应用资产排名分析</td>
                    <td>2016/5/5 12:22</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-xs mrm">通过</button>
                        <button type="button" class="btn btn-warning btn-xs">拒绝</button>
                    </td>
                </tr>
                <tr>
                    <td>herry@iresearch.com.cn</td>
                    <td>vivi</td>
                    <td>18666666666</td>
                    <td>PC网站应用资产排名分析</td>
                    <td>2016/5/5 12:22</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-xs mrm">通过</button>
                        <button type="button" class="btn btn-warning btn-xs">拒绝</button>
                    </td>
                </tr>
                <tr>
                    <td>herry@iresearch.com.cn</td>
                    <td>vivi</td>
                    <td>18666666666</td>
                    <td>PC网站应用资产排名分析</td>
                    <td>2016/5/5 12:22</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-xs mrm">通过</button>
                        <button type="button" class="btn btn-warning btn-xs">拒绝</button>
                    </td>
                </tr>
                <tr>
                    <td>herry@iresearch.com.cn</td>
                    <td>vivi</td>
                    <td>18666666666</td>
                    <td>PC网站应用资产排名分析</td>
                    <td>2016/5/5 12:22</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-xs mrm">通过</button>
                        <button type="button" class="btn btn-warning btn-xs">拒绝</button>
                    </td>
                </tr>
                <tr>
                    <td>herry@iresearch.com.cn</td>
                    <td>vivi</td>
                    <td>18666666666</td>
                    <td>PC网站应用资产排名分析</td>
                    <td>2016/5/5 12:22</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-xs mrm">通过</button>
                        <button type="button" class="btn btn-warning btn-xs">拒绝</button>
                    </td>
                </tr>
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
        'app/user_apply'
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