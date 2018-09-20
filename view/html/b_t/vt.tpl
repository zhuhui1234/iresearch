<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VideoTracker</title>
    <link rel="shortcut icon" href="//data.iresearch.com.cn/images/favicon.ico"
          mce_href="//data.iresearch.com.cn/images/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <!-- IE 兼容模式 -->
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
                    <div class="title">[[ productHeader.title ]]</div>
                    <div class="desc">
                        [[ productHeader.desc ]]
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="row" id="adnavs">
                    <div class="col-md-6" v-for="item in productHeader.productList" :key="item.name">
                        <a :href="item.link" class="ad-box" v-on:click="jumpDialog(item)">
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
                                    <span class="info">[[ list.desc ]]</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-xs-12" id="VT">
                            <a class="link" :href="item.jumpList.base.link" v-on:click="jumpDialog(item.jumpList.base)">
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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm custom-dialog" :class="productName" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">提示</h4>
                </div>
                <div class="modal-body">
                    上线准备中
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://data.iresearch.com.cn/js/IRS_index_foot_html.js"></script>
<script></script>
<script>
    <!-- IF token=="1" -->
    var vt_beta_url = "?m=user&a=login&cb=vt";
    var status = 1;
    var vt_beta = "登录使用";
    var apply_ivt = "";
    var apply_beta_ivt = "";
    var apply_mvt = "";
    var apply_ovt = "";

    <!-- ELSE -->
    var vt_beta = "标准版";
    var status = 0;
    var vt_beta_url = "#";
    var apply_ivt = '{apply_ivt}';
    var apply_beta_ivt = '{apply_beta_ivt}';
    var apply_mvt = '{apply_mvt}';
    var apply_ovt = '{apply_ovt}';
    <!-- ENDIF -->
    console.log(status);
    console.log(typeof status);

    var app = new Vue({
        el: '#app',
        delimiters: ["[[", "]]"],
        data: {
            productName: 'vt',
            productHeader: {
                title: 'VideoTracker 第三方视频内容监测',
                desc: '艾瑞睿见VT系列产品包括移动端、OTT端和PC端视频内容监测产品，完成对家庭跨屏视频内容受众收视行为的全景监测。提供主流视频平台不同频道、类型和产地的视频收视情况，洞察视频内容在不同平台的收视差异及行业收视热度，分析不同受众人群观看视频内容的偏好，监控视频内容在各时段的收视趋势。为视频广告媒介优化、视频内容竞争分析、视频内容制作及投资价值，提供客观、准确、快速的第三方监测分析数据。',
                img: './public/img/b_t/backgroundvt.png',
                productList: [{
                    title: '标准版',
                    name: 'VideoTracker',
                    icon: './public/img/b_t/criterion.png',
                    status: 0
                },
                    {
                        title: '网络影视指数',
                        name: 'Online Video Index',
                        icon: './public/img/b_t/OTT.png',
                        link: '//index.iresearch.com.cn/Video',
                        status: 1
                    }
                ]
            },
            productInfo: [{
                img: './public/img/b_t/vtbg3.png',
                logo: './public/img/b_t/vtPC.png',
                item: [{
                    title: '产品价值',
                    list: [{
                        title: '视频媒体',
                        desc: '帮助视频媒体了解视频内容热点变化，优化对方可视频推荐策略。掌握竞争媒体市场份额差异、收视人群变化。'
                    },
                        {
                            title: '广告公司及广告主',
                            desc: '帮助广告公司及广告主了解各类视频内容的用户覆盖能力，了解目标人群的视频内容收视偏好，为视频广告投放提供决策数据。'
                        },
                        {
                            title: '视频内容制作商',
                            desc: '帮助视频内容制作商了解用户对不同题材视频的收视偏好，跟踪监测发行视频的流量变化。'
                        }
                    ]
                }],
                jumpList: {
                    base: {
                        title: vt_beta,
                        link: vt_beta_url,
                        status: status
                    },
                    old: [
                        {
                            title: apply_ivt,
                            link: '?m=user&a=jump&pro=45'
                        },
                        {
                            title: apply_beta_ivt,
                            link: '{ivt_oldurl}'
                        },
                        {
                            title: apply_mvt,
                            link: '?m=user&a=jump&pro=18'
                        },
                        {
                            title: apply_ovt,
                            link: '?m=user&a=jump&pro=19'
                        }
                    ]
                }
            }]
        },
        methods: {
            jumpDialog: function (item) {
                console.log(typeof item.status);
                if (item.status == 0) {
                    $('#myModal').modal('show')
                }
            }
        }
    })
</script>
</body>
</html>