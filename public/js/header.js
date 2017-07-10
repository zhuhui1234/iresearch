var isMobile = function() {
            var sUserAgent = navigator.userAgent.toLowerCase();
            var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
            var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
            var bIsMidp = sUserAgent.match(/midp/i) == "midp";
            var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
            var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
            var bIsAndroid = sUserAgent.match(/android/i) == "android";
            var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
            var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
            return bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM;
        }

        var banBodyScroll = function(boole) {
            var s = $('body>div');
            var _top = $(window).scrollTop();
            var float = 50;

            if (boole) {
                s.toggleClass('overflow');
                s.scrollTop(_top - float);

            } else {
                _top = s.scrollTop();
                s.toggleClass('overflow');
                $(window).scrollTop(_top + float);
            }
        }

        //导航高亮
        $(function() {
            var pageTitle = $('title').text().slice(0, 4);
            var nav_data = [{
                'title': '艾瑞数据'
            }, {
                'title': '艾瑞指数'
            }, {
                'title': '艾瑞睿见'
            }, {
                'title': '艾瑞智云'
            }, {
                'title': '关于我们'
            }];
            $.each(nav_data, function(i, n) {
                if (pageTitle.indexOf(n.title) >= 0) {
                    var k = i + 1;
                    $('#n_' + k).addClass('active').siblings().removeClass('active');
                    $('.hd-title-mobile').text(n.title);
                    return false
                }
            });
        });


        //PC导航
        $(function() {
            if (!isMobile() && $(window).width() > 767) {

                var setStyle = function(obj) {
                    var _this = obj;
                    var _left = _this.offset().left;
                    var _right = $(window).width() - _this.outerWidth() - _left;

                    _this.children('.dropdown-menu-box').css({
                        left: -_left,
                        right: -_right
                    });
                }

                $('.nav > .dropdown').each(function() {
                    setStyle($(this));
                }).hover(function() {
                    setStyle($(this));
                    $(this).addClass('open');

                }, function() {
                    $(this).removeClass('open');
                });
            }
        });


        //移动导航
        $(function() {
            if (isMobile()) {

                if (!$('body > div').hasClass('body-box')) {
                    $('body').wrapInner("<div class='body-box'></div>");
                }

                $('#n_3').removeClass('dropdown');

                $('.navbar-toggle').on('click', function() {
                    $('.collapse').toggleClass('open');
                    $('.hd-title-mobile').toggle();
                    banBodyScroll(true);
                });

                $('#navbar-collapse').on('click', function(event) {
                    event.stopPropagation();
                    $('.collapse').toggleClass('open');
                    $('.hd-title-mobile').toggle();
                    banBodyScroll(false);
                });

                $('#navbar-collapse > .nav').on('click', function(event) {
                    event.stopPropagation();
                    return;
                });

                $('.nav > .dropdown').on('click', function(event) {
                    $(this).toggleClass('active').siblings().removeClass('active');
                });
            }

            if (!isMobile()) { //PC
                $('#n_5').removeClass('dropdown');

            }
        });