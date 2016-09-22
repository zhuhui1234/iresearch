/**
 * user login js
 */
define(['jquery','helper','validator', 'WxLogin'], function ($,Helper) {

    //loading QRCode

    $().ready(function () {
            var obj = new WxLogin({
                id: "wxLogin",
                appid: "wxd96928ba062cffec",
                scope: "snsapi_login",
                redirect_uri: "http%3a%2f%2firv.iresearch.com.cn%2fiResearchDataWeb%2f%3fm%3duser%26a%3dwxLoginAPI",
                state: "suiJi",
                style: "",
                href: ""
            });
        }
    );



});