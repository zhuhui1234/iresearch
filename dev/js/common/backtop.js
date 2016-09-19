define(['jquery', 'lazyload'], function($) {
    console.log('Module backtop.init loaded.');
    function b(){
        h = $(window).height();
        t = $(document).scrollTop();
        if(t > h){
            $('.gotop').fadeIn('fast').css("display","block");
        }else{
            $('.gotop').fadeOut();
        }
    }
    $(window).scroll(function(e){
        b();
    });
    $('.gotop').click(function (e) {
        e.preventDefault();
        $('html,body').animate({ scrollTop:0},300);
    });
});