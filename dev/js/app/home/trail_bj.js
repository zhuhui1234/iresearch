define(['helper', 'app/main'], function (Helper) {
    var resizeBackground = function () {
        var height = window.innerHeight || (document.documentElement && document.documentElement.clientHeight) ||
            document.body.clientHeight;
        var width = window.innerWidth || (document.documentElement && document.documentElement.clientWidth) ||
            document.body.clientWidth;
        $(".main-image").css({
            height: height
        });
        if (width >= 1099) {
            $("#industry").select2({
                width: "80%",
                minimumResultsForSearch: -1,
                placeholder: '请选择行业(必选)'
            });//启动select2
            $("#city").select2({
                width: "80%",
                minimumResultsForSearch: -1,
                placeholder: '请选择行业(必选)'
            });//启动select2
        }
        

    }

    var validateEmail = function (email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }


    $(function () {

        $(".main_left_line_input").click(function () {
            $(".main_left_line_input").css('border-color', '#EEEEEE');
            $(this).css('border-color', '#69C72B');
        });

        resizeBackground();

        window.onresize = function () {
            resizeBackground();
        };

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
                "mail": $("#mail").val(),
                "remark": $("#ppname").text(),
                "vCode": $("#code").val()
            };
            console.log(pData)
            console.log(validateEmail(pData.mail) );
            if (($.trim(pData.username).length <= 0) ||
                ($.trim(pData.companyName).length <= 0) ||
                // ($.trim(pData.position).length <= 0) ||
                ($.trim(pData.menuID).length <= 0) ||
                ($.trim(pData.mail).length <= 0) ||
                pData.vCode.length <= 0 ||
                !validateEmail(pData.mail) ||
                ($.trim(pData.region).length <= 1 && pData.region == '0') || pData.industry == '0') {
                $('.alert').css('display', 'block');
            } else {
                $('.alert').css('display', 'none');
                Helper.post("bjTrialApply", {data: pData}, function (ret) {
                    console.log(ret);
                    if (ret.resCode == "20000") {
                        alert("申请成功,我们的销售人员会在两个工作日之内联系您！");

                        switch (parseInt(pData.menuID)) {
                            case 47:
                                //vt
                                window.location.href = "?m=index&a=vt";
                                break;
                            case 42:
                                //adt
                                window.location.href = "?m=index&a=ad";
                                break;
                            case 48:
                                //ut
                                window.location.href = "?m=index&a=ut";
                                break;
                            default:
                                window.location.href = "?m=index&a=index";
                                break;
                        }
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