/**
 * Created with JetBrains PhpStorm.
 * User: david
 * Date: 16-9-20
 * Time: 上午11:38
 * To change this template use File | Settings | File Templates.
 */
define(['jquery'], function () {
    //默认展示
    if ($("#frameReport").attr("default") !== "") {
        console.log("default show ");
        var url = $("#frameReport").attr("default");
        showReport(url);
    }
    else{
        $(".loading-report").html("暂无数据");
    }
    $("._showReport").click(function () {
        $(".show-report").hide();
        $(".loading-report").show();
        var url = $(this).attr("cfg_url");
        showReport(url);
    });
    $("#frameReport").load(function () {
        var mainheight = $(document).height() - 160;
        $(this).height(mainheight);
        setTimeout(function(){
                $(".loading-report").hide();
                $(".show-report").show();
            }, 1000);
    });
    function showReport(url) {
        var urlInfo = url.split("=");
//        console.log(urlInfo);
        var rs = setReport(urlInfo[3]);
        if (rs) {
            $("#frameReport").attr("src", url);

        }
    }
    function setReport(guid) {
        var rs = false;
        var url = '?m=service&a=upUserSessionKey';
        var guid = guid;
        $.ajax({
            async: false,
            type: 'POST',
            data: {"guid": guid},
            url: url,
            success: function (res) {
                rs = true
            }
        });
        return rs;
    }
});