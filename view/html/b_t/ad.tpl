<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AdTracker 艾瑞咨询</title>
    <link rel="shortcut icon" href="//data.iresearch.com.cn/images/favicon.ico"
          mce_href="//data.iresearch.com.cn/images/favicon.ico" type="image/x-icon">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <!-- IE 兼容模式 -->
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=9;IE=EDGE">
    <!-- 国产浏览器高速模式 -->
    <meta name="renderer" content="webkit">
    <!-- bootstrap核心样式 -->
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <link href="//data.iresearch.com.cn/css/bootstrap.min.css" rel="stylesheet">
    <link href="./public/css/b_t/index.css?1234222342" rel="stylesheet">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="http://data.iresearch.com.cn/js/jquery.min.js?"></script>
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
                    <div class="title">[[ productHeader.title ]]</div>
                    <div class="desc">
                        [[ productHeader.desc ]]
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="row" id="adnavs">
                    <div class="col-md-4" v-for="item in productHeader.productList" :key="item.name">
                        <a class="ad-box" :href="item.link">
                            <span class="icon"><img :src="item.icon"></span>
                            <span class="span">
                  [[ item.title ]]<br />[[ item.name ]]
                </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="introduce" :class="index%2 === 0 ? '' : 'gray'" v-for="(item, index) in productInfo" :key="index">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="col-sm-12"><img class="img" :src="item.img"></div>
                    <div class="col-sm-12"><img class="logo" :src="item.logo"></div>
                </div>
                <div class="col-md-9" v-for="sub in item.item" :key="sub.title">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 class="title" :class="productName">[[ sub.title ]]</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12" v-for="list in sub.list" :key="list.title">
                            <ul class="list-group">
                                <li class="list-group-item">[[ list.title ]]</li>
                                <li class="list-group-item">
                                    <span class="dot" :class="productName"></span>
                                    [[ list.desc ]]
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-xs-12">
                            <a class="link" :href="item.jumpList.base.link">
                                [[ item.jumpList.base.title ]]
                            </a>
                        </div>
                        <div class="col-md-2 col-xs-12" v-for="(links, index) in item.jumpList.old" :key="index">
                            <a class="old-link" :href="links.link">[[ links.title ]]</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="//data.iresearch.com.cn/js/IRS_index_foot_html.js"></script>
<script src="./dev/js/move.js"></script>
<script></script>
<script>

    <!-- IF token=="1" -->
    var bt_title = "登入使用"
    var old_bt_title = "";
    <!-- ELSE -->
    <!-- IF apply=="2" -->
    var bt_title = "开始使用";
    var old_bt_title = "开始使用旧版";
    <!-- ELSE -->
    var bt_title = "申请试用";
    var old_bt_title = "";
    <!-- ENDIF -->
    <!-- ENDIF -->

    <!-- IF token=="1" -->
    var bt_title_feedad = "登入使用";
    <!-- ELSE -->
    <!-- IF adtI=="3" -->
    var bt_title_feedad = "开始使用";
    <!-- ELSE -->
    var bt_title_feedad = "申请试用";
    <!-- ENDIF -->
    <!-- ENDIF -->


    var app = new Vue({
        el: '#app',
        delimiters: ["[[", "]]"],
        data: {
            productName: 'ad',
            productHeader: {
                title: 'AdTracker 第三方竞品广告投放监测',
                desc: 'AdTracker标准版为艾瑞自主研发的网络广告投放监测系统，包含PC、Mobile、OTT三端网络广告监测数据。AdTracker产品自2001年开始通过爬虫、API及人工监测的方法监测主流500+网站、APP的品牌广告，为互联网营销市场提供竞品广告投放量及投放费用参考，真实反应中国网络广告市场客观情况。',
                img: './public/img/b_t/adbg.png',
                productList: [{
                    title: '标准版',
                    name: 'AdTracker',
                    icon: './public/img/b_t/mobile.png',
                    link: '?m=user&a=jump&pro=42'
                },
                    {
                        title: '信息流专用版',
                        name: 'AdTracker',
                        icon: './public/img/b_t/flow.png',
                        link: '?m=user&a=jump&pro=60'
                    },
                    {
                        title: '网络广告指数',
                        name: 'Online Ad Index',
                        icon: './public/img/b_t/index.png',
                        link: '//index.iresearch.com.cn/ad'
                    }
                ]
            },
            productInfo: [{
                img: './public/img/b_t/AD.png',
                logo: './public/img/b_t/ad@3x.png',
                item: [{
                    title: '产品价值',
                    list: [{
                        title: '互联网公司',
                        desc: '帮助互联网公司即时掌握竞争媒体的最新客户投放情报，指导自身媒体的地区及行业销售策略。'
                    },
                        {
                            title: '投资者及分析师',
                            desc: '帮助投资者及分析师在财报发布前及时的了解媒体网络广告收入动态，为投资决策提供有效支持。'
                        },
                        {
                            title: '广告公司及广告主',
                            desc: '帮助广告公司及广告主了解不同行业网络广告发展现状，制定合理的营销预算，参考竞品投放策略，优化三端网络媒体投放方案。'
                        }
                    ]
                }],
                jumpList: {
                    base: {
                        title: bt_title,
                        link: '?m=user&a=jump&pro=42'
                    },
                    old: [{
                        title: old_bt_title,
                        link: '{adUrl}'
                    }
                    ]
                }
            },
                {
                    img: './public/img/b_t/ad_two.png',
                    logo: './public/img/b_t/AD_icon.png',
                    item: [{
                        title: '产品价值',
                        list: [{
                            title: '互联网公司',
                            desc: '帮助互联网公司即时掌握竞争媒体信息流广告最新客户投放情报，指导自身媒体的地区及行业销售策略。'
                        },
                            {
                                title: '投资者及分析师',
                                desc: '帮助投资者及分析师在互联网公司财报发布前了解其营销广告收入动态，为投资决策提供有效支持。'
                            },
                            {
                                title: '广告公司及广告主',
                                desc: '帮助广告公司及广告主了解不同行业信息流广告发展现状，制定不同品牌的信息流营销预算，参考竞品投放策略，优化信息流媒体投放方案。'
                            }
                        ]
                    }],
                    jumpList: {
                        base: {
                            title: bt_title_feedad,
                            link: '?m=user&a=jump&pro=60'
                        }
                    }
                }]
        }
    })
</script>

</body>
</html>