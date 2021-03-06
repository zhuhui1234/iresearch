/*! datatables */
define(['jquery','datatables.net','datatables.net-bs','select2'],function($){
    $(function(){
        console.log('Module datatables loaded');
        var table = $('#user-table').DataTable( {
            language: {
                "sProcessing": "处理中...",
                "sLengthMenu": "显示 _MENU_ 项结果",
                "sZeroRecords": "没有匹配结果",
                "sInfo": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
                "sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
                "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
                "sInfoPostFix": "",
                "sSearch": "搜索:",
                "sUrl": "",
                "sEmptyTable": "表中数据为空",
                "sLoadingRecords": "载入中...",
                "sInfoThousands": ",",
                "oPaginate": {
                    "sFirst": "首页",
                    "sPrevious": "<i class='fa fa-angle-left'></i>",
                    "sNext": "<i class='fa fa-angle-right'></i>",
                    "sLast": "末页"
                },
                "buttons":{
                    "copy": "拷贝",
                    "excel": "导出Excel",
                    "pdf": "导出PDF"
                },
                "oAria": {
                    "sSortAscending": ": 以升序排列此列",
                    "sSortDescending": ": 以降序排列此列"
                }
            },
            //禁止排序
            ordering:false,
            //指定禁止排序的列
            // columnDefs:[{
            //     orderable:false,//禁用排序
            //     targets:[0,4]   //指定的列
            // }]
            //按钮
            // buttons: [
            //     'copy', 'excel', 'pdf'
            // ]
        });
        /**
         获取json数据请参考下面地址
         */
        // https://datatables.net/reference/api/ajax.json()
        /**
         拷贝导出
         */
        //table.buttons().container().appendTo( $('.dbt', table.table().container()));
    });
    $('.data-select').select2({
        theme: "bootstrap",
        placeholder: "请选择",
        minimumResultsForSearch: Infinity,
    });
});

