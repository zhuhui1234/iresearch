<!DOCTYPE html>
<html>
<head>
    <script src="{WEBSITE_SOURCE_URL}/js/lib/jquery/v2.1.4/jquery.min.js"></script>
    <link rel="shortcut icon" href="//data.iresearch.com.cn/images/favicon.ico" mce_href="http://data.iresearch.com.cn/images/favicon.ico" type="image/x-icon">

    <title></title>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script>
        $(function ($) {
            $("._showReport").on("click", function () {
                var url = $(this).attr("cfg_url");
                var urlInfo = url.split("=");
                var rs = setReport(urlInfo[3]);
                if (rs) {
                    console.log("展示报告");
                    $("#frameReport").attr("src", url);
                }
            });
            function setReport(guid) {
                var rs = false;
                var url = '?m=service&a=upUserSessionKey';
                var guid = guid;
                $.ajax({
                    async: false,
                    type: 'POST',
                    data: {"guid":guid},
                    url: url,
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
                        <!-- BEGIN listInfo -->
                        <li role="presentation"><a href="#" class="_showReport" cfg_url="{cfg_url}"
                                                   >{cfg_name}</a></li>
                        <!-- END listInfo -->
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <iframe id="frameReport" scrolling="no" width="100%" height="850"
                    frameborder="0">
            </iframe>
        </div>
    </div>
</div>
<!-- 以下为模拟登陆表单 -->
</body>
</html>