/*! requirejs config */
requirejs.config({
    baseUrl: 'js',
    paths: {
        'jquery': 'lib/jquery/v2.1.4/jquery.min',
        'slider': 'lib/bootstrap-slider/bootstrap-slider',
        'bootstrap': 'lib/bootstrap/v3.3.6/bootstrap.min',
        'html5shiv': 'lib/bootstrap/v3.3.6/html5shiv.min',
        'respond': 'lib/bootstrap/v3.3.6/respond.min',
        'boostrap-hover-dropdown': 'lib/bootstrap/v3.3.6/boostrap-hover-dropdown',
        'datatables.net': 'lib/datatable/v1.10.9/jquery.dataTables',
        'datatables.net-bs': 'lib/datatable/v1.10.9/dataTables.bootstrap',
        'datatables.net-buttons': 'lib/datatable/v1.10.9/dataTables.buttons',
        'buttons.bootstrap': 'lib/datatable/v1.10.9/buttons.bootstrap',
        'buttons.colVis': 'lib/datatable/v1.10.9/buttons.colVis',
        'buttons.flash': 'lib/datatable/v1.10.9/buttons.flash',
        'buttons.html5': 'lib/datatable/v1.10.9/buttons.html5',
        'buttons.print': 'lib/datatable/v1.10.9/buttons.print',
        'daterangepicker': 'lib/daterangepicker/v2.1.13/daterangepicker',
        'moment': 'lib/daterangepicker/v2.1.13/moment.min',
        'datetimepicker': 'lib/datetimepicker/v2.0.0/datetimepicker.min',
        'lazyload': 'lib/lazyload/v1.9.1/lazyload.min',
        'swiper': 'lib/swiper/v3.3.1/swiper.min',
        'headroom': 'lib/headroom/v0.9.3/headroom',
        'headroom-jq': 'lib/headroom/v0.9.3/jQuery.headroom',
        'fastclick': 'lib/fast-click/fastclick',
        'radiocheck': 'lib/radiocheck/radiocheck',
        'select2': 'lib/select2/select',
        'select2-zh-CN': 'lib/select2/select2-zh-CN',
        'switch': 'lib/switch/v3.0.2/bootstrap-switch.min',
        'upload': 'lib/upload/upload',
        'typeahead': 'lib/typeahead/typeahead.jquery',
        'prettify':'lib/prettify/prettify',
        'treeview': 'lib/treeview/bootstrap-treeview',
        'nprogress': 'lib/nprogress/nprogress',
        'sticky':'lib/sticky/jquery.sticky',
        'pjax': 'lib/pjax/jquery.pjax',
        'validator':'lib/bootstrapValidator/bootstrapValidator',
        'handsontable': 'lib/handsontable/handsontable.full.min',
        'radialIndicator':'lib/radialIndicator/radialIndicator',
        'wow': 'lib/wow/wow',
        'scrollbar': 'lib/jquery.slimscroll/jquery.slimscroll',
        'cropper': 'lib/cropper/cropper',
        // 'wxLogin':"empty:"
        'wxLogin':'http://res.wx.qq.com/connect/zh_CN/htmledition/js/wxLogin',
        'api':'apiurl',
        'helper':'lib/helper'
    },
    shim: {
        'jquery': {
            exports: '$'
        },
        'datatables.net': {
            deps: ['jquery'],
            exports: '$'
        },
        'bootstrap': {
            deps: ['jquery','html5shiv','respond','boostrap-hover-dropdown'],
            exports: 'bootstrap'
        },
        'boostrap-hover-dropdown': {
            deps: ['jquery'],
            exports: '$'
        },
        'slider': {
            deps: ['jquery'],
            exports: '$'
        },
        'validator': {
            deps: ['jquery'],
            exports: '$'
        },
        'daterangepicker': {
            deps: ['jquery'],
            exports: '$'
        },
        'datetimepicker': {
            deps: ['jquery'],
            exports: '$'
        },
        'lazyload': {
            deps: ['jquery'],
            exports: '$'
        },
        'upload': {
            deps: ['jquery'],
            exports: '$'
        },
        'radiocheck': {
            deps: ['jquery'],
            exports: '$'
        },
        'select2': {
            deps: ['jquery'],
            exports: '$'
        },
        'select2-zh-CN':{
            deps: ['jquery','select2'],
            exports: '$'
        },
        'swiper': {
            exports:'swiper'
        },
        'prettify': {
            exports:'prettify'
        },
        'bootsnav':{
            deps: ['jquery'],
            exports: '$'
        },
        'headroom-jq': {
            deps: ['jquery'],
            exports: '$'
        },
        'switch': {
            deps: ['jquery'],
            exports: '$'
        },
        'typeahead': {
            deps: ['jquery'],
            exports: '$'
        },
        'treeview': {
            deps: ['jquery'],
            exports: '$'
        },
        'sticky': {
            deps: ['jquery'],
            exports: '$'
        },
        'pjax': {
            deps: ['jquery'],
            exports: '$'
        },
        'handsontable': {
            deps: ['css!./lib/handsontable//handsontable.css'],
            exports: 'Handsontable'
        },
        'radialIndicator': {
            deps: ['jquery'],
            exports: '$'
        },
        'wow': {
            exports: 'wow'
        },
        'scrollbar': {
            deps: ['jquery'],
            exports: '$'
        },
        'cropper': {
            deps: ['jquery'],
            exports: '$'
        }
    },
    config: {
        moment:{
            noGlobal: true
        }
    }
});

require(['app/main']);
