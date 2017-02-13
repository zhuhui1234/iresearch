/**
 * Created by Hank on 2016/12/27.
 */
define(['app/main', 'swiper'], function () {
    $(function () {
        var swiper = function () {
            new Swiper('.swiper-container', {
                pagination: '.swiper-pagination',
                spaceBetween: 30,
                paginationClickable: true,
                parallax: true,
                speed: 1000,
                paginationBulletRender: function (swiper, index, className) {
                    return '<span class="' + className + '">' + (index + 1) + '</span>';
                }
            });
        }
        swiper();

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            // e.target // newly activated tab
            // e.relatedTarget // previous active tab
            console.log(e)
            swiper();
        })

    });

});
