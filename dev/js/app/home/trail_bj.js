define(['helper', 'app/main'], function (Helper) {
    var height = window.innerHeight || (document.documentElement && document.documentElement.clientHeight) ||
        document.body.clientHeight;
    var width = window.innerWidth || (document.documentElement && document.documentElement.clientWidth) ||
        document.body.clientWidth;
    $(".main-image").css({
        height: height
    });
    $(".main").css({
        height: height
    });
    console.log(width);
    if(width >= 1099){
        var bodyH = (height-634)/2
        $("#jumbotron").css({"height":height+"px","padding-top":bodyH+"px","padding-bottom":bodyH+"px"});
    }
    $(".main_left_line_input").click(function(){
        $(".main_left_line_input").css('border-color', '#EEEEEE');
        $(this).css('border-color', '#69C72B');
    });
});