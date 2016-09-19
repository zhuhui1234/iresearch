define(['jquery','pjax'], function($) {
    console.log('Module pjax loaded.');
    $(function(){
        $(document).pjax('li a', '.sidebar');
    });
});