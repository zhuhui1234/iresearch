define(['jquery','slider'], function($) {
    console.log('Module slider loaded.');

    $('#ex1').slider({
        formatter: function(value) {
            return '数量: ' + value;
        }
    });
    $("#ex2").slider({
        tooltip: 'always'
    });
    $("#ex4").slider({
        reversed : true
    });
    $("#ex5").slider({
        reversed : true,
        tooltip: 'always'
    });
    $("#ex6").slider();
    $("#ex6").on("slide", function(slideEvt) {
        $("#ex6SliderVal").text(slideEvt.value);
    });
    $("#ex8").slider({
        tooltip: 'always'
    });
});