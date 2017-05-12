define(['helper', 'app/main'], function (Helper) {
    $(function () {
        // $('.navbar').css('margin-bottom', 0);
        // $('footer').css('margin-top', 0);
        // $('#iRView').addClass('active');
        // Helper.nav();

        //render
        jQuery(function ($) {
            var topBar = 70;
            var innerHeight = window.innerHeight;
            console.log(innerHeight);
            var $frame = $('iframe:eq(0)');
            $frame.css('height','100%');
            $frame.css('min-height',innerHeight);
            $('body').css('overflow-y','hidden');
            $(window).resize(function(){
                $frame.css('height',window.innerHeight-topBar);
                $('body').css('overflow-y','hidden');
            });
        });
    });
});