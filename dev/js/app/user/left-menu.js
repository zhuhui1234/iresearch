/**
 * Created by robinwong51 on 03/01/2017.
 */
/**
 * Created by Hank on 2016/12/28.
 */
define(['app/main'],function () {
    $(function () {
        $(".user-left-menu > li > a.menu").on('click',function (e) {
            e.preventDefault();
            $(this).parent().toggleClass("open").siblings().removeClass("open");
            if($(this).parent().hasClass("open")){
                $(this).next().stop().slideDown('fast');
            }else{
                $(this).next().stop().slideUp('fast');
            }
        });
    });
});
