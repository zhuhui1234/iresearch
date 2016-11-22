/**
 * user access detail
 */
define(['jquery','vue','helper'],function($,Vue,helper){

    var vm = new Vue({
        // 选项
    });

    $('.setStatus').click(function(){
        helper.post('setState',{'operation':1,'u_account':$('.user_account').html()},function(ret){
            console.log(ret);
        });
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