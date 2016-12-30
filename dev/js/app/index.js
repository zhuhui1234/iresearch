define(['app/main'], function() {
    $(function(){
        //导航
        var index = window.location.href.split('/').length - 1;
        var href = window.location.href.split('/')[index];
        $(".nav_con ul li a[href^='"+ href +"']").parent().addClass("active");
        var thisActive = $(".nav_con .navbar-nav li.active");
        var li_width = thisActive.outerWidth();
        var li_left = thisActive.position().left;
        $(".nav_con .line").css({width:li_width,left:li_left}).bind('mouseover', function (evt) {
            this.style.display = 'none';
            var x = evt.pageX, y = evt.pageY,
                under = document.elementFromPoint(x, y);
            this.style.display = '';
            evt.stopPropagation();
            evt.preventDefault();
            $(under).trigger(evt.type);
        });
        var isHover = false;
        $(".nav_con li").hover(function(){
            var li_width = $(this).outerWidth();
            var li_left = $(this).position().left;
            isHover = true;
            var thisIndex = $(this).index();
            $(".nav-bg").stop().slideDown(200);
            $(".dropdown-list > li").eq(thisIndex).show().siblings().hide();
            $(".nav_con .line").stop().animate({width:li_width,left:li_left},300);
        },function () {
            isHover = false;
            setTimeout(function() {
                if (!isHover) {
                    $(".nav-bg").stop().slideUp(200);
                    $(".nav_con .line").stop().animate({width:li_width,left:li_left},300);
                }
            }, 10);
        });
        $(".nav-bg").hover(function() {
            isHover = true;
        }, function() {
            isHover = false;
            $(".nav-bg").stop().slideUp(200);
            $(".nav_con .line").stop().animate({width:li_width,left:li_left},300);
        });
        $(".tab-menu li a").hover(function(){
           var thisIndex = $(this).parent().index();
           $(this).parent().addClass("active").siblings().removeClass("active");
            $(this).parents(".col-xs-3").siblings(".col-xs-9").find("li").eq(thisIndex).show().siblings().hide();
        });
        //焦点图
        var rightHeight = $(".focus-main-right").height();
        $(".focus-main-left").css("height",rightHeight);
        $(".focus-main-right ul li a").on('click',function(e){
            e.preventDefault();
            $(this).parent().addClass("active").siblings().removeClass("active");
            var thisIndex = $(this).parent().index();
            $(".focus-main-left ul li").eq(thisIndex).stop().fadeIn(200).addClass("active").siblings().stop().fadeOut(200).removeClass("active");
        });
    });
});