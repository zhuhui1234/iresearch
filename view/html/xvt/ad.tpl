<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>艾瑞数据 - 数据改变认知 提升企业效能</title>
    <meta name="keywords" content="艾瑞数据,艾瑞指数,艾瑞睿见,艾瑞智云">
    <meta name="description" content="艾瑞数据，是艾瑞互联网大数据服务平台，基于15年互联网的研究积累，致力于数据改变认知、提升企业效能，为客户提供基于情报+数据+服务的多元化大数据解决方案，服务涵盖市场竞争监测、消费者洞察、营销决策、企业精细化运营及数据共享等业务。">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <script>
        (function (doc, win) {
            var docEl = doc.documentElement,
                resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
                recalc = function () {
                    var clientWidth = docEl.clientWidth;
                    if (!clientWidth) return;
                    var _FS = 100 * (clientWidth / 750);
                    if (_FS > 100) _FS = 100;
                    docEl.style.fontSize = _FS + 'px';
                };

            if (!doc.addEventListener) return;
            win.addEventListener(resizeEvt, recalc, false);
            doc.addEventListener('DOMContentLoaded', recalc, false);
        })(document, window);
    </script>
    <link rel="shortcut icon" href="http://data.iresearch.com.cn/images/favicon.ico" mce_href="http://data.iresearch.com.cn/images/favicon.ico"
        type="image/x-icon">
    <link rel="stylesheet" href="http://data.iresearch.com.cn/css/bootstrap.min.css" />
    <link rel="stylesheet" href="public/css/xvt/header.css?4343" />
    <link rel="stylesheet" href="public/css/xvt/index.css" />
</head>

