<!-- INCLUDE ../header.tpl -->

<div class="wrap">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="active">完善个人资料</li>
        </ol>
        <div class="row">
            <div class="col-xs-6 col-xs-offset-2">
                <div class="user-center">
                    <div class="form-group">
                        <div class="col-xs-offset-3 col-xs-9">
                            <div id="crop-avatar">
                                <!-- Current avatar -->
                                <div class="avatar-view mbl" title="点击上传头像">
                                    <img src="{WEBSITE_SOURCE_URL}/img/user-head.png" class="center-block user-head-img" alt="Avatar">
                                </div>
                                <!-- Cropping modal -->
                                <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form class="avatar-form" action="?m=service&a=cropavatar" enctype="multipart/form-data" method="post">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title" id="avatar-modal-label">上传头像</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="avatar-body">
                                                        <!-- Upload image and data -->
                                                        <div class="avatar-upload">
                                                            <input type="hidden" class="avatar-src" name="avatar_src">
                                                            <input type="hidden" class="avatar-data" name="avatar_data">
                                                            <input type="file" class="avatar-input" id="avatarInput" name="avatar_file" multiple="multiple" data-badge="false">
                                                        </div>
                                                        <!-- Crop and preview -->
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <div class="avatar-wrapper"></div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="avatar-preview preview-lg"></div>
                                                                <div class="avatar-preview preview-md"></div>
                                                                <div class="avatar-preview preview-sm"></div>
                                                            </div>
                                                        </div>

                                                        <div class="row avatar-btns">
                                                            <div class="col-md-9">
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-default" data-method="rotate" data-option="-90">
                                                                        <i class="fa fa-rotate-left"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-default" data-method="rotate" data-option="90">
                                                                        <i class="fa fa-rotate-right"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <button type="submit" class="btn btn-primary btn-block avatar-save">保存</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div><!-- /.modal -->
                                <!-- Loading state -->
                                <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
                            </div>
                        </div>
                    </div>
                    <form id="registerUserInfo" name="registerUserInfo" class="form-horizontal" action="?m=user&a=registerUserInfoAPI&mailto={mailto}&mailkey={mailkey}" method="post">
                        <div class="form-group">
                            <div class="col-xs-offset-3 col-xs-9">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">姓名:</label>
                            <div class="col-xs-9">
                                <input name="u_name" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">密码:</label>
                            <div class="col-xs-9">
                                <input name="u_password" type="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">部门:</label>
                            <div class="col-xs-9">
                                <input name="u_department" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">职位:</label>
                            <div class="col-xs-9">
                                <input name="u_position" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">联系电话:</label>
                            <div class="col-xs-9">
                                <input name="u_mobile" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div style="display: none">
                            <input type="text" value="{mailto}" name="u_account" disabled="disabled" >
                            <input type="text" value="{mailkey}" name="mailkey" disabled="disabled" >
                        </div>

                        <div class="form-group">
                            <div class="col-xs-offset-3 col-xs-9">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <button type="submit" class="btn btn-primary btn-block">保存</button>
                                    </div>
                                    <div class="col-xs-6">
                                        <a href="?m=index" class="btn btn-default btn-block">取消</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">登录</h4>
            </div>
            <div class="modal-body" style="padding: 30px;">
                <form role="form" id="index-login">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>请输入企业邮箱</label>
                                <input type="email" class="form-control" name="email" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>请输入密码</label>
                                <input type="password" class="form-control" name="password" placeholder="">
                            </div>
                            <p class="text-right"><a href="#">忘记密码？</a></p>
                            <button type="submit" class="btn btn-primary btn-block mbm">登录</button>
                            <a href="?m=user&a=register" class="btn btn-warning btn-block">注册</a>
                        </div>
                        <div class="col-xs-4 col-xs-offset-1 text-center">
                            <!-- <img  src="{WEBSITE_SOURCE_URL}/img/w3cplus-weixin.jpg" class="mtl img-thumbnail" width="200" alt=""> -->
                            <div id="wxLogin"></div>
                            <!--<p class="text-center mtm">已绑定微信扫一扫登录</p> -->
                        </div>
                    </div>

                </form>
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
        'app/cropper',
        'app/user/register'
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