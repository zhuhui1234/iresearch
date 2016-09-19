define(['jquery','radialIndicator'], function($) {

    console.log('Module radialIndicator loaded.');

    $('.indicator1').radialIndicator({
        barColor: '#feba6e',
        barWidth: 4,
        initValue: 0,
        roundCorner : true,
        percentage: true,
        radius: 40,
        barBgColor:'#bfdbc1',
        fontColor: '#fff'
    });
    var radialObj = $('.indicator1').data('radialIndicator');
    radialObj.animate(60);
    $('.indicator2').radialIndicator({
        barColor: '#feba6e',
        barWidth: 4,
        initValue: 0,
        roundCorner : true,
        percentage: true,
        radius: 40,
        barBgColor:'#bfdbc1',
        fontColor: '#fff'
    });
    radialObj = $('.indicator2').data('radialIndicator');
    radialObj.animate(30);
    $('.indicator3').radialIndicator({
        barColor: '#feba6e',
        barWidth: 4,
        initValue: 0,
        roundCorner : true,
        percentage: true,
        radius: 40,
        barBgColor:'#bfdbc1',
        fontColor: '#fff'
    });
    radialObj = $('.indicator3').data('radialIndicator');
    radialObj.animate(50);
    $('.indicator4').radialIndicator({
        barColor: '#feba6e',
        barWidth: 4,
        initValue: 0,
        roundCorner : true,
        percentage: true,
        radius: 40,
        barBgColor:'#bfdbc1',
        fontColor: '#fff'
    });
    radialObj = $('.indicator4').data('radialIndicator');
    radialObj.animate(90);
});