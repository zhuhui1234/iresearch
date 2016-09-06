/*! iResearchView-1.0.0-2016-08-15 */
/*!
 * Pikaday
 *
 * Copyright © 2014 David Bushell | BSD & MIT license | https://github.com/dbushell/Pikaday
 */
!function(a,b){"use strict";var c;if("object"==typeof exports){try{c=require("moment")}catch(a){}module.exports=b(c)}else"function"==typeof define&&define.amd?define(["require"],function(a){var d="moment";try{c=a(d)}catch(a){}return b(c)}):a.Pikaday=b(a.moment)}(this,function(a){"use strict";var b="function"==typeof a,c=!!window.addEventListener,d=window.document,e=window.setTimeout,f=function(a,b,d,e){c?a.addEventListener(b,d,!!e):a.attachEvent("on"+b,d)},g=function(a,b,d,e){c?a.removeEventListener(b,d,!!e):a.detachEvent("on"+b,d)},h=function(a,b,c){var e;d.createEvent?(e=d.createEvent("HTMLEvents"),e.initEvent(b,!0,!1),e=t(e,c),a.dispatchEvent(e)):d.createEventObject&&(e=d.createEventObject(),e=t(e,c),a.fireEvent("on"+b,e))},i=function(a){return a.trim?a.trim():a.replace(/^\s+|\s+$/g,"")},j=function(a,b){return-1!==(" "+a.className+" ").indexOf(" "+b+" ")},k=function(a,b){j(a,b)||(a.className=""===a.className?b:a.className+" "+b)},l=function(a,b){a.className=i((" "+a.className+" ").replace(" "+b+" "," "))},m=function(a){return/Array/.test(Object.prototype.toString.call(a))},n=function(a){return/Date/.test(Object.prototype.toString.call(a))&&!isNaN(a.getTime())},o=function(a){var b=a.getDay();return 0===b||6===b},p=function(a){return a%4===0&&a%100!==0||a%400===0},q=function(a,b){return[31,p(a)?29:28,31,30,31,30,31,31,30,31,30,31][b]},r=function(a){n(a)&&a.setHours(0,0,0,0)},s=function(a,b){return a.getTime()===b.getTime()},t=function(a,b,c){var d,e;for(d in b)e=void 0!==a[d],e&&"object"==typeof b[d]&&null!==b[d]&&void 0===b[d].nodeName?n(b[d])?c&&(a[d]=new Date(b[d].getTime())):m(b[d])?c&&(a[d]=b[d].slice(0)):a[d]=t({},b[d],c):(c||!e)&&(a[d]=b[d]);return a},u=function(a){return a.month<0&&(a.year-=Math.ceil(Math.abs(a.month)/12),a.month+=12),a.month>11&&(a.year+=Math.floor(Math.abs(a.month)/12),a.month-=12),a},v={field:null,bound:void 0,position:"bottom left",reposition:!0,format:"YYYY-MM-DD",defaultDate:null,setDefaultDate:!1,firstDay:0,minDate:null,maxDate:null,yearRange:10,showWeekNumber:!1,minYear:0,maxYear:9999,minMonth:void 0,maxMonth:void 0,startRange:null,endRange:null,isRTL:!1,yearSuffix:"",showMonthAfterYear:!1,numberOfMonths:1,mainCalendar:"left",container:void 0,i18n:{previousMonth:"Previous Month",nextMonth:"Next Month",months:["January","February","March","April","May","June","July","August","September","October","November","December"],weekdays:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],weekdaysShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"]},theme:null,onSelect:null,onOpen:null,onClose:null,onDraw:null},w=function(a,b,c){for(b+=a.firstDay;b>=7;)b-=7;return c?a.i18n.weekdaysShort[b]:a.i18n.weekdays[b]},x=function(a){if(a.isEmpty)return'<td class="is-empty"></td>';var b=[];return a.isDisabled&&b.push("is-disabled"),a.isToday&&b.push("is-today"),a.isSelected&&b.push("is-selected"),a.isInRange&&b.push("is-inrange"),a.isStartRange&&b.push("is-startrange"),a.isEndRange&&b.push("is-endrange"),'<td data-day="'+a.day+'" class="'+b.join(" ")+'"><button class="pika-button pika-day" type="button" data-pika-year="'+a.year+'" data-pika-month="'+a.month+'" data-pika-day="'+a.day+'">'+a.day+"</button></td>"},y=function(a,b,c){var d=new Date(c,0,1),e=Math.ceil(((new Date(c,b,a)-d)/864e5+d.getDay()+1)/7);return'<td class="pika-week">'+e+"</td>"},z=function(a,b){return"<tr>"+(b?a.reverse():a).join("")+"</tr>"},A=function(a){return"<tbody>"+a.join("")+"</tbody>"},B=function(a){var b,c=[];for(a.showWeekNumber&&c.push("<th></th>"),b=0;7>b;b++)c.push('<th scope="col"><abbr title="'+w(a,b)+'">'+w(a,b,!0)+"</abbr></th>");return"<thead>"+(a.isRTL?c.reverse():c).join("")+"</thead>"},C=function(a,b,c,d,e){var f,g,h,i,j,k=a._o,l=c===k.minYear,n=c===k.maxYear,o='<div class="pika-title">',p=!0,q=!0;for(h=[],f=0;12>f;f++)h.push('<option value="'+(c===e?f-b:12+f-b)+'"'+(f===d?" selected":"")+(l&&f<k.minMonth||n&&f>k.maxMonth?"disabled":"")+">"+k.i18n.months[f]+"</option>");for(i='<div class="pika-label">'+k.i18n.months[d]+'<select class="pika-select pika-select-month" tabindex="-1">'+h.join("")+"</select></div>",m(k.yearRange)?(f=k.yearRange[0],g=k.yearRange[1]+1):(f=c-k.yearRange,g=1+c+k.yearRange),h=[];g>f&&f<=k.maxYear;f++)f>=k.minYear&&h.push('<option value="'+f+'"'+(f===c?" selected":"")+">"+f+"</option>");return j='<div class="pika-label">'+c+k.yearSuffix+'<select class="pika-select pika-select-year" tabindex="-1">'+h.join("")+"</select></div>",o+=k.showMonthAfterYear?j+i:i+j,l&&(0===d||k.minMonth>=d)&&(p=!1),n&&(11===d||k.maxMonth<=d)&&(q=!1),0===b&&(o+='<button class="pika-prev'+(p?"":" is-disabled")+'" type="button">'+k.i18n.previousMonth+"</button>"),b===a._o.numberOfMonths-1&&(o+='<button class="pika-next'+(q?"":" is-disabled")+'" type="button">'+k.i18n.nextMonth+"</button>"),o+="</div>"},D=function(a,b){return'<table cellpadding="0" cellspacing="0" class="pika-table">'+B(a)+A(b)+"</table>"},E=function(g){var h=this,i=h.config(g);h._onMouseDown=function(a){if(h._v){a=a||window.event;var b=a.target||a.srcElement;if(b)if(j(b,"is-disabled")||(j(b,"pika-button")&&!j(b,"is-empty")?(h.setDate(new Date(b.getAttribute("data-pika-year"),b.getAttribute("data-pika-month"),b.getAttribute("data-pika-day"))),i.bound&&e(function(){h.hide(),i.field&&i.field.blur()},100)):j(b,"pika-prev")?h.prevMonth():j(b,"pika-next")&&h.nextMonth()),j(b,"pika-select"))h._c=!0;else{if(!a.preventDefault)return a.returnValue=!1,!1;a.preventDefault()}}},h._onChange=function(a){a=a||window.event;var b=a.target||a.srcElement;b&&(j(b,"pika-select-month")?h.gotoMonth(b.value):j(b,"pika-select-year")&&h.gotoYear(b.value))},h._onInputChange=function(c){var d;c.firedBy!==h&&(b?(d=a(i.field.value,i.format),d=d&&d.isValid()?d.toDate():null):d=new Date(Date.parse(i.field.value)),n(d)&&h.setDate(d),h._v||h.show())},h._onInputFocus=function(){h.show()},h._onInputClick=function(){h.show()},h._onInputBlur=function(){var a=d.activeElement;do if(j(a,"pika-single"))return;while(a=a.parentNode);h._c||(h._b=e(function(){h.hide()},50)),h._c=!1},h._onClick=function(a){a=a||window.event;var b=a.target||a.srcElement,d=b;if(b){!c&&j(b,"pika-select")&&(b.onchange||(b.setAttribute("onchange","return;"),f(b,"change",h._onChange)));do if(j(d,"pika-single")||d===i.trigger)return;while(d=d.parentNode);h._v&&b!==i.trigger&&d!==i.trigger&&h.hide()}},h.el=d.createElement("div"),h.el.className="pika-single"+(i.isRTL?" is-rtl":"")+(i.theme?" "+i.theme:""),f(h.el,"mousedown",h._onMouseDown,!0),f(h.el,"touchend",h._onMouseDown,!0),f(h.el,"change",h._onChange),i.field&&(i.container?i.container.appendChild(h.el):i.bound?d.body.appendChild(h.el):i.field.parentNode.insertBefore(h.el,i.field.nextSibling),f(i.field,"change",h._onInputChange),i.defaultDate||(b&&i.field.value?i.defaultDate=a(i.field.value,i.format).toDate():i.defaultDate=new Date(Date.parse(i.field.value)),i.setDefaultDate=!0));var k=i.defaultDate;n(k)?i.setDefaultDate?h.setDate(k,!0):h.gotoDate(k):h.gotoDate(new Date),i.bound?(this.hide(),h.el.className+=" is-bound",f(i.trigger,"click",h._onInputClick),f(i.trigger,"focus",h._onInputFocus),f(i.trigger,"blur",h._onInputBlur)):this.show()};return E.prototype={config:function(a){this._o||(this._o=t({},v,!0));var b=t(this._o,a,!0);b.isRTL=!!b.isRTL,b.field=b.field&&b.field.nodeName?b.field:null,b.theme="string"==typeof b.theme&&b.theme?b.theme:null,b.bound=!!(void 0!==b.bound?b.field&&b.bound:b.field),b.trigger=b.trigger&&b.trigger.nodeName?b.trigger:b.field,b.disableWeekends=!!b.disableWeekends,b.disableDayFn="function"==typeof b.disableDayFn?b.disableDayFn:null;var c=parseInt(b.numberOfMonths,10)||1;if(b.numberOfMonths=c>4?4:c,n(b.minDate)||(b.minDate=!1),n(b.maxDate)||(b.maxDate=!1),b.minDate&&b.maxDate&&b.maxDate<b.minDate&&(b.maxDate=b.minDate=!1),b.minDate&&this.setMinDate(b.minDate),b.maxDate&&this.setMaxDate(b.maxDate),m(b.yearRange)){var d=(new Date).getFullYear()-10;b.yearRange[0]=parseInt(b.yearRange[0],10)||d,b.yearRange[1]=parseInt(b.yearRange[1],10)||d}else b.yearRange=Math.abs(parseInt(b.yearRange,10))||v.yearRange,b.yearRange>100&&(b.yearRange=100);return b},toString:function(c){return n(this._d)?b?a(this._d).format(c||this._o.format):this._d.toDateString():""},getMoment:function(){return b?a(this._d):null},setMoment:function(c,d){b&&a.isMoment(c)&&this.setDate(c.toDate(),d)},getDate:function(){return n(this._d)?new Date(this._d.getTime()):null},setDate:function(a,b){if(!a)return this._d=null,this._o.field&&(this._o.field.value="",h(this._o.field,"change",{firedBy:this})),this.draw();if("string"==typeof a&&(a=new Date(Date.parse(a))),n(a)){var c=this._o.minDate,d=this._o.maxDate;n(c)&&c>a?a=c:n(d)&&a>d&&(a=d),this._d=new Date(a.getTime()),r(this._d),this.gotoDate(this._d),this._o.field&&(this._o.field.value=this.toString(),h(this._o.field,"change",{firedBy:this})),b||"function"!=typeof this._o.onSelect||this._o.onSelect.call(this,this.getDate())}},gotoDate:function(a){var b=!0;if(n(a)){if(this.calendars){var c=new Date(this.calendars[0].year,this.calendars[0].month,1),d=new Date(this.calendars[this.calendars.length-1].year,this.calendars[this.calendars.length-1].month,1),e=a.getTime();d.setMonth(d.getMonth()+1),d.setDate(d.getDate()-1),b=e<c.getTime()||d.getTime()<e}b&&(this.calendars=[{month:a.getMonth(),year:a.getFullYear()}],"right"===this._o.mainCalendar&&(this.calendars[0].month+=1-this._o.numberOfMonths)),this.adjustCalendars()}},adjustCalendars:function(){this.calendars[0]=u(this.calendars[0]);for(var a=1;a<this._o.numberOfMonths;a++)this.calendars[a]=u({month:this.calendars[0].month+a,year:this.calendars[0].year});this.draw()},gotoToday:function(){this.gotoDate(new Date)},gotoMonth:function(a){isNaN(a)||(this.calendars[0].month=parseInt(a,10),this.adjustCalendars())},nextMonth:function(){this.calendars[0].month++,this.adjustCalendars()},prevMonth:function(){this.calendars[0].month--,this.adjustCalendars()},gotoYear:function(a){isNaN(a)||(this.calendars[0].year=parseInt(a,10),this.adjustCalendars())},setMinDate:function(a){r(a),this._o.minDate=a,this._o.minYear=a.getFullYear(),this._o.minMonth=a.getMonth(),this.draw()},setMaxDate:function(a){r(a),this._o.maxDate=a,this._o.maxYear=a.getFullYear(),this._o.maxMonth=a.getMonth(),this.draw()},setStartRange:function(a){this._o.startRange=a},setEndRange:function(a){this._o.endRange=a},draw:function(a){if(this._v||a){var b=this._o,c=b.minYear,d=b.maxYear,f=b.minMonth,g=b.maxMonth,h="";this._y<=c&&(this._y=c,!isNaN(f)&&this._m<f&&(this._m=f)),this._y>=d&&(this._y=d,!isNaN(g)&&this._m>g&&(this._m=g));for(var i=0;i<b.numberOfMonths;i++)h+='<div class="pika-lendar">'+C(this,i,this.calendars[i].year,this.calendars[i].month,this.calendars[0].year)+this.render(this.calendars[i].year,this.calendars[i].month)+"</div>";if(this.el.innerHTML=h,b.bound&&"hidden"!==b.field.type&&e(function(){b.trigger.focus()},1),"function"==typeof this._o.onDraw){var j=this;e(function(){j._o.onDraw.call(j)},0)}}},adjustPosition:function(){var a,b,c,e,f,g,h,i,j,k;if(!this._o.container){if(this.el.style.position="absolute",a=this._o.trigger,b=a,c=this.el.offsetWidth,e=this.el.offsetHeight,f=window.innerWidth||d.documentElement.clientWidth,g=window.innerHeight||d.documentElement.clientHeight,h=window.pageYOffset||d.body.scrollTop||d.documentElement.scrollTop,"function"==typeof a.getBoundingClientRect)k=a.getBoundingClientRect(),i=k.left+window.pageXOffset,j=k.bottom+window.pageYOffset;else for(i=b.offsetLeft,j=b.offsetTop+b.offsetHeight;b=b.offsetParent;)i+=b.offsetLeft,j+=b.offsetTop;(this._o.reposition&&i+c>f||this._o.position.indexOf("right")>-1&&i-c+a.offsetWidth>0)&&(i=i-c+a.offsetWidth),(this._o.reposition&&j+e>g+h||this._o.position.indexOf("top")>-1&&j-e-a.offsetHeight>0)&&(j=j-e-a.offsetHeight),this.el.style.left=i+"px",this.el.style.top=j+"px"}},render:function(a,b){var c=this._o,d=new Date,e=q(a,b),f=new Date(a,b,1).getDay(),g=[],h=[];r(d),c.firstDay>0&&(f-=c.firstDay,0>f&&(f+=7));for(var i=e+f,j=i;j>7;)j-=7;i+=7-j;for(var k=0,l=0;i>k;k++){var m=new Date(a,b,1+(k-f)),p=!!n(this._d)&&s(m,this._d),t=s(m,d),u=f>k||k>=e+f,v=c.startRange&&s(c.startRange,m),w=c.endRange&&s(c.endRange,m),A=c.startRange&&c.endRange&&c.startRange<m&&m<c.endRange,B=c.minDate&&m<c.minDate||c.maxDate&&m>c.maxDate||c.disableWeekends&&o(m)||c.disableDayFn&&c.disableDayFn(m),C={day:1+(k-f),month:b,year:a,isSelected:p,isToday:t,isDisabled:B,isEmpty:u,isStartRange:v,isEndRange:w,isInRange:A};h.push(x(C)),7===++l&&(c.showWeekNumber&&h.unshift(y(k-f,b,a)),g.push(z(h,c.isRTL)),h=[],l=0)}return D(c,g)},isVisible:function(){return this._v},show:function(){this._v||(l(this.el,"is-hidden"),this._v=!0,this.draw(),this._o.bound&&(f(d,"click",this._onClick),this.adjustPosition()),"function"==typeof this._o.onOpen&&this._o.onOpen.call(this))},hide:function(){var a=this._v;a!==!1&&(this._o.bound&&g(d,"click",this._onClick),this.el.style.position="static",this.el.style.left="auto",this.el.style.top="auto",k(this.el,"is-hidden"),this._v=!1,void 0!==a&&"function"==typeof this._o.onClose&&this._o.onClose.call(this))},destroy:function(){this.hide(),g(this.el,"mousedown",this._onMouseDown,!0),g(this.el,"touchend",this._onMouseDown,!0),g(this.el,"change",this._onChange),this._o.field&&(g(this._o.field,"change",this._onInputChange),this._o.bound&&(g(this._o.trigger,"click",this._onInputClick),g(this._o.trigger,"focus",this._onInputFocus),g(this._o.trigger,"blur",this._onInputBlur))),this.el.parentNode&&this.el.parentNode.removeChild(this.el)}},E});