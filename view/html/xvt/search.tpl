<!DOCTYPE html>
<html lang="utf-8">

<head>
    <meta charset="utf-8">
    <title>艾瑞数据 - 数据改变认知 提升企业效能</title>
    <meta name="keywords" content="艾瑞数据,艾瑞指数,艾瑞睿见,艾瑞智云">
    <meta name="description"
          content="艾瑞数据，是艾瑞互联网大数据服务平台，基于15年互联网的研究积累，致力于数据改变认知、提升企业效能，为客户提供基于情报+数据+服务的多元化大数据解决方案，服务涵盖市场竞争监测、消费者洞察、营销决策、企业精细化运营及数据共享等业务。">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"/>
    <!-- <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no"> -->
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
    <link href="https://cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/xvt/header.css?234"/>
    <link rel="stylesheet" href="public/css/xvt/search.css"/>
</head>

<body>
<div class="Topbar">
    <div class="container">
        <div class="links"><a href="//group.iresearch.com.cn/" target="_blank">艾瑞集团</a>|<a
                    href="//www.iresearch.com.cn/" target="_blank">艾瑞咨询</a>|
            <a href="//data.iresearch.com.cn/" target="_blank">艾瑞数据</a>|<a href="//capital.iresearch.com.cn/"
                                                                                target="_blank">艾瑞资本</a> |
            <a href="//www.iresearch.cn/" target="_blank">艾瑞网</a>|<a href="//events.iresearch.cn/"
                                                                          target="_blank">艾瑞活动</a>|
            <a href="//www.iresearchchina.com/" target="_blank">English</a>
        </div>
    </div>
</div>

<!--导航-->
<!-- INCLUDE nav.tpl -->
<!--导航 end-->
<div class="container" id="search">
    <h5 class="bread"><span class="ivu-icon ivu-icon-chevron-left" aria-hidden="true"></span> <a href="?m=index&a=xvt">返回视频内容首页</a></h5>
    <div class="search-content">
        <h3>视频内容搜索结果</h3>
        <div class="input-group input-group-lg">
            <input v-model="searchVal" class="form-control" placeholder="请输入视频内容查询" @keyup.enter="searchBtn(searchVal)">
            <span class="input-group-btn" @click="searchBtn(searchVal)">
          <button class="btn btn-default" type="button">
          <span class="ivu-icon ivu-icon-search"></span>
        </button>
        </span>
        </div>
    </div>
    <div class="menu">
        <ul>
            <!-- <li>
                <Radio-group v-model="dateTypeVal" type="button" @on-change="changeDateType">
                    <Radio v-for="date in dateTypeItem" :label="date.value" :value="date.value" :key="date.value"
                           v-cloak>[[ date.label ]]
                    </Radio>
                </Radio-group>
            </li> -->
            <li>
                <i-select v-model="dateVal" style="width:150px" @on-change="changeDate">
                    <i-option v-for="item in dateList" :value="item.data_value" :key="item.data_value"
                              :label="item.label" v-cloak>[[ item.label ]]
                    </i-option>
                </i-select>
            </li>
            <li>指标:</li>
            <li>
                <i-select v-model="indexVal" style="width:150px" @on-change="changeIndex">
                    <i-option v-for="item in indexItem" :value="item.value" :key="item.value" :label="item.label"
                              v-cloak>[[ item.label ]]
                    </i-option>
                </i-select>
            </li>
            <li>频道:</li>
            <li>
                <i-select v-model="channelVal" style="width:150px" @on-change="changeChannel">
                    <i-option v-for="item in channelItem" :value="item.value" :key="item" v-cloak>[[ item.label ]]
                    </i-option>
                </i-select>
            </li>
            <li>
                <i-button type="primary" @click="exportData">导出数据</i-button>
            </li>
        </ul>
    </div>
    <div class="table-content">
        <i-table v-show="!loading" :columns="columns" :data="table" ref="table"></i-table>
        <Spin size="large" fix v-if="loading"></Spin>
    </div>
