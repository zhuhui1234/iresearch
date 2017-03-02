define(['helper', 'app/main'], function (Helper) {
    $(function () {
        $('#'+Helper.getQuery("active_menu")).addClass('active');
        Helper.nav();

        //render
        jQuery(function ($) {
            var topBar = 65;
            var innerHeight = window.innerHeight;
            console.log(innerHeight);
            var $frame = $('iframe:eq(0)');
            $frame.css('height',innerHeight-topBar);
            $frame.css('min-height',700-topBar);
            $('body').css('overflow-y','hidden');
            $(window).resize(function(){
                $frame.css('height',window.innerHeight-topBar);
                $('body').css('overflow-y','hidden');
            });
        });
    });
});