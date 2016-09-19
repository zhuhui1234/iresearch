define(['jquery','bootstrap'], function() {
    console.log('Module popover loaded.');
    $(function () {
        $('[data-toggle="popover"]').popover();
    });
});