$('.move').mouseenter(function () {
    $('.move img').stop().animate({
        left:'22px'
    },10);
});
$('.move').mouseleave(function () {
    $('.move img').stop().animate({
        left:'20px'
    },10);
});
// $('.move2').mouseenter(function () {
//     $('.move2 img').stop().animate({
//         right:'8px'
//     },500);
// })
// $('.move2').mouseleave(function () {
//     $('.move2 img').stop().animate({
//         right:'10px'
//     },500);
// })
$('.move2').mouseenter(function () {
    $('.img1').stop().animate({
        left:'2px'
    },10);
});
$('.move2').mouseleave(function () {
    $('.img1').stop().animate({
        left:'0'
    },10);
});
$('.move3').mouseenter(function () {
    $('.img2').stop().animate({
        left:'2px'
    },10);
});
$('.move3').mouseleave(function () {
    $('.img2').stop().animate({
        left:'0'
    },10);
});