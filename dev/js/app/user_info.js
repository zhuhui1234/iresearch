define(['jquery'],function($){
    $(function(){
        $('.panel-heading').on('click',function(){
            $(this).toggleClass('arrow');
            var pb = $(this).siblings('.panel-body');
            if($(this).hasClass('arrow')){
                pb.stop().slideUp('fast');
            }else {
                pb.stop().slideDown('fast');
            }
        });
    });
});

