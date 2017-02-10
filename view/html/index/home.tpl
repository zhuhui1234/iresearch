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
                                                                <span><i class="fa fa-check-square-o"></i>自定义人群</span>
                                                                <span><i class="fa fa-check-square-o"></i>媒介计划</span>
                                                                <span><i class="fa fa-check-square-o"></i>用户画像</span>
                                                                <span><i class="fa fa-check-square-o"></i>信息管理</span>
                                                            </p>
                                                        </div>
                                                        <!-- IF ptype="0" -->
                                                        <div class="product-content-footer">
                                                            <a href="{curl}">
                                                                <!-- IF menuIntro="建设中..." -->
                                                                <i class="fa fa-arrow-circle-right"></i>建设中
                                                                <!-- ELSE -->
                                                                <i class="fa fa-arrow-circle-right"></i>申请试用
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


                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content history">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">
                                        <img src="./public/img/irdpop.png" alt="">
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    <iframe style="display: none;" src="" name="target_submit"></iframe>
                                    <form role="form" target="target_submit" id="bindingIRDA">
                                        <p style="display: none" id="binding_irda_error"
                                           class="text-center text-danger"><i class="fa fa-warning"></i> 绑定失败，请输入正确的账号密码
                                        </p>
                                        <div class="form-group">
                                            <input id="irda_email" name="mail" type="text" class="form-control"
                                                   placeholder="用户名">
                                        </div>
                                        <div class="form-group">
                                            <input id="irda_pwd" type="password" name="pwd" class="form-control"
                                                   placeholder="密码">
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