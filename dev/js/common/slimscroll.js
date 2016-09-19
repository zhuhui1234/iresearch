define(['jquery','scrollbar'], function($) {
    console.log('Module mCustomScrollbar.init loaded.');
    //var mCustomScrollbar = require('scrollbar');
    $('.menu-col').slimscroll({
        position: 'right',
        height: '170px',
        railVisible: true
    });
});