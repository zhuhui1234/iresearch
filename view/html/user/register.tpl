<!-- INCLUDE ../header.tpl -->
<div class="wrap">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="active">注册账户</li>
        </ol>
        <div class="row">
            <div class="col-xs-4 col-xs-offset-2">
                <div class="user-center">
                    <form data-toggle="validator" role="form" id="registerMail" action="?m=user&a=registerSendMail" method="post">
                        <div class="form-group">
                            <label>请输入企业邮箱</label>
                            <input name="registerMail" type="email" class="form-control" id="inputEmail" placeholder="Email" data-error="请输入正确的邮箱格式" required>
                        </div>
                        <div class="form-group">
                            <label>请输入验证码</label>
                            <input type="text" class="form-control" name="vcode" id="vcode" required>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-2 col-xs-offset-0">
                                    <img src="?m=service&a=authImg" alt="">
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="registerMail" class="btn btn-block btn-primary">注册账户</button>
                    </form>
                </div>
            </div>
            <div class="col-xs-4 col-xs-offset-1">
                <div class="user-center">
                    <address>
                        <strong>联系客服</strong><br><br>
                        <p>邮箱：irv@iresearch.com.cn</p>
                        <p>电话：400-026-2099</p>
                        <p>地址：上海市漕溪北路333号B座701</p>
                    </address>
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
<!--<script src="../dist/js/lib/requirejs/requirejs.js"></script>-->
<!--<script src="../dist/js/config.js"></script>-->
<!--<script type="text/javascript">-->
<!--require.config({baseUrl: '{WEBSITE_SOURCE_URL}/js'});-->
<!--require(['app/select2','app/slider']);-->
<!--</script>-->
</body>
</html>
