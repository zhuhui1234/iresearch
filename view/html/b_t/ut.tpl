<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UserTracker<</title>
    <link rel="shortcut icon" href="//data.iresearch.com.cn/images/favicon.ico"
          mce_href="//data.iresearch.com.cn/images/favicon.ico" type="image/x-icon">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <!-- IE 兼容模式 -->
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=9;IE=EDGE">
    <!-- 国产浏览器高速模式 -->
    <meta name="renderer" content="webkit">
    <!-- bootstrap核心样式 -->
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link href="//data.iresearch.com.cn/css/bootstrap.min.css" rel="stylesheet">
    <link href="./public/css/b_t/index.css" rel="stylesheet">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="//data.iresearch.com.cn/js/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="//data.iresearch.com.cn/js/bootstrap.min.js"></script>
    <script src="//cdn.bootcss.com/vue/2.5.16/vue.min.js"></script>
</head>
<body>
<script>
    var IRS_pageId = 'iRView'; // 艾瑞睿见
</script>
<script src="//data.iresearch.com.cn/js/IRS_index_head_html.js"></script>
<div id="app" :class="productName">
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-6">
                    <img class="img" :src="productHeader.img">
                </div>
                <div class="col-md-6 col-md-pull-6" id="title">
                    <div class="title">[[productHeader.title ]]</div>
                    <div class="desc">
                        [[productHeader.desc ]]
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="row" id="adnavs">
                    <div class="col-md-4" v-for="item in productHeader.productList" :key="item.name">
                        <a :href="item.link" class="ad-box">
                            <span class="icon"><img :src="item.icon"></span>
                            <span class="span">
                  [[item.title ]]<br />[[item.name ]]
                </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="vtuv introduce" :class="index%2 === 0 ? '' : 'gray'" v-for="(item, index) in productInfo" :key="index">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="col-sm-12"><img class="img" :src="item.img"></div>
                    <div class="col-sm-12"><img class="logo" :src="item.logo"></div>
                </div>
                <div class="col-md-9" v-for="sub in item.item" :key="sub.title">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 class="title" :class="productName">[[sub.title ]]</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12" v-for="list in sub.list" :key="list.title">
                            <ul class="list-group">
                                <li class="list-group-item">[[list.title ]]</li>
                                <li class="list-group-item">
                                    <span class="dot" :class="productName"></span>
                                    <span class="info">[[ list.desc ]]</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-xs-12">
                            <a class="link" :href="item.jumpList.base.link">
                                [[item.jumpList.base.title ]]
                            </a>
                        </div>
                        <div class="col-md-2 col-xs-12" v-for="(links, index) in item.jumpList.old" :key="index">
                            <a class="old-link" :href="links.link">[[links.title ]]</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://data.iresearch.com.cn/js/IRS_index_foot_html.js"></script>
<script></script>
<script>
    <!-- IF token=="1" -->
    var ut_beta_url = "?m=user&a=login&cb=ut";
    var ut_beta = "登录使用";
    var apply_iut = "";
    var apply_iut_en = "";
    var apply_mut = "";
    var apply_mut_en = "";

    <!-- ELSE -->
    var ut_beta_url = "?m=user&a=jump&pro=48";
    var ut_beta = '{apply_beta_iut}';
    var apply_iut = '{apply_iut}';
    var apply_iut_en = '{apply_iut_en}';
    var apply_mut = '{apply_mut}';
    var apply_mut_en = '{apply_mut_en}';
    <!-- ENDIF -->



    var app = new Vue({
        el: '#app',
        delimiters: ["[[", "]]"],
        data: {
            productName: 'ut',
            productHeader: {
                title: 'UserTracker 第三方网民网络行为监测',
                desc: 'UserTracker为艾瑞自主研发的网民网络行为监测系统，包含PC、Mobile 两端网民网络行为监测数据。 UserTracker产品自2007年开始，基于亿级PC及移动样本行为数据采集，获取中国网民网站浏览、软件使用、APP打开等行为数据，并通过海量数据分析建立了多个用户行为指标，真实反映中国PC及移动互联网市场客观情况。',
                img: './public/img/b_t/UT.png',
                productList: [
                    {
                    title: '标准版',
                    name: 'UserTracker',
                    icon: './public/img/b_t/standard.png',
                    link: '?m=user&a=jump&pro=48'
                    },
                    {
                        title: '移动APP指数',
                        name: 'Mobile App Index',
                        icon: './public/img/b_t/move.png',
                        link: '//index.iresearch.com.cn/app'
                    },
                    {
                        title: 'PC Web指数',
                        name: 'PC Web Index',
                        icon: './public/img/b_t/PC.png',
                        link: '//index.iresearch.com.cn/pc'
                    }
                ]
            },
            productInfo: [{
                img: './public/img/b_t/utbg2.png',
                logo: './public/img/b_t/UserTracker@3x.png',
                item: [{
                    title: '产品价值',
                    list: [{
                        title: '互联网公司',
                        desc: '帮助互联网公司掌握自身与竞品网站、APP流量变化，及时了解行业格局变化，优化自身产品运营。'
                    },
                        {
                            title: '投资者及分析师',
                            desc: '帮助投资者及分析师在财报发布前及时了解网站及APP流量变化，为投资决策提供有效支持。'
                        },
                        {
                            title: '广告公司及广告主',
                            desc: '帮助广告公司及广告主了解不同细分领域网站及APP格局变化，不同品牌目标人群网站及APP访问习惯差异，优化网络媒体投放方案。'
                        }
                    ]
                }],
                jumpList: {
                    base: {
                        title: ut_beta,
                        link: ut_beta_url
                    },
                    old: [
                        {
                            title: apply_iut,
                            link: '{iut_oldurl}'
                        },
                        {
                            title: apply_iut_en,
                            link: '{iut_oldurl_en}'
                        },
                        {
                            title: apply_mut,
                            link: '{mut_oldurl}'
                        },
                        {
                            title: apply_mut_en,
                            link: '{mut_oldurl_en}'
                        }
                    ]
                }
            }]
        }
    })
</script>
</body>
</html>
