/**
 * Created by robinwong51 on 9/18/16.
 */
define(["helper", "jquery"], function (helper) {
    console.log('a');
    //test report
    $("#demo").click(function () {
        // 登入Yong Hong
        helper.loginYongHong({
            "loginAccount": "admin",
            "loginPassword": "admin"
        },"?m=index&a=demo");
    });
});