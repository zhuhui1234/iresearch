define(['jquery', 'radiocheck'], function($) {
    console.log('Module radiocheck.init loaded.');
    $(function(){
        // Checkboxes and Radio buttons
        $('[data-toggle="checkbox"]').radiocheck();
        $('[data-toggle="radio"]').radiocheck();
    });
});