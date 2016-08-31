<div class="footer">
    <p>
        <a href="#">关于我们</a>
        <a href="#">加入我们</a>
        <a href="#">隐私</a>
        <a href="#">服务条款</a>
        <a href="#">法律条款</a>
    </p>
    <p>
        <span>Copyright© 2002-2016</span>
        <span>艾瑞咨询集团</span>
        <span>上海·北京·广州·东京·硅谷·香港</span>
    </p>
</div>
<!-- 开发环境 -->
<script src="{WEBSITE_SOURCE_URL}/js/lib/requirejs/requirejs.js"></script>
<script src="{WEBSITE_SOURCE_URL}/js/config.js"></script>
<script type="text/javascript">
    require.config({baseUrl: '{WEBSITE_SOURCE_URL}/js'});
    require([
        'app/user/login'
    ]);
</script>
</body>
</html>