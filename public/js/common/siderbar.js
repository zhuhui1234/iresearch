/*! iResearchView-1.0.0-2016-09-19 */
define(["jquery"],function(){$(function(){$(".submenu > a").click(function(a){a.preventDefault();var b=$(this).parent(),c=$(this).siblings();$(this).parent().toggleClass("open"),$(b).hasClass("open")?c.stop().slideDown("fast"):c.stop().slideUp("fast"),$(this).parent().siblings().removeClass("open").find("ul").slideUp("fast")}),$(".left-menu > a").click(function(a){a.preventDefault(),$(this).toggleClass("active"),$(this).hasClass("active")?($(".sidebar").addClass("show"),$(".wrap").addClass("active")):($(".sidebar").removeClass("show"),$(".wrap").removeClass("active"))})})});