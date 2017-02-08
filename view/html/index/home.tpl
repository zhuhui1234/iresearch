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
    <link href="./public/css/app.css" rel="stylesheet">
    <!-- 自定义 -->
    <link href="./public/css/docs.min.css" rel="stylesheet">
    <title>{title}</title>
</head>
<body>
<!-- INCLUDE ../nav.tpl -->
<div class="index-tab">
    <div class="container">
        <ul class="nav" role="tablist">
            <!-- BEGIN titleMenu -->
            <!-- IF menuID="5" -->
            <li id="titleMenuID{menuID}" role="presentation" class="active">
            <!-- ELSE -->
            <li id="titleMenuID{menuID}" role="presentation" class="">
            <!-- ENDIF -->
            <a href="#menuID{menuID}" role="tab" data-toggle="tab">
                    <span>{menuName}</span>
                </a>
            </li>
            <!-- END BEGIN -->
        </ul>
    </div>
</div>


<!-- PAGE -->

<div class="container index-tab-content">
    <div class="tab-content">
        <!-- BEGIN mainMenu -->
        <!-- IF menuID="5" -->
        <div role="tabpanel" class="tab-pane active" id="menuID{menuID}">
        <!-- ELSE -->
        <div role="tabpanel" class="tab-pane" id="menuID{menuID}">
        <!-- ENDIF -->
            <div class="swiper-container">

                <div class="swiper-wrapper">
                    <!-- BEGIN reTree -->
                    <div class="swiper-slide">
                        <div class="row">
                            <!-- BEGIN list -->
                            <div class="col-xs-6" data-swiper-parallax="-100">
                                <div class="product-content has-active">
                                    <div class="product-content-header s2">
                                        <div class="product-icon">
                                            <img src="./public/img/product-icon-1.png" alt="">
                                        </div>
                                        <div class="product-title">
                                            <div class="product-title">
                                                <h3>{menuIntro}</h3>
                                                <h4 class="pepsi">{menuName}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content-body">
                                        <p>
                                            在特区政府卫生局当晚11时许召开的记者会上，局长李展润表示，患者为72岁女性，患有高血压、糖尿病等慢性病，平时居住在广东中山五桂山镇桂南马溪村。
                                        </p>
                                        <p>
                                            <span><i class="fa fa-check-square-o"></i>自定义人群</span>
                                            <span><i class="fa fa-check-square-o"></i>媒介计划</span>
                                            <span><i class="fa fa-check-square-o"></i>用户画像</span>
                                            <span><i class="fa fa-check-square-o"></i>信息管理</span>
                                        </p>
                                    </div>
                                    <!-- IF ptype=1 -->
                                    <div class="product-content-footer">
                                        <a href="{curl}">
                                            <i class="fa fa-arrow-circle-right"></i>申请试用
                                        </a>
                                    </div>
                                    <!-- ELSE -->
                                    <div class="product-content-footer">
                                        <a href="{curl}">
                                            <i class="fa fa-arrow-circle-right"></i>进入产品
                                        </a>
                                    </div>
                                    <!-- ENDIF -->
                                </div>
                            </div>

                            <!-- END BEGIN -->
                        </div>
                    </div>
                    <!-- END BEGIN -->
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <!-- END BEGIN -->


    </div>
</div>

<!-- end PAGE -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content history">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <img src="./public/img/irdpop.png" alt="">
                </h4>
            </div>
            <div class="modal-body">
                <iframe style="display: none;" src="" name="target_submit"></iframe>
                <form role="form" target="target_submit" id="bindingIRDA">
                    <p style="display: none" id="binding_irda_error" class="text-center text-danger"><i class="fa fa-warning"></i> 绑定失败，请输入正确的账号密码</p>
                    <div class="form-group">
                        <input id="irda_email" name="mail" type="text" class="form-control" placeholder="用户名">
                    </div>
                    <div class="form-group">
                        <input id="irda_pwd" type="password" name="pwd" class="form-control" placeholder="密码">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">确定</button>
                </form>
                <p>如有账号问题，请联系 400-000-000</p>
            </div>
        </div>
    </div>
</div>
<!-- INCLUDE ../foot.tpl -->
<!-- 开发环境 -->
<script src="{WEBSITE_SOURCE_URL}/js/lib/requirejs/requirejs.js"></script>
<script src="{WEBSITE_SOURCE_URL}/js/config.js"></script>
<script type="text/javascript">
    require.config({baseUrl: '{WEBSITE_SOURCE_URL}/js'});
    require([
        'app/home/index',
        'app/home/index-focus'
    ]);
</script>
<!-- 生产环境 -->
<!--<script src="./public/js/lib/requirejs/requirejs.js"></script>-->
<!--<script src="./public/js/config.js"></script>-->
<!--<script type="text/javascript">-->
    <!--require.config({baseUrl: './public/js'});-->
    <!--require([-->
        <!--'app/swiper',-->
        <!--'app/wow'-->
    <!--]);-->
<!--</script>-->
</body>
</html>