/*! iResearchView-1.0.0-2016-09-21 */
define(["jquery","lazyload"],function(a){function b(){h=a(window).height(),t=a(document).scrollTop(),t>h?a(".gotop").fadeIn("fast").css("display","block"):a(".gotop").fadeOut()}a(window).scroll(function(a){b()}),a(".gotop").click(function(b){b.preventDefault(),a("html,body").animate({scrollTop:0},300)})});