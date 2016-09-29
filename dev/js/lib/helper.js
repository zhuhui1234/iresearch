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


            this.WeChatQRCode = function (qrCodeID, state) {
                var obj = new WxLogin({
                    id: qrCodeID,
                    appid: "wxd96928ba062cffec",
                    scope: "snsapi_login",
                    redirect_uri: "http%3a%2f%2firv.iresearch.com.cn%2fiResearchDataWeb%2f%3fm%3duser%26a%3dwxLoginAPI",
                    state: state,
                    style: "",
                    href: ""
                });
            };

        }

        return new Helper();
    }
);