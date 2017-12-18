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
    <link rel="stylesheet" href="//data.iresearch.com.cn/css/bootstrap.min.css" />
    <link rel="stylesheet" href="public/css/xvt/header.css?2342" />
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
    <div class="search ut">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="public/img/background2@2x.png" alt="">
                </div>
                <div class="col-md-6">
                    <div class="search-content" style="padding-top: 30px">
                        <h4>艾瑞用户行为监测</h4>
                        <p>帮助企业及时了解市场发展趋势、与竞争对手之间的用户差异</p>
                        <p>以及不同目标受众的网络行为差异。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="product">
        <div class="mobile">
            <div class="item ut" v-for="item in product">
                <img :src="item.logo" width="200" />
                <h4>产品介绍</h4>
                <p class="info">[[ item.info ]]</p>
                <h4>产品价值</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="inner">

                            <h5 v-bind:style="{display:'block'}" style="display: none;">
                                <img src="public/img/net@2x.png" alt=""> [[ item.itemA.title ]]
                            </h5>
                            <p v-bind:style="{display:'block'}" style="display: none;" v-for="val in item.itemA.info">
                                <i></i>
                                <span>[[ val ]]</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inner">
                            <p v-bind:style="{display:'none'}">加载中......</p>
                            <h5 v-bind:style="{display:'block'}" style="display: none;">
                                <img src="public/img/ad@2x.png" alt=""> [[ item.itemB.title ]]
                            </h5>
                            <p v-bind:style="{display:'block'}" style="display: none;" v-for="val in item.itemB.info">
                                <i></i>
                                <span>[[ val ]]</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4" v-if="item.itemC">
                        <div class="inner">
                            <p v-bind:style="{display:'none'}">加载中......</p>
                            <h5 v-bind:style="{display:'block'}" style="display: none;">
                                <img src="public/img/copy@2x.png" alt=""> [[ item.itemC.title ]]
                            </h5>
                            <p v-bind:style="{display:'block'}" style="display: none;" v-for="val in item.itemC.info">
                                <i></i>
                                <span>[[ val ]]</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="change-btn">

                    <!--<a v-if="product[tabIndex].show" class="btn btn-primary btn-lg" v-bind:href="[[[[ product[tabIndex].url ]]]]">开始使用</a>
                    <a v-else="product[tabIndex].show" class="btn btn-primary btn-lg btn-warning" href="">敬请期待！！</a> -->
                    <!-- IF token=="1" -->
                    <a class="btn btn-lg btn-primary" v-bind:href="[[ product[tabIndex].oldurl ]]">登入旧版本</a>
                    <!-- ELSE -->
                    <!-- IF irdStatus=="1" -->

                    <button v-if="product[tabIndex].isOldURL " class="btn btn-lg btn-primary" data-toggle="modal" data-target="#myModal">登入旧版本</button>
                    <!-- ELSE -->

                    <a v-if="product[tabIndex].isOldURL" class="btn btn-lg btn-primary" v-bind:href="[[ product[tabIndex].oldurl ]]">登入旧版本</a>

                    <!-- ENDIF -->
                    <!-- ENDIF -->
                </div>
            </div>
        </div>
        <div class="pc ut">
            <div class="item-tab">
                <ul class="item-tab-left">
                    <li v-for="(item, index) in product" :key="item" @mouseenter="changeTab(index)" :class="tabIndex === index ? 'active' : ''"
                        :key="tab">
                        <img class="icon" :src="item.icon" />
                        <img class="logo" :src="item.logo" />
                    </li>
                </ul>
                <div class="item-tab-content">
                    <div class="row">
                        <div class="col-xs-12">
                            <h4>产品介绍</h4>
                            <p v-bind:style="{display:'none'}">加载中......</p>
                            <p v-bind:style="{display:'block'}" style="display: none;">[[ product[tabIndex].info ]]</p>
                        </div>
                        <div class="col-xs-12" style="margin-top: 20px;">
                            <h4>产品价值</h4>
                        </div>
                        <div class="col-xs-6">
                            <p v-bind:style="{display:'none'}">加载中......</p>
                            <h5 v-bind:style="{display:'block'}" style="display: none;"><img src="public/img/net@2x.png" alt=""> [[ product[tabIndex].itemA.title ]]</h5>
                            <p v-bind:style="{display:'block'}" style="display: none;" v-for="val in product[tabIndex].itemA.info">
                                [[ val ]]
                            </p>
                        </div>
                        <div class="col-xs-6">
                            <p v-bind:style="{display:'none'}">加载中......</p>
                            <h5 v-bind:style="{display:'block'}" style="display: none;" ><img src="public/img/ad@2x.png" alt=""> [[ product[tabIndex].itemB.title ]]</h5>
                            <p v-bind:style="{display:'block'}" style="display: none;" v-for="val in product[tabIndex].itemB.info">
                                [[ val ]]
                            </p>
                        </div>
                        <div class="col-xs-6" v-if="product[tabIndex].itemC">
                            <p v-bind:style="{display:'none'}">加载中......</p>
                            <h5 v-bind:style="{display:'block'}" style="display: none;"><img src="public/img/copy@2x.png" alt=""> [[ product[tabIndex].itemC.title ]]</h5>
                            <p v-bind:style="{display:'block'}" style="display: none;" v-for="val in product[tabIndex].itemC.info">
                                [[ val ]]
                            </p>
                        </div>
                    </div>
                    <div class="change-btn">
                        <!-- <a v-if="product[tabIndex].show" class="btn btn-primary btn-lg" v-bind:href="[[[[ product[tabIndex].url ]]]]">开始使用</a>
                        <a v-else="product[tabIndex].show" class="text-warning" href="">敬请期待！！</a>-->

                        <!-- IF token=="1" -->
                        <a v-if="product[tabIndex].show" class="btn btn-lg btn-primary" v-bind:href="[[ product[tabIndex].oldurl ]]">登入旧版本</a>
                        <!-- ELSE -->
                        <!-- IF irdStatus=="1" -->

                        <button v-if="product[tabIndex].isOldURL && product[tabIndex].show" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#myModal">登入旧版本</button>
                        <!-- ELSE -->

                        <a v-if="product[tabIndex].isOldURL && product[tabIndex].show" class="btn btn-lg btn-primary" v-bind:href="[[ product[tabIndex].oldurl ]]">登入旧版本</a>

                        <!-- ENDIF -->
                        <!-- ENDIF -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal my-modal ut fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                    <div class="form-horizontal">
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
                    </div>
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
            logo: 'public/img/iut.svg',
            icon: 'public/img/iut@2x.png',
            isOldURL: true,
            show:true,
            oldurl: '?m=irdata&a=classicSys&ppname=PC端用户行为监测_经典版',
            url: 'http://irv.iresearch.com.cn/iResearchDataWeb/?m=user&a=jump&pro=12',
            info: 'iUserTracker网络用户行为监测，是基于庞大的网民样本行为监测所建立的数据库。该数据库自2006年开始，收集包括用户网络浏览的行为、软件使用行为等详细信息，凭借多年的互联网行业研究经验，通过被监测样本的用户属性标签及多个用户行为竞争分析指标，真实反映中国互联网整体及不同用户市场的客观情况。',
            itemA: {
                title: '互联网公司',
                info: [
                    '帮助：掌握市场第一手资料。',
                    '洞察：竞争媒体运营及市场变化。',
                    '挖掘：用户网络访问习惯改善用户体验。'
                ]
            },
            itemB: {
                title: '广告公司及广告主',
                info: [
                    '帮助：了解媒体目标用户的网络使用习惯。',
                    '定制：媒介资源和营销策略。',
                    '提升：媒介投放策略。'
                ]
            },
            itemC: {
                title: '证明营销活动的效果',
                info: [
                    '测量：通过技术手段测量广告营销活动的目标受众是否准确、是否达到了投放的预期效果，对收视提升是否有帮助等。'
                ]
            }
        }, {
            logo: 'public/img/mut.svg',
            icon: 'public/img/mut@2x.png',
            isOldURL: true,
            oldurl: '?m=irdata&a=classicSys&ppname=移动端用户行为监测_经典版',
            show:true,
            url: 'http://irv.iresearch.com.cn/iResearchDataWeb/?m=user&a=jump&pro=37',
            info: 'mUserTracker移动用户行为监测，基于大移动网民样本行为进行监测所建立的数据库，该数据库由2012年开始，收集包括用户通过移动设备，对App的使用行为、浏览网站的行为等相关情况。并通过对数据的大量分析建立了多个用户行为指标，真实反映中国移动互联网市场客观情况。并利用对被监测样本的用户属性进行标签设定，从而能够从多个维度对用户市场进行定义和细分。',
            itemA: {
                title: '互联网公司',
                info: [
                    '帮助：广告公司及广告主了解智能终端用户的网络行为特征。',
                    '洞察：移动端进行营销推广时，为选择最佳投放方案提供数据支持。'
                ]
            },
            itemB: {
                title: '移动互联网企业及开发者',
                info: [
                    '帮助：移动互联网企业及开发者分析自身的产品在整个大行业或细分行业中所处的地位。',
                    '提升：了解自身的产品用户群体特征以及市场竞争差异。'
                ]

            },
            itemC: {
                title: '电信及运营商',
                info: [
                    '评估：帮助电信及运营商了解用户上网行为，评估不同运营商的互联网流量经营差异。'
                ]
            }
        }, {
            logo: 'public/img/out.svg',
            icon: 'public/img/out@2x.png',
            isOldURL: true,
            show:false,
            oldurl: '?m=irdata&a=classicSys&ppname=OTT端视频内容市场监测',
            url: 'http://irv.iresearch.com.cn/iResearchDataWeb/?m=user&a=jump&pro=14',
            info: 'oUserTracker智能电视用户行为监测产品，是基于智能电视网民样本行为监测所建立的数据库。该数据库由2017年开始，收集用户通过智能电视设备的App使用行为，并通过对数据的大量分析建立了多个用户行为指标，真实反映中国智能电视APP使用市场客观情况。并利用对被监测样本的用户属性进行标签设定，从而能够从多个维度对用户市场进行定义和细分。',
            itemA: {
                title: '互联网公司',
                info: [
                    '帮助：广告公司及广告主了解智能电视终端APP用户的网络行为特征。',
                    '洞察：智能电视终端APP进行营销推广时，为选择最佳投放方案提供数据支持。'
                ]
            },
            itemB: {
                title: '智能电视APP企业及开发者',
                info: [
                    '帮助：智能电视APP企业及开发者分析自身的产品在整个大行业或细分行业中所处的地位。',
                    '提升：了解自身的产品用户群体特征以及市场竞争差异。'
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
                changeTab: function(index) {
                    this.tabIndex = index;
                }
            }
        });
    </script>
</body>

</html>