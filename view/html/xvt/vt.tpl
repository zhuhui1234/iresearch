<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>艾瑞数据 - 数据改变认知 提升企业效能</title>
    <meta name="keywords" content="艾瑞数据,艾瑞指数,艾瑞睿见,艾瑞智云">
    <meta name="description"
          content="艾瑞数据，是艾瑞互联网大数据服务平台，基于15年互联网的研究积累，致力于数据改变认知、提升企业效能，为客户提供基于情报+数据+服务的多元化大数据解决方案，服务涵盖市场竞争监测、消费者洞察、营销决策、企业精细化运营及数据共享等业务。">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
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
    <link rel="shortcut icon" href="//data.iresearch.com.cn/images/favicon.ico"
          mce_href="//data.iresearch.com.cn/images/favicon.ico"
          type="image/x-icon">
    <link rel="stylesheet" href="//data.iresearch.com.cn/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="public/css/xvt/header.css?2342"/>
    <link rel="stylesheet" href="public/css/xvt/index.css"/>
</head>

<body>


<script>
    var IRS_pageId = 'iRView'; // 艾瑞睿见
</script>
<script src="//data.iresearch.com.cn/js/IRS_index_head_html.js"></script>
<div class="search vt">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="public/img/background1@2x.png" alt="">
            </div>
            <div class="col-md-6">
                <div class="search-content" style="padding-top: 30px">
                    <h4>艾瑞视频内容市场监测</h4>
                    <p>帮助企业在激烈的市场竞争中脱颖而出</p>
                    <p>证明视频媒体价值以及优化视频广告投放效果。</p>
                    <!--
                         <div class="input-group input-group-lg" style="display: none;">
                        <input id="searchKey" type="text" class="form-control" placeholder="请输入视频内容查询">
                        <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id="searchBtn">
                                    <span class="ivu-icon ivu-icon-search" aria-hidden="true"></span>
                            </button>
                            </span>
                    </div>
                    -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container" id="product">
    <div class="pc vt">
        <div class="item-tab">
            <ul class="item-tab-left">
                <li v-for="(item, index) in product" :key="item" @mouseenter="changeTab(index)"
                    :class="tabIndex === index ? 'active' : ''"
                    :key="tab">
                    <img class="icon" :src="item.icon"/>
                    <img class="logo" :src="item.logo"/>
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
                        <h5 v-bind:style="{display:'block'}" style="display: none;"><img src="public/img/net@2x.png"
                                                                                         alt=""> [[
                            product[tabIndex].itemA.title ]]</h5>
                        <p v-bind:style="{display:'block'}" style="display: none;"
                           v-for="val in product[tabIndex].itemA.info">
                            [[ val ]]
                        </p>
                    </div>
                    <div class="col-xs-6">
                        <h5 v-bind:style="{display:'block'}" style="display: none;"><img src="public/img/ad@2x.png"
                                                                                         alt=""> [[
                            product[tabIndex].itemB.title ]]</h5>
                        <p v-bind:style="{display:'block'}" style="display: none;"
                           v-for="val in product[tabIndex].itemB.info">
                            [[ val ]]
                        </p>
                    </div>
                    <div class="col-xs-6">
                        <p v-bind:style="{display:'none'}">加载中......</p>
                        <h5 v-bind:style="{display:'block'}" style="display: none;"><img src="public/img/copy@2x.png"
                                                                                         alt=""> [[
                            product[tabIndex].itemC.title ]]</h5>
                        <p v-bind:style="{display:'block'}" style="display: none;"
                           v-for="val in product[tabIndex].itemC.info">
                            [[ val ]]
                        </p>
                    </div>
                </div>
                <div class="change-btn">
                    <a v-if="product[tabIndex].show" class="btn btn-primary btn-lg"
                       v-bind:href="[[ product[tabIndex].url ]]">[[ product[tabIndex].button ]]</a>

                    <!-- IF token == "1" -->
                    <a v-if="product[tabIndex].isOldURL " class="btn btn-link"
                       v-bind:href="[[ product[tabIndex].oldurl ]]">[[ product[tabIndex].button_old]]</a>
                    <!-- ELSE -->
                    <!--IF irdStatus=="1" -->
                    <!-- <button v-if="product[tabIndex].isOldURL " class="btn btn-link" data-toggle="modal"
                            data-target="#myModal">登入旧版本
                    </button>-->
                    <!--ELSE -->
                    <a v-if="product[tabIndex].isOldURL " class="btn btn-link"
                       v-bind:href="[[ product[tabIndex].oldurl ]]">[[ product[tabIndex].button_old]]</a>
                    <!--ENDIF -->
                    <!-- ENDIF -->
                </div>
            </div>
        </div>
    </div>
    <div class="mobile">
        <div class="item vt" v-for="item in product" :key="item">
            <img :src="item.logo" width="200"/>
            <h4>产品介绍</h4>
            <p v-bind:style="{display:'none'}">加载中......</p>
            <p class="info">[[ item.info ]]</p>
            <h4>产品价值</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="inner">
                        <p v-bind:style="{display:'none'}">加载中......</p>
                        <h5 v-bind:style="{display:'block'}" style="display: none;">
                            <img src="public/img/net@2x.png" alt=""> [[item.itemA.title]]
                        </h5>
                        <p v-bind:style="{display:'block'}" style="display: none;" v-for="val in item.itemA.info">
                            <i></i>
                            <span>[[ val  ]]</span>
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
                <div class="col-md-4">
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
                <a class="btn btn-primary btn-lg" v-bind:href="[[ product[tabIndex].url ]]">[[ product[tabIndex].button ]]</a>
                <!-- IF token=="1" -->
                <a class="btn btn-link" v-bind:href="[[ product[tabIndex].oldurl]]">[[ product[tabIndex].button_old]]</a>
                <!-- ELSE -->
                <!--IF irdStatus== "1" -->

                <!--<button v-if="product[tabIndex].isOldURL " class="btn btn-link" data-toggle="modal"
                        data-target="#myModal">登入旧版本
                </button>
                <!--ELSE -->

                <!-- <a v-if="product[tabIndex].isOldURL" class="btn btn-link" v-bind:href="[[ product[tabIndex].oldurl]]">[[ product[tabIndex].button_old]]</a>

                <!--ENDIF -->
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
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
<table border="tin"></table>
<script src="//data.iresearch.com.cn/js/IRS_index_foot_html.js"></script>
<script src="//data.iresearch.com.cn/js/jquery.min.js"></script>
<script src="//data.iresearch.com.cn/js/bootstrap.min.js"></script>
<script src="https://cdn.bootcss.com/vue/2.3.4/vue.min.js"></script>
<script src="public/js/xvt.js"></script>
<link href="public/css/xvt/iview.css" rel="stylesheet">
<script>
    var product = [{
        logo: 'public/img/ivt.svg',
        icon: 'public/img/ivt@2x.png',
        isOldURL: true,
        show: true,
        url: '?m=user&a=jump&pro=45',
        oldurl: '{ivt_oldurl}',
        button:'{apply_ivt}',
        button_old:'{apply_beta_ivt}',
        info: 'iVideoTracker网络视频市场监测 ，是基于庞大的网民网络视频收视行为监测数据，记录了自2011年始，用户对视频内容的浏览行为记录。iVideoTracker提供国内主流视频媒体各视频类别、视频影片的收视情况及收视人群分布数据，真实反映中国互联网在线视频市场客观情况，帮助企业了解网民视频内容收视喜好，以指导片源购买、片源定向，证明视屏媒体价值，优化网络视频广告投放效果。',
        itemA: {
            title: '互联网公司',
            info: [
                '帮助：掌握视频内容热点变化，优化对访客视频推荐策略。',
                '监测：竞争媒体市场份额差异、收视人群变化。',
                '挖掘：媒体间差异化竞争优势，体现自身媒体市场竞争优势。'
            ]
        },
        itemB: {
            title: '广告公司及广告主',
            info: [
                '分析：热点视频的收视周期和收视人群属性规模；目标人群的视频内容喜好；视频内容的目标人群覆盖能力。',
                '汇总：各类视频内容的收视人数，收视率及收视时长，为视频广告投放提供决策数据。',
            ]
        },
        itemC: {
            title: '版权制作方',
            info: [
                '提供：用户对不同题材视频的收视偏好。',
                '支持：版权的发行提供数据监测。'
            ]
        }
    }, {
        logo: 'public/img/mvt.svg',
        icon: 'public/img/mvt@2x.png',
        url: '?m=user&a=jump&pro=18',
        isOldURL: false,
        oldUrl: '',
        show: true,
        button:'{apply_mvt}',
        button_old:'',
        info: 'mVideoTracker移动端视频市场监测，基于运营商级别的用户观看移动网络视频内容的收视行为数据，监测主流视频内容提供商不同频道、类型和产地的收视情况，洞察视频内容在不同  视频内容提供商的收视差异及行业收视热度，分析不同受众人群观看视频内容的偏好程度，监控视频内容在各时段的收视趋势，为视频广告媒介优化、视频内容竞争分析、视频内容制作及投资价值，提供客观、准确、快速的第三方监测分析数据。',
        itemA: {
            title: '视频内容提供商',
            info: [
                '洞察 : 竞争媒体不同类型移动端视频内容收视情况，为视频内容提供商购买版权、内容制作提供决策依据。',
                '监测 : 单部视频在不同竞争媒体的收视差异和趋势变化，为视频内容提供商证明广告营销价值。',
                '发掘 : 竞争媒体的内容收视热点变化，为视频内容提供商调整视频内容推荐策略提供量化依据。'
            ]
        },
        itemB: {

            title: '广告公司及广告主',
            info: [
                '分析：移动端视频内容的人群属性、终端和地区偏向程度，精准投放视频广告，提升广告投放效果。',
                '挖掘：聚焦目标用户的内容收视偏好，为移动端视频广告投放质量提供数据依据。',
                '监控：移动端视频内容不同时段的收视情况和峰谷变化，调整广告投放定向时段，优化广告投放策略。'
            ]
        },
        itemC: {
            title: '视频内容制作商',
            info: [
                '统计 : 视频内容在主流播放渠道的总体收视趋势，为内容制作商证明内容收视品质。',
                '支持：不同属性用户的收视喜好偏向调整制作内容类型，为内容制作商生产内容提供数据支持。',
                '对比 : 不同类型移动端视频内容在各媒体的收视差异，为内容制作商选择内容播放渠道提供决策依据。'
            ]
        }
    }, {
        logo: 'public/img/ovt.svg',
        icon: 'public/img/ovt@2x.png',
        url: '?m=user&a=jump&pro=19',
        oldurl: '',
        button:'{apply_ovt}',
        show: true,
        isOldURL: false,
        button_old:'',
        info: 'oVideoTracker OTT端视频市场监测基于运营商级别的用户观看OTT网络视频内容的收视行为数据，监测主流视频内容提供商不同频道、类型和产地的收视情况，洞察视频内容在不同视频内容提供商的收视差异及行业收视热度，分析不同受众人群观看视频内容的偏好程度，监控视频内容在各时段的收视趋势，为视频广告媒介优化、视频内容竞争分析、视频内容制作及投资价值，提供客观、准确、快速的第三方监测分析数据。',
        itemA: {
            title: '视频内容提供商',
            info: [
                '洞察 : 竞争媒体不同类型OTT端视频内容收视情况，为视频内容提供商购买版权、内容制作提供决策依据。',
                '监测 : OTT端单部视频在不同竞争媒体的收视差异和趋势变化，为视频内容提供商证明广告营销价值。',
                '发掘 : 竞争媒体的内容收视热点变化，为OTT端视频内容提供商调整视频内容推荐策略提供量化依据。'
            ]
        },
        itemB: {
            title: '广告公司及广告主',
            info: [
                '分析：OTT端视频内容的人群属性、终端和地区偏向程度，精准投放视频广告，提升广告投放效果。',
                '挖掘：聚焦目标用户的内容收视偏好，为OTT端视频广告投放质量提供数据依据。',
                '监控：OTT端视频内容不同时段的收视情况和峰谷变化，调整广告投放定向时段，优化广告投放策略。'
            ]

        },
        itemC: {
            title: '视频内容制作商',
            info: [
                '统计 : OTT端视频内容在主流播放渠道的总体收视趋势，为内容制作商证明内容收视品质。',
                '支持：不同属性用户的收视喜好偏向调整制作内容类型，为内容制作商生产内容提供数据支持。',
                '对比 : 不同类型OTT端视频内容在各媒体的收视差异，为内容制作商选择内容播放渠道提供决策依据。'
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