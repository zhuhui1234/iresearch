define(['helper', 'app/main'], function (Helper) {
    $(function () {
        $('#nav_home').addClass('active');
        Helper.nav();
    });

    $($('.product-title>h3')[1]).html('跨屏媒介效果评估(MUT媒介版)');

    $("#bindingIRDA").submit(function (_event) {
        // console.log(_event);
        $("#binding_irda_error").hide();
        var getData = {
            "account": $("#irda_email").val(),
            "password": $("#irda_pwd").val()
        }
        // console.log(getData);
        if ($.trim(getData.account) == '' || $.trim(getData.account) == null || $.trim(getData.password) == '' || $.trim(getData.password) == null) {
            $("#binding_irda_error").show();
        } else {
            Helper.post('bindIRDA', {data: getData}, function (ret) {
                if (ret.resCode == '000000') {
                    alert('绑定成功');
                    // $('#bindingClassicIRD')[0].removeAttribute('data-target');
                    // $('#bindingClassicIRD').html('已绑定');
                    $("#myModal").hide();
                    location.reload();
                }else{
                    alert(ret.resMsg);
                }
                $("#myModal").modal("hide");
            }, function (errRet) {
                console.log(errRet);
                $("#binding_irda_error").show();
            });
        }
    });
});