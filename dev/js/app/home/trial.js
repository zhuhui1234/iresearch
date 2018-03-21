define(['helper', 'app/main'], function (Helper) {
    $(function () {
        // $('.navbar').css('margin-bottom', 0);
        // $('footer').css('margin-top', 0);
        // $('#iRView').addClass('active');
        // Helper.nav();

        $("#applyToTrial").click(function () {
            var pData = {
                "companyName": $("#company").val(),
                // "mobile" : $("#mobile").val(),
                "menuID": Helper.getQuery('menuID'),
                "position": $("#position").val(),
                "username": $("#username").val(),
                "region": $("#city").val(),
                "city": $("#city option:selected").text(),
                "area": $("#industry option:selected").text(),
                "industry": $("#industry").val(),
                "mail":$("#mail").val(),
                "remark":Helper.getQuery('ppname')
            };
            console.log(pData);
            if (($.trim(pData.username).length <= 0) ||
                ($.trim(pData.companyName).length <= 0) ||
                ($.trim(pData.position).length <= 0) ||
                ($.trim(pData.menuID).length <= 0) ||
                ($.trim(pData.mail).length <= 0) ||
                ($.trim(pData.region).length <= 0 && pData.region == '0') || pData.industry == '0') {
                alert("必填项不能为空")
            } else {
                Helper.post("trialApply", {data: pData}, function (ret) {
                    console.log(ret);
                    if (ret.resCode == "20000") {
                        alert("申请成功,如果您之前并不是艾瑞的正式企业客户，系统将会发送一份认证邮件，请完成邮箱认证后，系统才会正式提交试用申请！");
                        //window.location.href = "?m=index&a=index";
                    } else {
                        alert(ret.resMsg);
                    }
                });
            }


        });
    });
});