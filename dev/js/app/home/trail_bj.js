define(['helper', 'app/main'], function (Helper) {
    var height = window.innerHeight || (document.documentElement && document.documentElement.clientHeight) ||
        document.body.clientHeight;
    var width = window.innerWidth || (document.documentElement && document.documentElement.clientWidth) ||
        document.body.clientWidth;
    $(".main-image").css({
        height: height
    });
    $(".main").css({
        height: height
    });
    console.log(width);
    if(width >= 1099){
        var bodyH = (height-634)/2
        $("#jumbotron").css({"height":height+"px","padding-top":bodyH+"px","padding-bottom":bodyH+"px"});
    }
    $(".main_left_line_input").click(function(){
        $(".main_left_line_input").css('border-color', '#EEEEEE');
        $(this).css('border-color', '#69C72B');
    });

    $(function () {

        $("#applyToTrial").click(function () {
            var pData = {
                "companyName": $("#company").val(),
                // "mobile" : $("#mobile").val(),
                "menuID": Helper.getQuery('menuID'),
                "position": $("#job").val(),
                "username": $("#name").val(),
                "region": $("#city").val(),
                "city": $("#city option:selected").text(),
                "area": $("#industry option:selected").text(),
                "industry": $("#industry").val(),
                "mail":$("#mail").val(),
                "remark":$("#ppname").text(),
                "vCode": $("#code").val()
            };
            console.log(pData);
            if (($.trim(pData.username).length <= 0) ||
                ($.trim(pData.companyName).length <= 0) ||
                // ($.trim(pData.position).length <= 0) ||
                ($.trim(pData.menuID).length <= 0) ||
                ($.trim(pData.mail).length <= 0) ||
                ($.trim(pData.region).length <= 0 && pData.region == '0') || pData.industry == '0') {
                alert("必填项不能为空")
            } else {
                Helper.post("trialApply", {data: pData}, function (ret) {
                    console.log(ret);
                    if (ret.resCode == "20000") {
                        alert("申请成功,我们的销售人员会在两个工作日之内联系您！");
                        window.location.href = "?m=index&a=index";
                    } else {
                        alert(ret.resMsg);
                    }
                });
            }


        });
    });

    $('#charCode').click(function () {
        $(this).attr('src', '?m=service&a=charCode&' + Math.random());
    });
});