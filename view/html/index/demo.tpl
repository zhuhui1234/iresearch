<!DOCTYPE html>
<html>
<head>
    <script src="{WEBSITE_SOURCE_URL}/js/jquery.min.js"></script>
    <title></title>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script>
        $(function ($) {
            var yhDomain = '203.156.255.149';
            $("._showNowUser").on("click", function () {
                url = "http://" + yhDomain + "/bi/Viewer";
                console.log("显示身份");
                $("#frameReport").attr("src", url);
            });
            $("._ajaxLogin").on("click", function () {
                var yu = $(this).attr("data-user");
                logYH(yu);
            });

            $("._showReport").on("click", function () {
                var yu = $(this).attr("data-user");
                var sKey = getKey(yu);
                console.log(sKey);
                $("#frameYH").remove();//删除对象
                var iframe = document.createElement("iframe");
                iframe.src = "http://" + yhDomain + "/bi/Viewer?proc=11&action=logout&isJs=true";
                iframe.id = "frameYH";
                if (iframe.attachEvent) {
                    iframe.attachEvent("onload", function () {
                        console.log("注销-logout");
                        loginYH(yu);
                    });
                } else {
                    iframe.onload = function () {
                        console.log("注销-logout");
                        loginYH(yu);
                    };
                }
                document.body.appendChild(iframe);
                $(iframe).hide();
                setTimeout(function () {
                    var url = "http://" + yhDomain + "/bi/Viewer?proc=1&action=viewer&hback=true&db=iAdMatrix_Home.db&browserType=Firefox";
                    if (yu === 'admin') {
                        url = "http://" + yhDomain + "/bi/Viewer?proc=1&action=viewer&hback=true&db=^76d1^^63a7^^7cfb^^7edf^^2f^JVM^4fe1^^606f^^7edf^^8ba1^.db&browserType=Firefox";
                    } else if (yu === 'davidwei') {
                        url = "http://" + yhDomain + "/bi/Viewer?proc=1&action=viewer&hback=true&db=DXStock^2f^^9ed8^^8ba4^^62a5^^8868^.db";
                    }
                    console.log("展示报告");
                    $("#frameReport").attr("src", url);
                }, 800);
            });
            /**
             $("#gameUser").on("click", function () {
                console.log("登陆永洪-gameUser");
                var sKey = getKey();
                console.log(sKey);
                var rs = logYH(sKey);
                console.log(rs);
            });
             */
            function loginYH(yu) {
                $("#sessionKey").val(yu);
                $("#yhForm").submit();
                console.log("登陆永洪");
            }

            function getKey(yu) {
                var rs;
                var url = '?m=user&a=upUserSessionKey';
                $.ajax({
                    async: false,
                    type: 'POST',
                    url: url,
                    data: {"yu":yu},
                    success: function (res) {
                        res = $.parseJSON(res);
                        rs = res.content;
                    }
                });
                return rs;
            }


            function logYH(sessionKey) {
                var rs =false;
                var url = '{YH}';
                $.ajax({
                    async: false,
                    type: 'POST',
                    url: url,
                    data: {"sessionKey":sessionKey},
                    success: function (res) {
                        rs = true
                    }
                });
                return rs;
            }

            function logoutYH() {
                var rs =false;
                var url = 'http://" + yhDomain + "/bi/Viewer?proc=11&action=logout&isJs=true';
                $.ajax({
                    async: false,
                    type: 'POST',
                    url: url,
                    data: {"sessionKey":sessionKey},
                    success: function (res) {
                        rs = true
                    }
                });
                return rs;
            }
        });

    </script>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-2">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-stacked">
                        <li role="presentation"><a href="#" class="_showReport" data-user="admin">永洪Admin身份报告</a></li>
                        <li role="presentation"><a href="#" class="_showReport" data-user="iadm">iadm身份报告</a></li>
                        <li role="presentation"><a href="#" class="_showReport" data-user="davidwei">davidwei身份报告</a>
                        </li>
                        <li role="presentation"><a href="#" class="_showNowUser" data-user="showUser">查看当前用户身份</a></li>
                        <li role="presentation"><a href="#" class="_ajaxLogin" data-user="davidwei">ajax方式登录-调试用</a></li>
                        <li role="presentation"><a href="#" class="_ajaxLogout">ajax方式登出-调试用</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <iframe id="frameReport" style="border: 1px solid silver;" scrolling="yes" width="100%" height="800"
                    frameborder="0">
            </iframe>
        </div>
    </div>
</div>
<!-- 以下为模拟登陆表单 -->
<iframe id="frameYH" name="frameYH" width="0" height="0" src="" style="display:none">
</iframe>
<form action="{YH}" method="post" id="yhForm" name="yhForm" target="frameYH">
    <input type="hidden" name="sessionKey" id="sessionKey" value="login"/>
</form>
</body>
</html>