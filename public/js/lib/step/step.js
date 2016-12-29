/*! iResearchView-1.0.0-2016-09-21 */
/**
 * @license step 0.0.1 Copyright jQuery Foundation and other contributors.
 * Released under MIT license, http://github.com/requirejs/step/LICENSE
 */
define(["module"],function(a){"use strict";function b(a){d={},e=a.steps;var b,c,f,g;for(b=0;b<e.length&&(f=e[b]);b+=1);for(c=0;c<f.length&&(g=f[c]);c+=1)d[g]=b}function c(a,b,c){function f(){g<h?b(e[g],function(){g+=1,f()}):b([a],c)}var g=0,h=d[a];f()}var d,e;return{version:"0.0.1",load:function(e,f,g,h){d||b(a.config()),d.hasOwnProperty(e)?c(e,f,g):g.error(new Error("No step config for ID: "+e))}}});