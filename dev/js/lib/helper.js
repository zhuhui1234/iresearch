/**
 * lib/Helper
 * Created by robinwong51 on 9/14/16.
 */
define(["api", "WxLogin", "jquery"], function (api) {
        "use strict";
        function Helper() {
            /**
             * get
             * @param apiName
             * @param data
             * @param done_func
             * @param fail_func
             * @param urlPlus
             */
            this.get = function (apiName, data, done_func, fail_func, urlPlus) {
                this.send(apiName, data, "GET", done_func, fail_func, urlPlus);
            };

            /**
             * post
             * @param apiName
             * @param data
             * @param done_func
             * @param fail_func
             * @param urlPlus
             */
            this.post = function (apiName, data, done_func, fail_func, urlPlus) {
                this.send(apiName, data, "POST", done_func, fail_func, urlPlus);
            };

            /**
             * send
             * @param apiName
             * @param data
             * @param method
             * @param done_func
             * @param fail_func
             * @param urlPlus
             */
            this.send = function (apiName, data, method, done_func, fail_func, urlPlus) {

                if (method == null || method == "" || typeof method == "undefined") {
                    method = "GET";
                }

                if (urlPlus == null || urlPlus == "" || typeof urlPlus == "undefined") {
                    urlPlus = "";
                }

                $.ajax({
                    url: api[apiName] + urlPlus,
                    method: method,
                    dataType: "json",
                    data: data
                })
                    .done(function (ret) {
                        if (typeof done_func == "function") {
                            done_func(ret);
                        }
                    })
                    .fail(function (errRet) {
                        if (typeof fail_func == "function") {
                            fail_func(errRet);
                        }
                    })
            };

            /**
             * login Yong Hong js
             *
             * @param AccessObject
             * @param jumpURL
             * @param getValue
             */
            this.loginYongHong = function (AccessObject, jumpURL, getValue) {
                this.post("loginYongHongURI", AccessObject,
                    function (ret) {
                        // res = $.parseJSON(ret);
                        location.href = jumpURL;
                    },
                    function (errInfo) {
                        console.log(errInfo)
                    }), getValue
            };


            /**
             *
             */
            this.getQueryString = function (name) {
                'use strict';
                var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
                var r = window.location.search.substr(1).match(reg);
                if (r != null) {
                    return unescape(r[2]).toLowerCase();
                }
                return null;
            };

            /**
             * get resource uri
             * @param name
             */
            this.getQuery = function (name) {
                'use strict';
                var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
                var r = window.location.search.substr(1).match(reg);
                if (r != null) {
                    return unescape(r[2]);
                }
                return null;
            };

            /**
             * weChat qr code
             * @param qrCodeID
             * @param state
             * @constructor
             */
            this.WeChatQRCode = function (qrCodeID, state,cssFileUrl,pdtID,ppName) {

                var wxURI = api.wxURI;
                console.log(typeof pdtID);

                if (typeof pdtID !== 'undefined' && pdtID !== null) {
                    if (pdtID.length > 0) {
                        wxURI = wxURI + '&pdtID=' + pdtID;
                    }
                }

                if (typeof ppName !== "undefined" && ppName !== null) {
                    if (ppName.length > 0) {
                        wxURI = wxURI + '&ppname=' + ppName;
                    }
                }

                wxURI = encodeURIComponent(wxURI);

                if (cssFileUrl == null) {
                    cssFileUrl = '';
                } else {
                    cssFileUrl = encodeURIComponent(cssFileUrl);
                }

                // console.log(wxURI);
                var obj = new WxLogin({
                    id: qrCodeID,
                    appid: "wxd96928ba062cffec",
                    scope: "snsapi_login",
                    // redirect_uri: "http%3a%2f%2fwww.iresearchdata.cn%2fiResearchDataWeb%2f%3fm%3dwechat%26a%3dwxLoginAPI",
                    redirect_uri: wxURI,
                    state: state,
                    style: "",
                    href: cssFileUrl
                });

                $('.title').remove();
            };

            this.imgServer = "http://203.156.255.168/iview_deskapi/";

            this.nav = function(){
                //导航
                var index = window.location.href.split('/').length - 1;
                var href = window.location.href.split('/')[index];
                $(".nav_con ul li a[href^='"+ href +"']").parent().addClass("active");
                var thisActive = $(".nav_con .navbar-nav li.active");
                var li_width = thisActive.outerWidth();
                var li_left = thisActive.position().left;
                $(".nav_con .line").css({width:li_width,left:li_left}).bind('mouseover', function (evt) {
                    this.style.display = 'none';
                    var x = evt.pageX, y = evt.pageY,
                        under = document.elementFromPoint(x, y);
                    this.style.display = '';
                    evt.stopPropagation();
                    evt.preventDefault();
                    $(under).trigger(evt.type);
                });
                var isHover = false;
                $(".nav_con .nav_active").hover(function(){
                    var li_width = $(this).outerWidth();
                    var li_left = $(this).position().left;
                    isHover = true;
                    var thisIndex = $(this).index();
                    $(".nav-bg").stop().slideDown(200);
                    $(".dropdown-list > li").eq(thisIndex).show().siblings().hide();
                    $(".nav_con .line").stop().animate({width:li_width,left:li_left},300);
                },function () {
                    isHover = false;
                    setTimeout(function() {
                        if (!isHover) {
                            $(".nav-bg").stop().slideUp(200);
                            $(".nav_con .line").stop().animate({width:li_width,left:li_left},300);
                        }
                    }, 10);
                });
                $(".nav-bg").hover(function() {
                    isHover = true;
                }, function() {
                    isHover = false;
                    $(".nav-bg").stop().slideUp(200);
                    $(".nav_con .line").stop().animate({width:li_width,left:li_left},300);
                });
                $(".tab-menu li a").hover(function(){
                    var thisIndex = $(this).parent().index();
                    $(this).parent().addClass("active").siblings().removeClass("active");
                    $(this).parents(".col-xs-3").siblings(".col-xs-9").find("li").eq(thisIndex).show().siblings().hide();
                });
                //焦点图
                var rightHeight = $(".focus-main-right").height();
                $(".focus-main-left").css("height",rightHeight);
                $(".focus-main-right ul li a").on('click',function(e){
                    e.preventDefault();
                    $(this).parent().addClass("active").siblings().removeClass("active");
                    var thisIndex = $(this).parent().index();
                    $(".focus-main-left ul li").eq(thisIndex).stop().fadeIn(200).addClass("active").siblings().stop().fadeOut(200).removeClass("active");
                });
            };

        }

        return new Helper();
    }
);