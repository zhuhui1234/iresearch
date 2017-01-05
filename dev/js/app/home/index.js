define(['helper', 'app/main'], function (Helper) {
    $(function () {
        $('#nav_home').addClass('active');
        Helper.nav();
    });

    $("#bindingIRDA").submit(function (_event) {
        // console.log(_event);
        $("#binding_irda_error").hide();
        var getData = {
            "mail": $("#irda_email").val(),
            "pwd": $("#irda_pwd").val()
        }

        if ($.trim(getData.mail) == '' || $.trim(getData.mail) == null || $.trim(getData.pwd) == '' || $.trim(getData.pwd) == null) {
            $("#binding_irda_error").show();
        } else {
            Helper.post('bindIRDA', {data: getData}, function (ret) {

                alert('绑定成功');
                $("#myModal").modal("hide");
            }, function (errRet) {
                console.log(errRet);
                $("#binding_irda_error").show();
            });
        }
    });
});