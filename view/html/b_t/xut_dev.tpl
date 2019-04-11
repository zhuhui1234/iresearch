<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UserTracker</title>
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
    <link href="./public/css/b_t/index.css?v5" rel="stylesheet">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="//data.iresearch.com.cn/js/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="//data.iresearch.com.cn/js/bootstrap.min.js"></script>
    <script src="//irv.iresearch.com.cn/iResearchDataWeb/public/js/vue.min.js"></script>
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
                        <div class="video">
                            <a :href="productHeader.video_link">
                            <span>[[ productHeader.video ]]</span>
                           <img :src="productHeader.videoImg"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="row" id="adnavs">
                    <div class="col-md-4" v-for="item in productHeader.productList" :key="item.name">
                        <a :href="item.link" class="ad-box"  v-on:click="jumpDialog(item)">
                            <span class="icon"><img :src="item.icon"></span>
                            <span class="span">
                                [[item.title ]]<br />[[item.name ]]
                            </span>
                            <span class="mark" v-if="item.free">
                              <i>FREE</i>
                            </span>
                            <span class="mark new" v-if="item.new">
                              <i>NEW</i>
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
                    <div class="row" v-if="osType() !== 'mobile'">
                        <!-- IF token=="1" -->
                        <div class="col-md-3 col-xs-12" v-for="(links, index) in item.jumpList.old" :key="index" v-if="links.title !== '' ">
                            <a class="link" :href="links.link"  >[[links.title ]]</a>
                        </div>
                        <!-- ELSE -->
                        <div class="col-md-3 col-xs-12" v-for="(links, index) in item.jumpList.old" :key="index" v-if="links.title !== '' ">
                            <a class="link" :href="links.link"  >[[links.title ]]</a>
                        </div>
                        <div class="col-md-2 col-xs-12" v-for="(b_l, b_in) in item.jumpList.base" :key="b_in" v-if="b_l.title !== ''">
                            <a class="old-link" :href="b_l.link">
                                [[b_l.title ]]
                            </a>
                        </div>
                        <!-- ENDIF -->
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
                    移动版上线准备中
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://data.iresearch.com.cn/js/IRS_index_foot_html.js"></script>
<script></script>
<script>
    $(function(){
        <!-- IF token=="1" -->
        var ut_beta_url = "?m=user&a=login&cb=ut";
        var ut_beta = "";
        var apply_iut = "登录使用";
        var ut_beta = "登录使用";
        var iut_oldurl = "?m=user&a=login&cb=ut";
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
        var iut_oldurl = '{iut_oldurl}';
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
                    video: '观看产品视频',
                    videoImg: './public/img/b_t/play_icon.png',
                    video_link: '?m=index&a=video_manual&cb=ut_video',
                    productList: [
                        {
                            title: '网络行为监测',
                            name: 'UserTracker(BETA)',
                            icon: './public/img/b_t/ut@2x.png',
                            link: '?m=user&a=jump&pro=48',
                            new:true
                        },
                        {
                            title: '移动APP指数',
                            name: 'Mobile App Index',
                            icon: './public/img/b_t/move.png',
                            link: '//index.iresearch.com.cn/app',
                            free:true
                        },
                        {
                            title: 'PC Web指数',
                            name: 'PC Web Index',
                            icon: './public/img/b_t/PC.png',
                            link: '//index.iresearch.com.cn/pc',
                            free: true
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
                        base: [
                            {
                                title: apply_iut,
                                link: iut_oldurl
                            },
                            {
                                title: apply_mut,
                                link: '{mut_oldurl}'
                            },
                            {
                                title: apply_iut_en,
                                link: '{iut_oldurl_en}'
                            },
                            {
                                title: apply_mut_en,
                                link: '{mut_oldurl_en}'
                            }
                        ],
                        old: [
                            {
                                title: ut_beta,
                                link: ut_beta_url
                            }

                        ]
                    }
                }]
            },
            methods: {
                jumpDialog: function (item) {
                    // console.log(typeof item.status);
                    if (this.osType() === 'mobile' && item.link == "#" ) {
                        $('#myModal').modal('show')
                    }
                },
                osType: function() {
                    if ((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
                        return 'mobile'
                    } else {
                        return 'pc'
                    }
                }
            },
            computed:{
                changeTitle: function() {
                    if ((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
                        this.productHeader.productList[0].title = '移动版'
                        this.productHeader.productList[0].link = '#'
                        this.productHeader.productList[1].title = '移动版'
                        this.productHeader.productList[1].link = '#'
                    }
                }
            }
        });
        app.changeTitle;
    });
</script>
</body>
</html>
