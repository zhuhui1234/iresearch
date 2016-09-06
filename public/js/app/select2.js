/*! iResearchView-1.0.0-2016-08-15 */
define(["jquery", "select2"], function (a) {
    a('[data-toggle="select"]').select2({theme: "bootstrap", placeholder: "请选择"}), a('[data-toggle="select-hidesearch"]').select2({theme: "bootstrap", placeholder: "请选择", minimumResultsForSearch: 1 / 0}), a('[data-toggle="select-tag"]').select2({theme: "bootstrap", placeholder: "请选择", tags: !0})
});