<body>
    <div class="Topbar">
        <div class="container">
            <div class="links"><a href="http://group.iresearch.com.cn/" target="_blank">艾瑞集团</a>|<a href="http://www.iresearch.com.cn/" target="_blank">艾瑞咨询</a>|
                <a href="http://data.iresearch.com.cn/" target="_blank">艾瑞数据</a>|<a href="http://capital.iresearch.com.cn/"
                    target="_blank">艾瑞资本</a> |
                <a href="http://www.iresearch.cn/" target="_blank">艾瑞网</a>|<a href="http://events.iresearch.cn/" target="_blank">艾瑞活动</a>|
                <a href="http://www.iresearchchina.com/" target="_blank">English</a>
            </div>
        </div>
    </div>

    <!--导航-->
    <!-- INCLUDE nav.tpl -->
    <!--导航 end-->
    <div class="search vt">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="public/img/background3@2x.png" alt="">
                </div>
                <div class="col-md-6">
                    <div class="search-content">
                        <h4>艾瑞广告投放监测</h4>
                        <p>帮助广告公司及广告主了解行业网络广告发展现状，协</p>
                        <p>助品牌制定合理的网络营销预算，参考竞争品牌媒体</p>
                        <p>投放及创意投放策略，帮助品牌优化媒介投放方案。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="product">
        <div class="pc vt">
            <div class="item-tab">
                <!--<ul class="item-tab-left">
                    <li v-for="(item, index) in product" :key="item" @mouseenter="changeTab(index)" :class="tabIndex === index ? 'active' : ''"
                        :key="tab">
                        <img class="icon" :src="item.icon" />
                        <img class="logo" :src="item.logo" />
                    </li>
                </ul>-->
                <div class="item-tab-content">
                    <div class="row">
                        <div class="col-xs-12">
                            <h4>产品介绍</h4>
                            <p v-bind:style="{display:'none'}">加载中.......</p>
                            <p v-bind:style="{display:'block'}" style="display: none">[[ product[tabIndex].info ]]</p>
                        </div>
                        <div class="col-xs-12" style="margin-top: 20px;">
                            <h4>产品价值</h4>
                        </div>
                        <div class="col-xs-6">
                            <h5 v-bind:style="{display:'block'}" style="display: none;"><img src="public/img/net@2x.png" alt=""> [[ product[tabIndex].itemA.title ]]</h5>
                            <p v-bind:style="{display:'none'}">加载中.......</p>
                            <p  v-bind:style="{display:'block'}" style="display: none;"  v-for="val in product[tabIndex].itemA.info">
                                [[ val ]]
                            </p>
                        </div>
                        <div class="col-xs-6">
                            <h5 v-bind:style="{display:'block'}" style="display: none;"><img src="public/img/ad@2x.png" alt=""> [[ product[tabIndex].itemB.title ]]</h5>
                            <p v-bind:style="{display:'none'}">加载中.......</p>
                            <p v-bind:style="{display:'block'}" style="display: none;" v-for="val in product[tabIndex].itemB.info">
                                [[ val ]]
                            </p>
                        </div>
                        <div class="col-xs-6">
                            <h5 v-bind:style="{display:'block'}" style="display: none;"><img src="public/img/copy@2x.png" alt=""> [[ product[tabIndex].itemC.title ]]</h5>
                            <p v-bind:style="{display:'none'}">加载中.......</p>
                            <p v-bind:style="{display:'block'}" style="display: none;" v-for="val in product[tabIndex].itemC.info">
                                [[ val ]]
                            </p>
                        </div>
                    </div>
                    <div class="change-btn">
                        <a class="btn btn-lg btn-primary " v-bind:href="[[ product[tabIndex].url ]]">开始使用</a>
                        <!-- IF token=="1" -->
                        <a class="btn btn-link" v-bind:href="[[ product[tabIndex].oldurl ]]">切换旧版本</a>
                        <!-- ELSE -->
                        <!-- IF irdStatus=="1" -->
                        <button v-if="product[tabIndex].isOldURL " class="btn btn-link" data-toggle="modal" data-target="#myModal">切换旧版本</button>
                        <!-- ELSE -->
                        <a v-if="product[tabIndex].isOldURL" class="btn btn-link" v-bind:href="[[ product[tabIndex].oldurl ]]">切换旧版本</a>

                        <!-- ENDIF -->
                        <!-- ENDIF -->
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile">
            <div class="item vt" v-for="item in product" :key="item">
                <!--<img :src="item.logo" width="200" />-->
                <h4>产品介绍</h4>
                <p class="info">[[ item.info ]]</p>
                <h4>产品价值</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="inner">
                            <h5>
                                <img src="public/img/net@2x.png" alt=""> [[ item.itemA.title ]]
                            </h5>
                            <p v-for="val in item.itemA.info">
                                <i></i>
                                <span>[[ val ]]</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner">
                            <h5>
                                <img src="public/img/ad@2x.png" alt=""> [[ item.itemB.title ]]
                            </h5>
                            <p v-for="val in item.itemB.info">
                                <i></i>
                                <span>[[ val ]]</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner">
                            <h5>
                                <img src="public/img/copy@2x.png" alt=""> [[ item.itemC.title ]]
                            </h5>
                            <p v-for="val in item.itemC.info">
                                <i></i>
                                <span>[[ val ]]</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="change-btn">
                    <!-- IF token=="1" -->
                    <a class="btn btn-link" v-bind:href="[[ product[tabIndex].oldurl ]]">切换旧版本</a>
                    <!-- ELSE -->
                    <!-- IF irdStatus=="1" -->
                    <button v-if="product[tabIndex].isOldURL " class="btn btn-link" data-toggle="modal" data-target="#myModal">切换旧版本</button>
                    <!-- ELSE -->
                    <a v-if="product[tabIndex].isOldURL" class="btn btn-link" v-bind:href="[[ product[tabIndex].oldurl ]]">切换旧版本</a>

                    <!-- ENDIF -->
                    <!-- ENDIF -->
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal my-modal vt fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title" id="myModalLabel">绑定历史版</h5>
                </div>
                <div class="modal-body">
                    <div class="imgs">
                        <img class="logo" src="public/img/logo@2x.png" alt="">
                        <img class="old" src="public/img/old@2x.png" alt="">
                    </div>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">用户名</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ps" class="col-sm-2 control-label">密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="ps">
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary binding">绑定</button>
                        </div>
                        <p>如有账号问题，请联系 400-000-000</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <h3 class="tit"><span>联系我们　Contact Us</span></h3>
        <div class="contact"><span class="ico ico1"></span>400-026-2099　　<span class="ico ico2"></span>ask@iresearch.com.cn</div>
        <div class="copy">
            2002 - 2017 Copyright© 艾瑞数据 <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=31010402000584"><img src="http://www.iresearch.com.cn/images/record_icon.png">沪公网安备 31010402000584号</a>
        </div>
    </div>
    <script src="http://data.iresearch.com.cn/js/jquery.min.js"></script>
    <script src="http://data.iresearch.com.cn/js/bootstrap.min.js"></script>
    <script src="https://cdn.bootcss.com/vue/2.3.4/vue.min.js"></script>
    <script src="public/js/header.js"></script>
    <script src="public/js/xvt.js"></script>

    <script>
        var product = [{
            icon: 'public/img/ivt@2x.png',
            isOldURL: true,
            url: 'http://irv.iresearch.com.cn/iResearchDataWeb/?m=user&a=jump&pro=42',
            oldurl: '?m=irdata&a=classicSys&ppname=PC端营销广告市场监测',
            info: 'AdTracker广告投放监测由艾瑞咨询自主研发，是通过爬虫技术在几百个网站上进行图片广告监测所建立的数据库。该数据库自2001年开始，统计及计算包含门户、垂直、视频、APP等媒体上品牌客户广告投放量及投放预估费用数据，真实反映中国互联网广告市场客观情况。',
            itemA: {
                title: '互联网公司',
                info: [
                    '帮助互联网公司即时掌握竞争媒体的最新客户投放情报，指导自身媒体的地区及行业销售策略。'
                ]
            },
            itemB: {
                title: '广告公司及广告主',
                info: [
                    '帮助广告公司及广告主了解行业网络广告发展现状。',
                    '协助品牌制定合理的网络营销预算。',
                    '参考竞争品牌媒体投放及创意投放策略。',
                    '帮助品牌优化媒介投放方案。'
                ]
            },
            itemC: {
                title: '投资者及分析师',
                info: [
                    '帮助投资者及分析师在财报发布前及时的了解媒体网络广告收入动态，为投资决策提供有效支持。'
                ]
            }
        }];
        var app = new Vue({
            delimiters: ["[[", "]]"],
            el: '#product',
            data: {
                product: product,
                tabIndex: 0
            },
            methods: {
                changeTab: function (index) {
                    this.tabIndex = index;
                }
            }
        });
    </script>
</body>

</html>