</div>
<script src="//data.iresearch.com.cn/js/jquery.min.js"></script>
<script src="//data.iresearch.com.cn/js/bootstrap.min.js"></script>
<link href="public/css/xvt/iview.css" rel="stylesheet">
<script src="https://cdn.bootcss.com/vue/2.3.4/vue.min.js"></script>
<script src="https://cdn.bootcss.com/iview/2.0.0-rc.18/iview.min.js"></script>
<script src="public/js/header.js"></script>
<script>
    var getQuery = function (name) {
        'use strict';
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) {
            return unescape(encodeURIComponent(r[2]));
        }
        return null;
    };
    new Vue({
        delimiters: ["[[", "]]"],
        el: '#search',
        data: {
            loading: false,
            searchVal: decodeURIComponent(getQuery('key')),
            dateTypeVal: 'month',
            dateTypeItem: [{
                value: 'month',
                label: '月'
            },
                {
                    value: 'weekly',
                    label: '周'
                },
                {
                    value: 'daily',
                    label: '日'
                }
            ],
            indexItem: [{
                value: 'uv',
                label: '设备数'
            },
                {
                    value: 'pv',
                    label: '播放量'
                },
                {
                    value: 'playtime',
                    label: '播放时长'
                }
            ],
            channelItem: [{
                value: 'all',
                label: '全部'
            },
                {
                    value: '电影',
                    label: '电影'
                },
                {
                    value: '电视剧',
                    label: '电视剧'
                },
                {
                    value: '综艺',
                    label: '综艺'
                },
                {
                    value: '动漫',
                    label: '动漫'
                }
            ],
            indexVal: 'uv',
            channelVal: 'all',
            dateList: [],
            dateVal: '',
            table: [],
            columns: [{
                type: 'index',
                width: 80,
                align: 'center',
                title: '序号'
            }, {
                align: 'left',
                width: 340,
                title: '视频内容',
                key: 'tv_name',
            }, {
                align: 'left',
                width: 90,
                title: '频道',
                key: 'channel'
            }, {
                align: 'right',
                title: '合计',
                width: 140,
                key: 'sum',
                sortable: true
            }, {
                align: 'right',
                title: '移动端',
                key: 'mvt',
                sortable: true,
                render: function (el, data) {
                    if (data.row.hasToken) {
                        return el('Button', {
                            props: {
                                type: 'text',
                                size: 'small'
                            },
                            style: {
                                marginRight: '5px'
                            },
                            on: {
                                click: function () {
                                    location.href = data.row.mvtURL;
                                }
                            }
                        }, data.row.mvt)
                    } else {
                        return data.row.mvt;
                    }
                }
            }, {
                align: 'right',
                title: 'PC端',
                key: 'ivt',
                sortable: true,
                render: function (el, data) {
                    if (data.row.hasToken) {
                        return el('Button', {
                            props: {
                                type: 'text',
                                size: 'small'
                            },
                            style: {
                                marginRight: '5px'
                            },
                            on: {
                                click: function () {
                                    location.href = data.row.ivtURL;
                                }
                            }
                        }, data.row.ivt)
                    } else {
                        return data.row.ivt;
                    }
                }
            }, {
                align: 'right',
                title: 'OTT端',
                key: 'ovt',
                sortable: true,
                render: function (el, data) {
                    if (data.row.hasToken) {
                        return el('Button', {
                            props: {
                                type: 'text',
                                size: 'small'
                            },
                            style: {
                                marginRight: '5px'
                            },
                            on: {
                                click: function () {
                                    location.href = data.row.ovtURL;
                                }
                            }
                        }, data.row.ovt)
                    } else {
                        return data.row.ovt;
                    }
                }
            }],
            count: 0
        },
        created() {
            this.fetchDate()
        },
        methods: {
            fetchDate: function () {
                var self = this;
                var params = {
                    type: self.dateTypeVal
                }
                $.ajax({
                    url: '//localhost/xmpapi/public/api/xvt/getDate',
                    type: 'POST',
                    data: JSON.stringify(params),
                    dataType: 'json',
                    success: function (res) {
                        self.dateList = res.data;
                        self.dateVal = res.data[0].data_value;
                        if (self.dateVal) {
                            self.fetchTable();
                        }
                    }
                })
            },
            fetchTable: function () {
                var self = this;
                self.loading = true;
                var params = {
                    keyWord: self.searchVal,
                    dateZone: self.dateTypeVal,
                    date: self.dateVal,
                    key: self.indexVal,
                    channel: self.channelVal,
                    orderBy: 'desc',
                    orderKey: 'mvt'
                }
                self.table = [];
                $.ajax({
//                    url: '//localhost/xmpapi/public/api/xvt/search',
                    url: '//localhost/iData/?m=index&a=xvtSearchAPI',
                    type: 'POST',
                    data: JSON.stringify(params),
                    dataType: 'json',
                    success: function (res) {
                        self.table = res.data;
                        self.loading = false;
                    }
                })
            },
            changeDateType: function (val) {
                var self = this;
                self.dateTypeVal = val;
                var params = {
                    type: self.dateTypeVal
                }
                $.ajax({
                    url: '//localhost/xmpapi/public/api/xvt/getDate',
                    type: 'POST',
                    data: JSON.stringify(params),
                    dataType: 'json',
                    success: function (res) {
                        self.dateList = res.data;
                        self.dateVal = res.data[0].data_value;
                    }
                })
            },
            searchBtn: function (val) {
                this.searchVal = val;
                this.fetchDate();
            },
            changeDate: function (val) {
                this.dateVal = val;
                this.count++;
                if (this.count > 1) {
                    this.fetchTable();
                }
            },
            changeIndex: function (val) {
                this.indexVal = val;
                this.fetchTable();
            },
            changeChannel: function (val) {
                this.channelVal = val;
                this.fetchTable();
            },
            exportData: function () {
                this.$refs.table.exportCsv({
                    filename: this.searchVal,
                    columns: this.columns.splice(this.columns[0], 1)
                });
            }
        }
    })
</script>
</body>

</html>