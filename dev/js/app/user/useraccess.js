/**
 * user access detail
 */
define(['jquery','vue'],function($,Vue){

    var vm = new Vue({
        // 选项
    });

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