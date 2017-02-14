/**
 * Created by Hank on 2016/12/27.
 */
define(['app/main', 'swiper'], function () {
    $(function () {
        var swiper = function () {
            return new Swiper('.swiper-container', {
                // initialSlide :pageNum,
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

        var sw = swiper();

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            // console.log(e);
            // e.target // newly activated tab
            // e.relatedTarget // previous active tab
            // console.log(sw[0].activeIndex);
            swiper();
            sw.map(function(i,v){
                // console.log(sw[v].slideTo(0));
                if (sw[v].slideTo(0)) {
                    sw[v].slideTo(0)
                }else {
                    sw[v].slideTo(0);

                }
                // sw[v].updatePagination();
                // sw[v].slideTo(0);
            })
        })

    });

});
