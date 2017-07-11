/**
 * Created by robinwong51 on 07/07/2017.
 */

$(".binding").click(function () {
    console.log('binding');
    var data = {
        "data": {
            "account": $("#name").val(),
            "password": $("#ps").val()
        }
    };
    var getQueryString = function (name) {
        'use strict';
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) {
            return unescape(r[2]).toLowerCase();
        }
        return null;
    };

    $.ajax({
        url: "?m=user&a=bindingIRDA",
        method: "POST",
        dataType: "json",
        data: data
    })
        .done(function (ret) {
            console.log(ret);
            if (ret.resCode == "000000") {
                alert("绑定成功");
                $("#myModal").modal('hide');
                location.reload();
            } else {
                alert("绑定失败");
                location.reload();
            }


        })
        .fail(function (errRet) {
            console.log(errRet);
        })
});

$("#searchBtn").click(function(){
    window.location.href='?m=index&a=xvtSearch&key='+$("#searchKey").val()
});

$("#searchKey").keypress(function (event){
    if (event.which == 13) {
        window.location.href='?m=index&a=xvtSearch&key='+$("#searchKey").val()
    }
});