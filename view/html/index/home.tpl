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
            <li id="titleMenuID{menuID}" role="presentation" data-toggle="tab" class="tabMenu active">
                <!-- ELSE -->
            <li id="titleMenuID{menuID}" role="presentation" data-toggle="tab" class="tabMenu">
                <!-- ENDIF -->
                <a href="#menuID{menuID}" role="presentation" data-toggle="tab">
                    <span>{menuName}</span>
                </a>
            </li>
            <!-- END BEGIN -->
        </ul>
    </div>
</div>


<!-- PAGE -->
{irdStatus}
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
                                <div class="col-xs-6">
                                    <!-- IF menuIntro="建设中..." -->
                                    <div class="product-content">
                                        <!-- ELSE -->
                                        <div class="product-content has-active">
                                            <!-- ENDIF -->
                                            <!-- IF series="1" -->
                                            <div class="product-content-header s1">
                                                <!-- ELSEIF series="2" -->
                                                <div class="product-content-header s3">
                                                    <!-- ELSEIF series="3" -->
                                                    <div class="product-content-header s4">
                                                        <!-- ELSEIF series="4" -->
                                                        <div class="product-content-header s2">
                                                            <!-- ENDIF -->
                                                            <div class="product-icon">
                                                                <!-- IF series="1" -->
                                                                <img class="img-responsive"
                                                                     src="./public/img/product-icon-1.png" alt="">
                                                                <!-- ELSEIF series="2" -->
                                                                <img class="img-responsive"
                                                                     src="./public/img/product-icon-2.png" alt="">
                                                                <!-- ELSEIF series="3" -->
                                                                <img class="img-responsive"
                                                                     src="./public/img/product-icon-3.png" alt="">
                                                                <!-- ELSEIF series="4" -->
                                                                <img class="img-responsive"
                                                                     src="./public/img/product-icon-4.png" alt="">
                                                                <!-- ENDIF -->
                                                            </div>
                                                            <div class="product-title">
                                                                <div class="product-title">
                                                                    <h3>{menuName}</h3>
                                                                    <h4 class="pepsi">{menuEName}</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-content-body">
                                                            <p>
                                                                {menuIntro}
                                                            </p>
                                                            <p>
                                                                <!-- IF functionLabel2!="" -->
                                                                <!-- BEGIN functionLabel2 -->
                                                                <span><i class="fa fa-check-square-o"></i>{name}</span>
                                                                <!-- END BEGIN -->
                                                                <!-- ENDIF -->

                                                            </p>
                                                        </div>
                                                        <!-- IF ptype="0" -->
                                                                <!-- IF menuIntro="建设中..." -->
                                                                <div class="product-content-footer">
                                                                <a href="#">
                                                                <i class="fa fa-arrow-circle-right"></i>建设中
                                                                <!-- ELSE -->
                                                                <!-- IF versionType="2" -->
                                                                <!-- IF irdStatus="1" -->
                                                                    <div class="product-content-footer" data-toggle="modal" data-target="#myModal">
                                                                    <a href="#" id="bindingClassicIRD" >
                                                                <i class="fa fa-arrow-circle-right"></i>绑定经典版
                                                                <!-- ELSE -->
                                                                        <div class="product-content-footer">
                                                                        <a href="?m=user&a=trialApply&ppname={menuName}&menuID={menuID}">
                                                                        <i class="fa fa-arrow-circle-right"></i>申请试用
                                                                <!-- ENDIF -->
                                                                <!-- ELSE -->
                                                                            <div class="product-content-footer">
                                                                            <a href="?m=user&a=trialApply&ppname={menuName}&menuID={menuID}">
                                                                     <i class="fa fa-arrow-circle-right"></i>申请试用
                                                                <!-- ENDIF -->
                                                                <!-- ENDIF -->
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