/*! iResearchView-1.0.0-2016-09-21 */
define(["helper","jquery"],function(a){function b(a){var b=a.split("="),d=c(b[3]);d&&$("#frameReport").attr("src",a)}function c(a){var b=!1,c="?m=service&a=upUserSessionKey",a=a;return $.ajax({async:!1,type:"POST",data:{guid:a},url:c,success:function(a){b=!0}}),b}if(""!==$("#frameReport").attr("default")){var d=$("#frameReport").attr("default");b(d)}else $(".loading-report").html("暂无数据");$("._showReport").click(function(){$(".show-report").hide(),$(".loading-report").show();var a=$(this).attr("cfg_url");b(a)}),$("#frameReport").load(function(){var a=$(document).height()-160;$(this).height(a),setTimeout(function(){$(".loading-report").hide(),$(".show-report").show()},1e3)})});