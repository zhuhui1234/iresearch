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
            }


        })
        .fail(function (errRet) {
            console.log(errRet);
        })
});

$("#searchBtn").click(function(){
    console.log('a');
    window.location.href='?m=index&a=xvtSearch&key='+$("#searchKey").val()
});