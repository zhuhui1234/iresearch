define(['swiper'],function () {
    console.log('Module swiper.init loaded.');
    var swiper = new Swiper('.swiper-container', {
        paginationClickable :true,
        //autoplay: 5000,
        autoplayDisableOnInteraction: false,
        loop: true,
        calculateHeight: true,
        roundLengths: true,
        parallax: true,
        speed: 1000,
        pagination : '.swiper-pagination-white',
        prevButton:'.swiper-button-prev',
        nextButton:'.swiper-button-next'
    });
});