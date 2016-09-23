/*! iResearchView-1.0.0-2016-09-21 */
/*!
 * Flash export buttons for Buttons and DataTables.
 * 2015 SpryMedia Ltd - datatables.net/license
 *
 * ZeroClipbaord - MIT license
 * Copyright (c) 2012 Joseph Huckaby
 */
/*
 * ZeroClipboard 1.0.4 with modifications
 * Author: Joseph Huckaby
 * License: MIT
 *
 * Copyright (c) 2012 Joseph Huckaby
 */
!function(a){"function"==typeof define&&define.amd?define(["jquery","datatables.net","datatables.net-buttons"],function(b){return a(b,window,document)}):"object"==typeof exports?module.exports=function(b,c){return b||(b=window),c&&c.fn.dataTable||(c=require("datatables.net")(b,c).$),c.fn.dataTable.Buttons||require("datatables.net-buttons")(b,c),a(c,b,b.document)}:a(jQuery,window,document)}(function(a,b,c,d){"use strict";function e(a){for(var b="A".charCodeAt(0),c="Z".charCodeAt(0),d=c-b+1,e="";a>=0;)e=String.fromCharCode(a%d+b)+e,a=Math.floor(a/d)-1;return e}function f(b,c,d){var e=b.createElement(c);return d&&(d.attr&&a(e).attr(d.attr),d.children&&a.each(d.children,function(a,b){e.appendChild(b)}),d.text&&e.appendChild(b.createTextNode(d.text))),e}function g(a,b){var c,d=a.header[b].length;a.footer&&a.footer[b].length>d&&(d=a.footer[b].length);for(var e=0,f=a.body.length;e<f&&(c=a.body[e][b].toString().length,c>d&&(d=c),!(d>40));e++);return d>5?d:5}function h(b){r===d&&(r=s.serializeToString(a.parseXML(t["xl/worksheets/sheet1.xml"])).indexOf("xmlns:r")===-1),a.each(b,function(c,d){if(a.isPlainObject(d))h(d);else{if(r){var e,f,g=d.childNodes[0],i=[];for(e=g.attributes.length-1;e>=0;e--){var j=g.attributes[e].nodeName,k=g.attributes[e].nodeValue;j.indexOf(":")!==-1&&(i.push({name:j,value:k}),g.removeAttribute(j))}for(e=0,f=i.length;e<f;e++){var l=d.createAttribute(i[e].name.replace(":","_dt_b_namespace_token_"));l.value=i[e].value,g.setAttributeNode(l)}}var m=s.serializeToString(d);r&&(m.indexOf("<?xml")===-1&&(m='<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'+m),m=m.replace(/_dt_b_namespace_token_/g,":")),m=m.replace(/<row xmlns="" /g,"<row ").replace(/<cols xmlns="">/g,"<cols>"),b[c]=m}})}var i=a.fn.dataTable,j={version:"1.0.4-TableTools2",clients:{},moviePath:"",nextId:1,$:function(a){return"string"==typeof a&&(a=c.getElementById(a)),a.addClass||(a.hide=function(){this.style.display="none"},a.show=function(){this.style.display=""},a.addClass=function(a){this.removeClass(a),this.className+=" "+a},a.removeClass=function(a){this.className=this.className.replace(new RegExp("\\s*"+a+"\\s*")," ").replace(/^\s+/,"").replace(/\s+$/,"")},a.hasClass=function(a){return!!this.className.match(new RegExp("\\s*"+a+"\\s*"))}),a},setMoviePath:function(a){this.moviePath=a},dispatch:function(a,b,c){var d=this.clients[a];d&&d.receiveEvent(b,c)},log:function(a){},register:function(a,b){this.clients[a]=b},getDOMObjectPosition:function(a){var b={left:0,top:0,width:a.width?a.width:a.offsetWidth,height:a.height?a.height:a.offsetHeight};for(""!==a.style.width&&(b.width=a.style.width.replace("px","")),""!==a.style.height&&(b.height=a.style.height.replace("px",""));a;)b.left+=a.offsetLeft,b.top+=a.offsetTop,a=a.offsetParent;return b},Client:function(a){this.handlers={},this.id=j.nextId++,this.movieId="ZeroClipboard_TableToolsMovie_"+this.id,j.register(this.id,this),a&&this.glue(a)}};j.Client.prototype={id:0,ready:!1,movie:null,clipText:"",fileName:"",action:"copy",handCursorEnabled:!0,cssEffects:!0,handlers:null,sized:!1,sheetName:"",glue:function(a,b){this.domElement=j.$(a);var d=99;this.domElement.style.zIndex&&(d=parseInt(this.domElement.style.zIndex,10)+1);var e=j.getDOMObjectPosition(this.domElement);this.div=c.createElement("div");var f=this.div.style;f.position="absolute",f.left="0px",f.top="0px",f.width=e.width+"px",f.height=e.height+"px",f.zIndex=d,"undefined"!=typeof b&&""!==b&&(this.div.title=b),0!==e.width&&0!==e.height&&(this.sized=!0),this.domElement&&(this.domElement.appendChild(this.div),this.div.innerHTML=this.getHTML(e.width,e.height).replace(/&/g,"&amp;"))},positionElement:function(){var a=j.getDOMObjectPosition(this.domElement),b=this.div.style;if(b.position="absolute",b.width=a.width+"px",b.height=a.height+"px",0!==a.width&&0!==a.height){this.sized=!0;var c=this.div.childNodes[0];c.width=a.width,c.height=a.height}},getHTML:function(a,b){var c="",d="id="+this.id+"&width="+a+"&height="+b;if(navigator.userAgent.match(/MSIE/)){var e=location.href.match(/^https/i)?"https://":"http://";c+='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="'+e+'download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="'+a+'" height="'+b+'" id="'+this.movieId+'" align="middle"><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="false" /><param name="movie" value="'+j.moviePath+'" /><param name="loop" value="false" /><param name="menu" value="false" /><param name="quality" value="best" /><param name="bgcolor" value="#ffffff" /><param name="flashvars" value="'+d+'"/><param name="wmode" value="transparent"/></object>'}else c+='<embed id="'+this.movieId+'" src="'+j.moviePath+'" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="'+a+'" height="'+b+'" name="'+this.movieId+'" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="'+d+'" wmode="transparent" />';return c},hide:function(){this.div&&(this.div.style.left="-2000px")},show:function(){this.reposition()},destroy:function(){var b=this;this.domElement&&this.div&&(a(this.div).remove(),this.domElement=null,this.div=null,a.each(j.clients,function(a,c){c===b&&delete j.clients[a]}))},reposition:function(a){if(a&&(this.domElement=j.$(a),this.domElement||this.hide()),this.domElement&&this.div){var b=j.getDOMObjectPosition(this.domElement),c=this.div.style;c.left=""+b.left+"px",c.top=""+b.top+"px"}},clearText:function(){this.clipText="",this.ready&&this.movie.clearText()},appendText:function(a){this.clipText+=a,this.ready&&this.movie.appendText(a)},setText:function(a){this.clipText=a,this.ready&&this.movie.setText(a)},setFileName:function(a){this.fileName=a,this.ready&&this.movie.setFileName(a)},setSheetData:function(a){this.ready&&this.movie.setSheetData(JSON.stringify(a))},setAction:function(a){this.action=a,this.ready&&this.movie.setAction(a)},addEventListener:function(a,b){a=a.toString().toLowerCase().replace(/^on/,""),this.handlers[a]||(this.handlers[a]=[]),this.handlers[a].push(b)},setHandCursor:function(a){this.handCursorEnabled=a,this.ready&&this.movie.setHandCursor(a)},setCSSEffects:function(a){this.cssEffects=!!a},receiveEvent:function(a,d){var e;switch(a=a.toString().toLowerCase().replace(/^on/,"")){case"load":if(this.movie=c.getElementById(this.movieId),!this.movie)return e=this,void setTimeout(function(){e.receiveEvent("load",null)},1);if(!this.ready&&navigator.userAgent.match(/Firefox/)&&navigator.userAgent.match(/Windows/))return e=this,setTimeout(function(){e.receiveEvent("load",null)},100),void(this.ready=!0);this.ready=!0,this.movie.clearText(),this.movie.appendText(this.clipText),this.movie.setFileName(this.fileName),this.movie.setAction(this.action),this.movie.setHandCursor(this.handCursorEnabled);break;case"mouseover":this.domElement&&this.cssEffects&&this.recoverActive&&this.domElement.addClass("active");break;case"mouseout":this.domElement&&this.cssEffects&&(this.recoverActive=!1,this.domElement.hasClass("active")&&(this.domElement.removeClass("active"),this.recoverActive=!0));break;case"mousedown":this.domElement&&this.cssEffects&&this.domElement.addClass("active");break;case"mouseup":this.domElement&&this.cssEffects&&(this.domElement.removeClass("active"),this.recoverActive=!1)}if(this.handlers[a])for(var f=0,g=this.handlers[a].length;f<g;f++){var h=this.handlers[a][f];"function"==typeof h?h(this,d):"object"==typeof h&&2==h.length?h[0][h[1]](this,d):"string"==typeof h&&b[h](this,d)}}},j.hasFlash=function(){try{var a=new ActiveXObject("ShockwaveFlash.ShockwaveFlash");if(a)return!0}catch(a){if(navigator.mimeTypes&&navigator.mimeTypes["application/x-shockwave-flash"]!==d&&navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin)return!0}return!1},b.ZeroClipboard_TableTools=j;var k=function(a,b){b.attr("id"),b.parents("html").length?a.glue(b[0],""):setTimeout(function(){k(a,b)},500)},l=function(b,c){var e="*"===b.filename&&"*"!==b.title&&b.title!==d?b.title:b.filename;return"function"==typeof e&&(e=e()),e.indexOf("*")!==-1&&(e=a.trim(e.replace("*",a("title").text()))),e=e.replace(/[^a-zA-Z0-9_\u00A1-\uFFFF\.,\-_ !\(\)]/g,""),c===d||c===!0?e+b.extension:e},m=function(a){var b="Sheet1";return a.sheetName&&(b=a.sheetName.replace(/[\[\]\*\/\\\?\:]/g,"")),b},n=function(a,b){var c=b.match(/[\s\S]{1,8192}/g)||[];a.clearText();for(var d=0,e=c.length;d<e;d++)a.appendText(c[d])},o=function(a){return a.newline?a.newline:navigator.userAgent.match(/Windows/)?"\r\n":"\n"},p=function(a,b){for(var c=o(b),e=a.buttons.exportData(b.exportOptions),f=b.fieldBoundary,g=b.fieldSeparator,h=new RegExp(f,"g"),i=b.escapeChar!==d?b.escapeChar:"\\",j=function(a){for(var b="",c=0,d=a.length;c<d;c++)c>0&&(b+=g),b+=f?f+(""+a[c]).replace(h,i+f)+f:a[c];return b},k=b.header?j(e.header)+c:"",l=b.footer&&e.footer?c+j(e.footer):"",m=[],n=0,p=e.body.length;n<p;n++)m.push(j(e.body[n]));return{str:k+m.join(c)+l,rows:m.length}},q={available:function(){return j.hasFlash()},init:function(a,b,c){j.moviePath=i.Buttons.swfPath;var d=new j.Client;d.setHandCursor(!0),d.addEventListener("mouseDown",function(d){c._fromFlash=!0,a.button(b[0]).trigger(),c._fromFlash=!1}),k(d,b),c._flash=d},destroy:function(a,b,c){c._flash.destroy()},fieldSeparator:",",fieldBoundary:'"',exportOptions:{},title:"*",filename:"*",extension:".csv",header:!0,footer:!1};try{var r,s=new XMLSerializer}catch(a){}var t={"_rels/.rels":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/></Relationships>',"xl/_rels/workbook.xml.rels":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/><Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/></Relationships>',"[Content_Types].xml":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types"><Default Extension="xml" ContentType="application/xml" /><Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml" /><Default Extension="jpeg" ContentType="image/jpeg" /><Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml" /><Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml" /><Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml" /></Types>',"xl/workbook.xml":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?><workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"><fileVersion appName="xl" lastEdited="5" lowestEdited="5" rupBuild="24816"/><workbookPr showInkAnnotation="0" autoCompressPictures="0"/><bookViews><workbookView xWindow="0" yWindow="0" windowWidth="25600" windowHeight="19020" tabRatio="500"/></bookViews><sheets><sheet name="" sheetId="1" r:id="rId1"/></sheets></workbook>',"xl/worksheets/sheet1.xml":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?><worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships" xmlns:mc="http://schemas.openxmlformats.org/markup-compatibility/2006" mc:Ignorable="x14ac" xmlns:x14ac="http://schemas.microsoft.com/office/spreadsheetml/2009/9/ac"><sheetData/></worksheet>',"xl/styles.xml":'<?xml version="1.0" encoding="UTF-8"?><styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:mc="http://schemas.openxmlformats.org/markup-compatibility/2006" mc:Ignorable="x14ac" xmlns:x14ac="http://schemas.microsoft.com/office/spreadsheetml/2009/9/ac"><fonts count="5" x14ac:knownFonts="1"><font><sz val="11" /><name val="Calibri" /></font><font><sz val="11" /><name val="Calibri" /><color rgb="FFFFFFFF" /></font><font><sz val="11" /><name val="Calibri" /><b /></font><font><sz val="11" /><name val="Calibri" /><i /></font><font><sz val="11" /><name val="Calibri" /><u /></font></fonts><fills count="6"><fill><patternFill patternType="none" /></fill><fill/><fill><patternFill patternType="solid"><fgColor rgb="FFD9D9D9" /><bgColor indexed="64" /></patternFill></fill><fill><patternFill patternType="solid"><fgColor rgb="FFD99795" /><bgColor indexed="64" /></patternFill></fill><fill><patternFill patternType="solid"><fgColor rgb="ffc6efce" /><bgColor indexed="64" /></patternFill></fill><fill><patternFill patternType="solid"><fgColor rgb="ffc6cfef" /><bgColor indexed="64" /></patternFill></fill></fills><borders count="2"><border><left /><right /><top /><bottom /><diagonal /></border><border diagonalUp="false" diagonalDown="false"><left style="thin"><color auto="1" /></left><right style="thin"><color auto="1" /></right><top style="thin"><color auto="1" /></top><bottom style="thin"><color auto="1" /></bottom><diagonal /></border></borders><cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0" /></cellStyleXfs><cellXfs count="2"><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/></cellXfs><cellStyles count="1"><cellStyle name="Normal" xfId="0" builtinId="0" /></cellStyles><dxfs count="0" /><tableStyles count="0" defaultTableStyle="TableStyleMedium9" defaultPivotStyle="PivotStyleMedium4" /></styleSheet>'};return i.Buttons.swfPath="http://cdn.datatables.net/buttons/1.2.0/swf/flashExport.swf",i.Api.register("buttons.resize()",function(){a.each(j.clients,function(a,b){b.domElement!==d&&b.domElement.parentNode&&b.positionElement()})}),i.ext.buttons.copyFlash=a.extend({},q,{className:"buttons-copy buttons-flash",text:function(a){return a.i18n("buttons.copy","Copy")},action:function(a,b,c,d){if(d._fromFlash){var e=d._flash,f=p(b,d),g=d.customize?d.customize(f.str,d):f.str;e.setAction("copy"),n(e,g),b.buttons.info(b.i18n("buttons.copyTitle","Copy to clipboard"),b.i18n("buttons.copySuccess",{_:"Copied %d rows to clipboard",1:"Copied 1 row to clipboard"},f.rows),3e3)}},fieldSeparator:"\t",fieldBoundary:""}),i.ext.buttons.csvFlash=a.extend({},q,{className:"buttons-csv buttons-flash",text:function(a){return a.i18n("buttons.csv","CSV")},action:function(a,b,c,d){var e=d._flash,f=p(b,d),g=d.customize?d.customize(f.str,d):f.str;e.setAction("csv"),e.setFileName(l(d)),n(e,g)},escapeChar:'"'}),i.ext.buttons.excelFlash=a.extend({},q,{className:"buttons-excel buttons-flash",text:function(a){return a.i18n("buttons.excel","Excel")},action:function(b,c,i,j){var k,o,p=j._flash,q=0,r=a.parseXML(t["xl/worksheets/sheet1.xml"]),s=r.getElementsByTagName("sheetData")[0],u={_rels:{".rels":a.parseXML(t["_rels/.rels"])},xl:{_rels:{"workbook.xml.rels":a.parseXML(t["xl/_rels/workbook.xml.rels"])},"workbook.xml":a.parseXML(t["xl/workbook.xml"]),"styles.xml":a.parseXML(t["xl/styles.xml"]),worksheets:{"sheet1.xml":r}},"[Content_Types].xml":a.parseXML(t["[Content_Types].xml"])},v=c.buttons.exportData(j.exportOptions),w=function(b){k=q+1,o=f(r,"row",{attr:{r:k}});for(var c=0,g=b.length;c<g;c++){var h,i=e(c)+""+k;if(null!==b[c]&&b[c]!==d||(b[c]=""),"number"==typeof b[c]||b[c].match&&a.trim(b[c]).match(/^-?\d+(\.\d+)?$/)&&!a.trim(b[c]).match(/^0\d+/))h=f(r,"c",{attr:{t:"n",r:i},children:[f(r,"v",{text:b[c]})]});else{var j=b[c].replace?b[c].replace(/&(?!amp;)/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F-\x9F]/g,""):b[c];h=f(r,"c",{attr:{t:"inlineStr",r:i},children:{row:f(r,"is",{children:{row:f(r,"t",{text:j})}})}})}o.appendChild(h)}s.appendChild(o),q++};a("sheets sheet",u.xl["workbook.xml"]).attr("name",m(j)),j.customizeData&&j.customizeData(v),j.header&&(w(v.header,q),a("row c",r).attr("s","2"));for(var x=0,y=v.body.length;x<y;x++)w(v.body[x],q);j.footer&&v.footer&&(w(v.footer,q),a("row:last c",r).attr("s","2"));var z=f(r,"cols");a("worksheet",r).prepend(z);for(var A=0,B=v.header.length;A<B;A++)z.appendChild(f(r,"col",{attr:{min:A+1,max:A+1,width:g(v,A),customWidth:1}}));j.customize&&j.customize(u),h(u),p.setAction("excel"),p.setFileName(l(j)),p.setSheetData(u),n(p,"")},extension:".xlsx"}),i.ext.buttons.pdfFlash=a.extend({},q,{className:"buttons-pdf buttons-flash",text:function(a){return a.i18n("buttons.pdf","PDF")},action:function(a,b,c,d){var e=d._flash,f=b.buttons.exportData(d.exportOptions),g=b.table().node().offsetWidth,h=b.columns(d.columns).indexes().map(function(a){return b.column(a).header().offsetWidth/g});e.setAction("pdf"),e.setFileName(l(d)),n(e,JSON.stringify({title:l(d,!1),message:d.message,colWidth:h.toArray(),orientation:d.orientation,size:d.pageSize,header:d.header?f.header:null,footer:d.footer?f.footer:null,body:f.body}))},extension:".pdf",orientation:"portrait",pageSize:"A4",message:"",newline:"\n"}),i.Buttons});