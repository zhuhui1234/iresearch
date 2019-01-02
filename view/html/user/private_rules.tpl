<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>免费申明</title>
    <link href="//irv.iresearch.com.cn/iResearchDataWeb/public/css/private_rule/index.css" rel="stylesheet">
</head>
<body>
<div class="declare">
    <div class="declare_content">
        <div class="declare_nav">
            <div class="declare_main">
                {content}
            </div>
            <div class="declare_footer">
                <button id="disagree">不接受</button>
                <button id="agree">我已同意</button>
            </div>
        </div>
    </div>
</div>
</body>

<!-- 开发环境 -->
<script src="{WEBSITE_SOURCE_URL}/js/lib/requirejs/requirejs.js"></script>
<script src="{WEBSITE_SOURCE_URL}/js/config.js"></script>
<script type="text/javascript">
    require.config({baseUrl: '{WEBSITE_SOURCE_URL}/js'});
    require([
        'app/user/agree'
    ]);
</script>
</html>
