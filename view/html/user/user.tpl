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
    <link href="./public/css/app.min.css" rel="stylesheet">
    <!-- 自定义 -->
    <link href="./public/css/docs.min.css" rel="stylesheet">
</head>
<body>
<!-- INCLUDE ../nav.tpl -->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> 个人中心首页</a></li>
        <li class="active">账户设置</li>
    </ol>
    <div class="user-center">
        <div class="user-left">
            <div class="user-header">
                <!-- IF headImg = "upload/head/" -->
                <img class="userAvatar" src="{avatar}" alt="">
                <!-- ELSE -->
                <img class="userAvatar" src="./public/img/head_default.png" alt="">
                <!-- ENDIF -->
                <p class="mts">

                    <span class="label label-warning">
                        <!-- IF permissions="1" -->
                        管理员
                        <!-- ELSE -->
                        游客
                        <!-- ENDIF -->
                    </span>
                </p>
                <h4>{username}</h4>
                <p class="user-time">
                    <i class="iconfont icon-clock"></i>
                    <span>{expireDate}到期</span>
                </p>
            </div>
            <!-- INCLUDE ./sidebar.tpl -->
        </div>
        <div class="user-right">
            <h5><i class="iconfont icon-user"></i> 基本信息</h5>
            <div class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-sm-2 control-label"><br>头像</label>
                    <div class="col-sm-10">
                        <div id="crop-avatar">
                            <!-- Current avatar -->
                            <div class="avatar-view" title="更改头像">
                                <!-- IF avatar = "upload/head/" -->
                                <img src="./public/img/head_default.png" alt="Avatar" width="200">
                                <!-- ELSE -->
                                <img src="{avatar}" alt="Avatar" width="200">
                                <!-- ENDIF -->

                            </div>
                            <!-- Cropping modal -->
                            <div class="modal fade" id="avatar-modal" aria-hidden="true"
                                 aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form class="avatar-form" action="?m=service&a=cropavatar"
                                              enctype="multipart/form-data" method="post">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                <h5 class="modal-title" id="avatar-modal-label">更换头像</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="avatar-body">

                                                    <!-- Upload image and data -->
                                                    <div class="avatar-upload">
                                                        <input type="hidden" class="avatar-src" name="avatar_src">
                                                        <input type="hidden" class="avatar-data" name="avatar_data">
                                                        <input type="file" class="avatar-input" id="avatarInput"
                                                               name="avatar_file" multiple="multiple">
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
                                                                <button type="button" class="btn btn-default"
                                                                        data-method="rotate" data-option="-90"
                                                                        title="Rotate -90 degrees">向左旋转
                                                                </button>
                                                                <button type="button" class="btn btn-default"
                                                                        data-method="rotate" data-option="-15">-15度
                                                                </button>
                                                                <button type="button" class="btn btn-default"
                                                                        data-method="rotate" data-option="-30">-30度
                                                                </button>
                                                                <button type="button" class="btn btn-default"
                                                                        data-method="rotate" data-option="-45">-45度
                                                                </button>
                                                            </div>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-default"
                                                                        data-method="rotate" data-option="90"
                                                                        title="Rotate 90 degrees">向右旋转
                                                                </button>
                                                                <button type="button" class="btn btn-default"
                                                                        data-method="rotate" data-option="15">15度
                                                                </button>
                                                                <button type="button" class="btn btn-default"
                                                                        data-method="rotate" data-option="30">30度
                                                                </button>
                                                                <button type="button" class="btn btn-default"
                                                                        data-method="rotate" data-option="45">45度
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <button type="submit"
                                                                    class="btn btn-primary btn-block avatar-save">保存
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- /.modal -->

                            <!-- Loading state -->
                            <div class="loading" aria-label="Loading" role="img" tabindex="-1">
                                <i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">所属公司</label>
                    <div class="col-sm-6">
                        <label class="control-label">
                            {company}
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">个人姓名</label>
                    <div class="col-sm-6">
                        <input id="username" type="text" class="form-control" value="{uname}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">公司职位</label>
                    <div class="col-sm-6">
                        <input id="position" type="text" class="form-control" value="{position}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-2">
                        <button id="saveMyInfo" class="btn btn-primary btn-block">保存</button>
                    </div>
                </div>
                <!--<div class="form-group">-->
                <!--<label class="col-sm-2 control-label">企业邮箱</label>-->
                <!--<div class="col-sm-6">-->
                <!--<label class="control-label">-->
                <!--<a href="#">未设置</a>-->
                <!--</label>-->
                <!--</div>-->
                <!--<div class="col-sm-4 text-right">-->
                <!--<button class="btn btn-primary">确认</button>-->
                <!--</div>-->
                <!--</div>-->
            </div>
            <hr>
            <h5><i class="iconfont icon-suo"></i> 绑定设置</h5>
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-sm-2 control-label">手机号码</label>
                    <div class="col-sm-6">
                        <label class="control-label">
                            {mobile}
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">企业邮箱</label>
                    <div class="col-sm-6">
                        <label class="control-label">
                            <!-- IF companyEmail="" -->
                            无
                            <!-- ELSE -->
                            {companyEmail}
                            <!-- ENDIF -->
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">微信号</label>
                    <div class="col-sm-6">
                        <label class="control-label text-danger">
                            <!-- IF wechat="1" -->
                            已绑定 / {weChatNickName}
                            <!-- ELSE -->
                            未绑定
                            <!-- ENDIF -->
                        </label>
                    </div>
                    <div class="col-sm-4 text-right">
                        <label class="control-label">
                            <!-- IF wechat="" -->
                            <!-- ELSE -->
                            <a href="#" data-toggle="modal" data-target="#code">快速设置</a>
                            <!-- ENDIF -->
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--<footer class="inner-footer">-->
<!--<div class="container">-->
<!--<p class="cpr">2002 - 2016 Copyright© 艾瑞数据  31010402000584104020104020</p>-->
<!--</div>-->
<!--</footer>-->
<!-- 二维码 -->
<div class="modal fade" id="code" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h5 class="modal-title" id="myModalLabel">微信二维码</h5>
            </div>
            <div class="modal-body">
                <div id="bindingWeChat"></div>
            </div>
            <div class="modal-footer">
                <p class="text-center">微信扫描二维码完成绑定</p>
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
        'app/user/user',
        'app/home/index'
    ]);
</script>
<!-- 生产环境 -->
<!--<script src="../public/js/lib/requirejs/requirejs.js"></script>-->
<!--<script src="../public/js/config.js"></script>-->
<!--<script type="text/javascript">-->
<!--require.config({baseUrl: '../public/js'});-->
<!--require([-->
<!--'app/swiper',-->
<!--'app/wow'-->
<!--]);-->
<!--</script>-->
</body>
</html>