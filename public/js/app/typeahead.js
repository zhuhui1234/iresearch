/*! iResearchView-1.0.0-2016-09-21 */
define(["jquery","typeahead"],function(a){a(function(){var b=function(b){return function(c,d){var e;e=[],substrRegex=new RegExp(c,"i"),a.each(b,function(a,b){substrRegex.test(b)&&e.push(b)}),d(e)}},c=["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Carolina","North Dakota","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"];a("#typeahead").typeahead({hint:!0,highlight:!0,minLength:1},{name:"states",source:b(c)})})});