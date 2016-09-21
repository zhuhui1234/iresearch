<!-- INCLUDE ../header.tpl -->
<div class="wrap">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="active">注册账户</li>
        </ol>
        <div class="row">
            <div class="col-xs-4 col-xs-offset-2">
                <div class="user-center">
                    <form data-toggle="validator" role="form" id="index-login" action="?m=user&a=registerSendMail" method="post">
                        <div class="form-group">
                            <label>请输入企业邮箱</label>
                            <input name="registerMail" type="email" class="form-control" id="inputEmail" placeholder="Email" data-error="请输入正确的邮箱格式" required>
                        </div>
                        <div class="form-group">
                            <label>请输入验证码</label>
                            <input type="text" class="form-control" name="vcode" id="vcodes" required>
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
                        <p>邮箱：last@example.com</p>
                        <p>电话：400-888-8888</p>
                        <p>地址：上海市漕溪北路333号B座701</p>
                    </address>
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
