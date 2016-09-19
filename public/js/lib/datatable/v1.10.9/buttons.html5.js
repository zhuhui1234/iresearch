/*! iResearchView-1.0.0-2016-09-19 */
/*!
 * HTML5 export buttons for Buttons and DataTables.
 * 2016 SpryMedia Ltd - datatables.net/license
 *
 * FileSaver.js (1.1.20160328) - MIT license
 * Copyright © 2016 Eli Grey - http://eligrey.com
 */
!function(a){"function"==typeof define&&define.amd?define(["jquery","datatables.net","datatables.net-buttons"],function(b){return a(b,window,document)}):"object"==typeof exports?module.exports=function(b,c,d,e){return b||(b=window),c&&c.fn.dataTable||(c=require("datatables.net")(b,c).$),c.fn.dataTable.Buttons||require("datatables.net-buttons")(b,c),a(c,b,b.document,d,e)}:a(jQuery,window,document)}(function(a,b,c,d,e,f){"use strict";function g(a){for(var b="A".charCodeAt(0),c="Z".charCodeAt(0),d=c-b+1,e="";a>=0;)e=String.fromCharCode(a%d+b)+e,a=Math.floor(a/d)-1;return e}function h(b,c){s===f&&(s=t.serializeToString(a.parseXML(u["xl/worksheets/sheet1.xml"])).indexOf("xmlns:r")===-1),a.each(c,function(c,d){if(a.isPlainObject(d)){var e=b.folder(c);h(e,d)}else{if(s){var f,g,i=d.childNodes[0],j=[];for(f=i.attributes.length-1;f>=0;f--){var k=i.attributes[f].nodeName,l=i.attributes[f].nodeValue;k.indexOf(":")!==-1&&(j.push({name:k,value:l}),i.removeAttribute(k))}for(f=0,g=j.length;f<g;f++){var m=d.createAttribute(j[f].name.replace(":","_dt_b_namespace_token_"));m.value=j[f].value,i.setAttributeNode(m)}}var n=t.serializeToString(d);s&&(n.indexOf("<?xml")===-1&&(n='<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'+n),n=n.replace(/_dt_b_namespace_token_/g,":")),n=n.replace(/<row xmlns="" /g,"<row ").replace(/<cols xmlns="">/g,"<cols>"),b.file(c,n)}})}function i(b,c,d){var e=b.createElement(c);return d&&(d.attr&&a(e).attr(d.attr),d.children&&a.each(d.children,function(a,b){e.appendChild(b)}),d.text&&e.appendChild(b.createTextNode(d.text))),e}function j(a,b){var c,d=a.header[b].length;a.footer&&a.footer[b].length>d&&(d=a.footer[b].length);for(var e=0,f=a.body.length;e<f&&(c=a.body[e][b].toString().length,c>d&&(d=c),!(d>40));e++);return d>5?d:5}var k=a.fn.dataTable;d===f&&(d=b.JSZip),e===f&&(e=b.pdfMake);var l=function(a){if("undefined"==typeof navigator||!/MSIE [1-9]\./.test(navigator.userAgent)){var b=a.document,c=function(){return a.URL||a.webkitURL||a},d=b.createElementNS("http://www.w3.org/1999/xhtml","a"),e="download"in d,g=function(a){var b=new MouseEvent("click");a.dispatchEvent(b)},h=/Version\/[\d\.]+.*Safari/.test(navigator.userAgent),i=a.webkitRequestFileSystem,j=a.requestFileSystem||i||a.mozRequestFileSystem,k=function(b){(a.setImmediate||a.setTimeout)(function(){throw b},0)},l="application/octet-stream",m=0,n=4e4,o=function(a){var b=function(){"string"==typeof a?c().revokeObjectURL(a):a.remove()};setTimeout(b,n)},p=function(a,b,c){b=[].concat(b);for(var d=b.length;d--;){var e=a["on"+b[d]];if("function"==typeof e)try{e.call(a,c||a)}catch(a){k(a)}}},q=function(a){return/^\s*(?:text\/\S*|application\/xml|\S*\/\S*\+xml)\s*;.*charset\s*=\s*utf-8/i.test(a.type)?new Blob(["\ufeff",a],{type:a.type}):a},r=function(b,k,n){n||(b=q(b));var r,s,t,u=this,v=b.type,w=!1,x=function(){p(u,"writestart progress write writeend".split(" "))},y=function(){if(s&&h&&"undefined"!=typeof FileReader){var d=new FileReader;return d.onloadend=function(){var a=d.result;s.location.href="data:attachment/file"+a.slice(a.search(/[,;]/)),u.readyState=u.DONE,x()},d.readAsDataURL(b),void(u.readyState=u.INIT)}if(!w&&r||(r=c().createObjectURL(b)),s)s.location.href=r;else{var e=a.open(r,"_blank");e===f&&h&&(a.location.href=r)}u.readyState=u.DONE,x(),o(r)},z=function(a){return function(){if(u.readyState!==u.DONE)return a.apply(this,arguments)}},A={create:!0,exclusive:!1};return u.readyState=u.INIT,k||(k="download"),e?(r=c().createObjectURL(b),void setTimeout(function(){d.href=r,d.download=k,g(d),x(),o(r),u.readyState=u.DONE})):(a.chrome&&v&&v!==l&&(t=b.slice||b.webkitSlice,b=t.call(b,0,b.size,l),w=!0),i&&"download"!==k&&(k+=".download"),(v===l||i)&&(s=a),j?(m+=b.size,void j(a.TEMPORARY,m,z(function(a){a.root.getDirectory("saved",A,z(function(a){var c=function(){a.getFile(k,A,z(function(a){a.createWriter(z(function(c){c.onwriteend=function(b){s.location.href=a.toURL(),u.readyState=u.DONE,p(u,"writeend",b),o(a)},c.onerror=function(){var a=c.error;a.code!==a.ABORT_ERR&&y()},"writestart progress write abort".split(" ").forEach(function(a){c["on"+a]=u["on"+a]}),c.write(b),u.abort=function(){c.abort(),u.readyState=u.DONE},u.readyState=u.WRITING}),y)}),y)};a.getFile(k,{create:!1},z(function(a){a.remove(),c()}),z(function(a){a.code===a.NOT_FOUND_ERR?c():y()}))}),y)}),y)):void y())},s=r.prototype,t=function(a,b,c){return new r(a,b,c)};return"undefined"!=typeof navigator&&navigator.msSaveOrOpenBlob?function(a,b,c){return c||(a=q(a)),navigator.msSaveOrOpenBlob(a,b||"download")}:(s.abort=function(){var a=this;a.readyState=a.DONE,p(a,"abort")},s.readyState=s.INIT=0,s.WRITING=1,s.DONE=2,s.error=s.onwritestart=s.onprogress=s.onwrite=s.onabort=s.onerror=s.onwriteend=null,t)}}("undefined"!=typeof self&&self||"undefined"!=typeof b&&b||this.content);k.fileSave=l;var m=function(b,c){var d="*"===b.filename&&"*"!==b.title&&b.title!==f?b.title:b.filename;return"function"==typeof d&&(d=d()),d.indexOf("*")!==-1&&(d=a.trim(d.replace("*",a("title").text()))),d=d.replace(/[^a-zA-Z0-9_\u00A1-\uFFFF\.,\-_ !\(\)]/g,""),c===f||c===!0?d+b.extension:d},n=function(a){var b="Sheet1";return a.sheetName&&(b=a.sheetName.replace(/[\[\]\*\/\\\?\:]/g,"")),b},o=function(b){var c=b.title;return"function"==typeof c&&(c=c()),c.indexOf("*")!==-1?c.replace("*",a("title").text()||"Exported data"):c},p=function(a){return a.newline?a.newline:navigator.userAgent.match(/Windows/)?"\r\n":"\n"},q=function(a,b){for(var c=p(b),d=a.buttons.exportData(b.exportOptions),e=b.fieldBoundary,g=b.fieldSeparator,h=new RegExp(e,"g"),i=b.escapeChar!==f?b.escapeChar:"\\",j=function(a){for(var b="",c=0,d=a.length;c<d;c++)c>0&&(b+=g),b+=e?e+(""+a[c]).replace(h,i+e)+e:a[c];return b},k=b.header?j(d.header)+c:"",l=b.footer&&d.footer?c+j(d.footer):"",m=[],n=0,o=d.body.length;n<o;n++)m.push(j(d.body[n]));return{str:k+m.join(c)+l,rows:m.length}},r=function(){return navigator.userAgent.indexOf("Safari")!==-1&&navigator.userAgent.indexOf("Chrome")===-1&&navigator.userAgent.indexOf("Opera")===-1};try{var s,t=new XMLSerializer}catch(a){}var u={"_rels/.rels":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/></Relationships>',"xl/_rels/workbook.xml.rels":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/><Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/></Relationships>',"[Content_Types].xml":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types"><Default Extension="xml" ContentType="application/xml" /><Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml" /><Default Extension="jpeg" ContentType="image/jpeg" /><Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml" /><Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml" /><Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml" /></Types>',"xl/workbook.xml":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?><workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"><fileVersion appName="xl" lastEdited="5" lowestEdited="5" rupBuild="24816"/><workbookPr showInkAnnotation="0" autoCompressPictures="0"/><bookViews><workbookView xWindow="0" yWindow="0" windowWidth="25600" windowHeight="19020" tabRatio="500"/></bookViews><sheets><sheet name="" sheetId="1" r:id="rId1"/></sheets></workbook>',"xl/worksheets/sheet1.xml":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?><worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships" xmlns:mc="http://schemas.openxmlformats.org/markup-compatibility/2006" mc:Ignorable="x14ac" xmlns:x14ac="http://schemas.microsoft.com/office/spreadsheetml/2009/9/ac"><sheetData/></worksheet>',"xl/styles.xml":'<?xml version="1.0" encoding="UTF-8"?><styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:mc="http://schemas.openxmlformats.org/markup-compatibility/2006" mc:Ignorable="x14ac" xmlns:x14ac="http://schemas.microsoft.com/office/spreadsheetml/2009/9/ac"><fonts count="5" x14ac:knownFonts="1"><font><sz val="11" /><name val="Calibri" /></font><font><sz val="11" /><name val="Calibri" /><color rgb="FFFFFFFF" /></font><font><sz val="11" /><name val="Calibri" /><b /></font><font><sz val="11" /><name val="Calibri" /><i /></font><font><sz val="11" /><name val="Calibri" /><u /></font></fonts><fills count="6"><fill><patternFill patternType="none" /></fill><fill/><fill><patternFill patternType="solid"><fgColor rgb="FFD9D9D9" /><bgColor indexed="64" /></patternFill></fill><fill><patternFill patternType="solid"><fgColor rgb="FFD99795" /><bgColor indexed="64" /></patternFill></fill><fill><patternFill patternType="solid"><fgColor rgb="ffc6efce" /><bgColor indexed="64" /></patternFill></fill><fill><patternFill patternType="solid"><fgColor rgb="ffc6cfef" /><bgColor indexed="64" /></patternFill></fill></fills><borders count="2"><border><left /><right /><top /><bottom /><diagonal /></border><border diagonalUp="false" diagonalDown="false"><left style="thin"><color auto="1" /></left><right style="thin"><color auto="1" /></right><top style="thin"><color auto="1" /></top><bottom style="thin"><color auto="1" /></bottom><diagonal /></border></borders><cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0" /></cellStyleXfs><cellXfs count="2"><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/></cellXfs><cellStyles count="1"><cellStyle name="Normal" xfId="0" builtinId="0" /></cellStyles><dxfs count="0" /><tableStyles count="0" defaultTableStyle="TableStyleMedium9" defaultPivotStyle="PivotStyleMedium4" /></styleSheet>'};return k.ext.buttons.copyHtml5={className:"buttons-copy buttons-html5",text:function(a){return a.i18n("buttons.copy","Copy")},action:function(b,d,e,f){var g=q(d,f),h=g.str,i=a("<div/>").css({height:1,width:1,overflow:"hidden",position:"fixed",top:0,left:0});f.customize&&(h=f.customize(h,f));var j=a("<textarea readonly/>").val(h).appendTo(i);if(c.queryCommandSupported("copy")){i.appendTo(d.table().container()),j[0].focus(),j[0].select();try{return c.execCommand("copy"),i.remove(),void d.buttons.info(d.i18n("buttons.copyTitle","拷贝到粘贴板"),d.i18n("buttons.copySuccess",{1:"拷贝 one 行 到 粘贴板",_:"拷贝 %d 行 到 粘贴板"},g.rows),2e3)}catch(a){}}var k=a("<span>"+d.i18n("buttons.copyKeys","Press <i>ctrl</i> or <i>⌘</i> + <i>C</i> to copy the table data<br>to your system clipboard.<br><br>To cancel, click this message or press escape.")+"</span>").append(i);d.buttons.info(d.i18n("buttons.copyTitle","拷贝到粘贴板"),k,0),j[0].focus(),j[0].select();var l=a(k).closest(".dt-button-info"),m=function(){l.off("click.buttons-copy"),a(c).off(".buttons-copy"),d.buttons.info(!1)};l.on("click.buttons-copy",m),a(c).on("keydown.buttons-copy",function(a){27===a.keyCode&&m()}).on("copy.buttons-copy cut.buttons-copy",function(){m()})},exportOptions:{},fieldSeparator:"\t",fieldBoundary:"",header:!0,footer:!1},k.ext.buttons.csvHtml5={className:"buttons-csv buttons-html5",available:function(){return b.FileReader!==f&&b.Blob},text:function(a){return a.i18n("buttons.csv","CSV")},action:function(a,b,d,e){var f=q(b,e).str,g=e.charset;e.customize&&(f=e.customize(f,e)),g!==!1?(g||(g=c.characterSet||c.charset),g&&(g=";charset="+g)):g="",l(new Blob([f],{type:"text/csv"+g}),m(e))},filename:"*",extension:".csv",exportOptions:{},fieldSeparator:",",fieldBoundary:'"',escapeChar:'"',charset:null,header:!0,footer:!1},k.ext.buttons.excelHtml5={className:"buttons-excel buttons-html5",available:function(){return b.FileReader!==f&&d!==f&&!r()&&t},text:function(a){return a.i18n("buttons.excel","Excel")},action:function(b,c,e,k){var o,p,q=0,r=function(b){var c=u[b];return a.parseXML(c)},s=r("xl/worksheets/sheet1.xml"),t=s.getElementsByTagName("sheetData")[0],v={_rels:{".rels":r("_rels/.rels")},xl:{_rels:{"workbook.xml.rels":r("xl/_rels/workbook.xml.rels")},"workbook.xml":r("xl/workbook.xml"),"styles.xml":r("xl/styles.xml"),worksheets:{"sheet1.xml":s}},"[Content_Types].xml":r("[Content_Types].xml")},w=c.buttons.exportData(k.exportOptions),x=function(b){o=q+1,p=i(s,"row",{attr:{r:o}});for(var c=0,d=b.length;c<d;c++){var e,h=g(c)+""+o;if(null!==b[c]&&b[c]!==f||(b[c]=""),"number"==typeof b[c]||b[c].match&&a.trim(b[c]).match(/^-?\d+(\.\d+)?$/)&&!a.trim(b[c]).match(/^0\d+/))e=i(s,"c",{attr:{t:"n",r:h},children:[i(s,"v",{text:b[c]})]});else{var j=b[c].replace?b[c].replace(/&(?!amp;)/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F-\x9F]/g,""):b[c];e=i(s,"c",{attr:{t:"inlineStr",r:h},children:{row:i(s,"is",{children:{row:i(s,"t",{text:j})}})}})}p.appendChild(e)}t.appendChild(p),q++};a("sheets sheet",v.xl["workbook.xml"]).attr("name",n(k)),k.customizeData&&k.customizeData(w),k.header&&(x(w.header,q),a("row c",s).attr("s","2"));for(var y=0,z=w.body.length;y<z;y++)x(w.body[y],q);k.footer&&w.footer&&(x(w.footer,q),a("row:last c",s).attr("s","2"));var A=i(s,"cols");a("worksheet",s).prepend(A);for(var B=0,C=w.header.length;B<C;B++)A.appendChild(i(s,"col",{attr:{min:B+1,max:B+1,width:j(w,B),customWidth:1}}));k.customize&&k.customize(v);var D=new d,E={type:"blob",mimeType:"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"};h(D,v),D.generateAsync?D.generateAsync(E).then(function(a){l(a,m(k))}):l(D.generate(E),m(k))},filename:"*",extension:".xlsx",exportOptions:{},header:!0,footer:!1},k.ext.buttons.pdfHtml5={className:"buttons-pdf buttons-html5",available:function(){return b.FileReader!==f&&e},text:function(a){return a.i18n("buttons.pdf","PDF")},action:function(b,c,d,f){var g=(p(f),c.buttons.exportData(f.exportOptions)),h=[];f.header&&h.push(a.map(g.header,function(a){return{text:"string"==typeof a?a:a+"",style:"tableHeader"}}));for(var i=0,j=g.body.length;i<j;i++)h.push(a.map(g.body[i],function(a){return{text:"string"==typeof a?a:a+"",style:i%2?"tableBodyEven":"tableBodyOdd"}}));f.footer&&g.footer&&h.push(a.map(g.footer,function(a){return{text:"string"==typeof a?a:a+"",style:"tableFooter"}}));var k={pageSize:f.pageSize,pageOrientation:f.orientation,content:[{table:{headerRows:1,body:h},layout:"noBorders"}],styles:{tableHeader:{bold:!0,fontSize:11,color:"white",fillColor:"#2d4154",alignment:"center"},tableBodyEven:{},tableBodyOdd:{fillColor:"#f3f3f3"},tableFooter:{bold:!0,fontSize:11,color:"white",fillColor:"#2d4154"},title:{alignment:"center",fontSize:15},message:{}},defaultStyle:{fontSize:10}};f.message&&k.content.unshift({text:f.message,style:"message",margin:[0,0,0,12]}),f.title&&k.content.unshift({text:o(f,!1),style:"title",margin:[0,0,0,12]}),f.customize&&f.customize(k,f);var n=e.createPdf(k);"open"!==f.download||r()?n.getBuffer(function(a){var b=new Blob([a],{type:"application/pdf"});l(b,m(f))}):n.open()},title:"*",filename:"*",extension:".pdf",exportOptions:{},orientation:"portrait",pageSize:"A4",header:!0,footer:!1,message:null,customize:null,download:"download"},k.Buttons});