/**
 * Created with JetBrains PhpStorm.
 * User: david
 * Date: 16-8-25
 * Time: 下午2:21
 * To change this template use File | Settings | File Templates.
 */
define(['jquery', 'wxLogin'], function () {
    $("#login").on("click", function () {
        var url = '?m=user&a=loginAPI';
        $.ajax({
            type: 'POST',
            url: url,
            data: {"loginAccount": "admin", "loginPassword": "admin"},
            success: function (res) {
                res = $.parseJSON(res);
                var url = "?m=index&a=demo";
                location.href = url;
            }
        });
    });
   var obj = new WxLogin({
       id: "wxLogin",
       appid: "wxd96928ba062cffec",
       scope: "snsapi_login",
       redirect_uri: "http%3a%2f%2firv.iresearch.com.cn%2fiResearchDataWeb%2f%3fm%3duser%26a%3dwxLoginAPI",
       state: "suiJi",
       style: "",
       href: ""
   });
   console.log(obj);
})
