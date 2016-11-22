define(['helper','app/main'], function(Helper) {
    $(function(){
        $('.navbar').css('margin-bottom',0);
        $('footer').css('margin-top',0);
        $('#nav_irv').addClass('active');
        Helper.nav();


        //render
        jQuery(function($){
            var lastHeight = 0, curHeight = 0, $frame = $('iframe:eq(0)');
            setInterval(function(){
                curHeight = $frame.contents().find('body').height();
                var noF = $(window).height();
                if ( curHeight != lastHeight ) {
                    console.log(curHeight);
                    console.log(noF);
                    if (noF > curHeight) {
                        $frame.css('height',noF + 'px');
                    }else {
                        $frame.css('height', (lastHeight = curHeight) + 'px' );
                    }
                }
            },500);
        });
    });
});