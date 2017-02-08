/**
 * Created by Hank on 2016/12/27.
 */
define(['app/main','swiper'], function() {
    $(function () {
        var swiper = new Swiper('.swiper-container', {
            pagination: '.swiper-pagination',
            spaceBetween : 30,
            paginationClickable: true,
            parallax : true,
            speed: 1000,
            paginationBulletRender: function (swiper, index, className) {
                console.log(index);
                return '<span class="' + className + '">' + (index + 1) + '</span>';
            }
        });
    })
});
