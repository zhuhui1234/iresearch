define(['jquery'], function() {
    console.log('Module siderbar.init loaded.');
    $(function(){
        // === Sidebar navigation === //
        $('.submenu > a').click(function(e){
            e.preventDefault();
            var li = $(this).parent();
            var ul = $(this).siblings();
            $(this).parent().toggleClass("open");
            if($(li).hasClass("open")){
                ul.stop().slideDown('fast');
            }else {
                ul.stop().slideUp('fast');
            }
            $(this).parent().siblings().removeClass("open").find("ul").slideUp('fast');
        });
        $('.left-menu > a').click(function(e){
            e.preventDefault();
            $(this).toggleClass('active');
            if($(this).hasClass('active')){
                $('.sidebar').addClass('show');
                $('.wrap').addClass('active');
            }else {
                $('.sidebar').removeClass('show');
                $('.wrap').removeClass('active');
            }
        });
    });
});