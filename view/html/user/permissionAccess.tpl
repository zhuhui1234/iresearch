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
        <img src="{WEBSITE_SOURCE_URL}/img/herry.png" alt="" class="img-circle img-responsive">
        <p>Herry</p>
        <span class="btn btn-warning btn-xs">管理员</span>
    </div>
    <!-- INCLUDE sidebar.tpl -->
</div>

<div class="wrap active">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="active">权限分配管理</li>
        </ol>
        <div class="row">
            <div class="col-xs-4">
                <div class="allocated_left">
                    <div class="input-group mbm">
                        <select class="form-control" data-toggle="select" id="bigIndustry">
                            <!-- BEGIN bigIndustry -->
                            <option value="{ity_id}">{ity_name}</option>
                            <!-- END bigIndustry -->
                        </select>
                    </div>
                    <div class="input-group mbm">
                        <select class="form-control" data-toggle="select" id="smallIndustry">
                            <!-- BEGIN smallIndustry -->
                            <option value="{ity_id}">{ity_name}</option>
                            <!-- END smallIndustry -->
                        </select>
                    </div>
                    <div id="treeview" class=""></div>
                </div>
            </div>
            <div class="col-xs-8">
                <h5 class="mtl">权限设置</h5>
                <div class="manage-menu">
                    <form class="form-inline" role="form">
                        <div class="radio">
                            <label>
                                <input type="radio" name="radio1" checked value="" data-toggle="radio">
                                全有权限
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="radio1" value="" data-toggle="radio">
                                全无权限
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="radio1" value="" data-toggle="radio">
                                全隐藏
                            </label>
                        </div>
                        <div class="manage-menu-span">
                            <span>预设权限数: 10个</span>
                            <span>已有权限： 5个</span>
                            <span>剩余权限：5个</span>
                        </div>
                    </form>
                </div>
                <div class="manage-menu user-list">
                    <h5>用户列表</h5>
                    <div class="pull-right">
                        <select class="form-control" data-toggle="select">
                            <option value="0" selected>二级选项</option>
                            <option value="1">高级用户</option>
                            <option value="2">普通用户</option>
                            <option value="3">已冻结用户</option>
                        </select>
                    </div>
                </div>
                <div class="user-table">
                    <table class="table table-hover" id="user-table">
                        <thead>
                        <tr>
                            <th>用户名</th>
                            <th>有权限</th>
                            <th>无权限</th>
                            <th>隐藏</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>herry@iresearch.com.cn</td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>herry@iresearch.com.cn</td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>herry@iresearch.com.cn</td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>herry@iresearch.com.cn</td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>herry@iresearch.com.cn</td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>herry@iresearch.com.cn</td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>herry@iresearch.com.cn</td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>herry@iresearch.com.cn</td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>herry@iresearch.com.cn</td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>herry@iresearch.com.cn</td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="radio1" value="" data-toggle="checkbox">
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
</div>
<!-- 开发环境 -->
<script src="{WEBSITE_SOURCE_URL}/js/lib/requirejs/requirejs.js"></script>
<script src="{WEBSITE_SOURCE_URL}/js/config.js"></script>
<script type="text/javascript">
    require.config({baseUrl: '{WEBSITE_SOURCE_URL}/js'});
    require([
        'app/user/permissionAccess',
        'app/user/permissionAccess_tree'
    ]);
</script>
</body>
</html>