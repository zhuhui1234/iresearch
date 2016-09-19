define(['jquery','select2'], function($) {
    console.log('Module select.init loaded.');
    $('[data-toggle="select"]').select2({
        theme: "bootstrap",
        placeholder: "请选择",
        minimumResultsForSearch: Infinity,
    });
    $('[data-toggle="select-tag"]').select2({
        theme: "bootstrap",
        placeholder: "请选择",
        tags: true
    });
});