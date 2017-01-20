/**
 * Created by Hank on 2016/12/27.
 */
define(['app/main'], function() {
    var rightHeight = $(".focus-main-right").height();
    $(".focus-main-left").css("height",rightHeight);
    $(".focus-main-right ul li a:not(.haveNotRole)").hover(function(){
        $(this).parent().addClass("active").siblings().removeClass("active");
        var thisIndex = $(this).parent().index();
        $(".focus-main-left ul li").eq(thisIndex).stop().fadeIn(200).addClass("active").siblings().stop().fadeOut(200).removeClass("active");
    },function () {

    });
});
