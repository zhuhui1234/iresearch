define(['jquery','bootstrap'], function() {
    console.log('Module tooltip loaded.');
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
});