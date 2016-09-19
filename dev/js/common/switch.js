define(['jquery','switch'], function($) {
    console.log('Module switch.init loaded.');
    // console.log($.fn.bootstrapSwitch);
    $(function(){
        $("[data-toggle='switch']").bootstrapSwitch();
    });
});