/*! iResearchView-1.0.0-2016-09-21 */
!function(a){a&&(a.fn.headroom=function(b){return this.each(function(){var c=a(this),d=c.data("headroom"),e="object"==typeof b&&b;e=a.extend(!0,{},Headroom.options,e),d||(d=new Headroom(this,e),d.init(),c.data("headroom",d)),"string"==typeof b&&(d[b](),"destroy"===b&&c.removeData("headroom"))})},a("[data-headroom]").each(function(){var b=a(this);b.headroom(b.data())}))}(window.Zepto||window.jQuery);