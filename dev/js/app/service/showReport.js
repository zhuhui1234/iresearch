/**
 * Created with JetBrains PhpStorm.
 * User: david
 * Date: 16-9-20
 * Time: 上午11:38
 * To change this template use File | Settings | File Templates.
 */
define(['jquery', 'helper'], function ($, Helper) {

    var a = $(document).height(), b = $("nav").height();
    $(".report-wrapper").css({height: a - b}), $(".report-menu ul li a").on("click", function (a) {
        a.preventDefault(), $(this).parent().toggleClass("open"), $(this).parent().hasClass("open") ? $(this).siblings().stop().slideDown("fast") : $(this).siblings().stop().slideUp("fast")
    }), $(".full-screen").on("click", function () {
        $(".report-menu").toggleClass("toggle"), $(".report-menu").hasClass("toggle") ? ($(this).find("i").removeClass("fa-times").addClass("fa-bars"), $(".report-wrapper").addClass("full")) : ($(this).find("i").removeClass("fa-bars").addClass("fa-times"), $(".report-wrapper").removeClass("full"))
    })    //默认展示
    if ($("#frameReport").attr("default") !== "") {
        var url = $("#frameReport").attr("default");
        showReport(url);
    }
    else {
        $(".loading-report").html("暂无数据");
    }
    $("._showReport").click(function () {
        $(".show-report").hide();
        $(".loading-report").html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');
        $(".loading-report").show();
        console.log($(this).attr("cfg_id"));
        //测试用，若改报告是收费的执行以下方法
        if ($(this).attr("cfg_id") === '15') {
            weiXin($(this).attr("cfg_id"));
            return;
        }
        var url = $(this).attr("cfg_url");
        $("._nowReport").html($(this).attr("cfg_name"));
        $(this).parent().children().removeClass("open");
        $(this).addClass("open");

        var nowPname = $(this).parent().parent().prev();
//        console.log(nowPname.text());
        $("._nowReportPname").html(nowPname.text());
        showReport(url);
    });
    $("#frameReport").load(function () {
        var mainheight = $(document).height() - 100;
        $(this).height(mainheight);
        setTimeout(function () {
            $(".loading-report").hide();
            $(".show-report").show();
        }, 2000);
    });
    function showReport(url) {
        var urlInfo = url.split("=");
//        console.log(urlInfo);
        //var rs = setReport(urlInfo[3]);
        //if (rs) {
            $("#frameReport").attr("src", url);

        //}
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

    function weiXin(cfg_id) {
        Helper.WeChatQRCode('wxLogin', 'viewReport_' + cfg_id);
    }
});