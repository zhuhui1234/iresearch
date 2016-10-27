/*! datatables */
define(['jquery','helper','api','datatables.net','datatables.net-bs'],function($,helper,api){
    $(function(){
        console.log('Module datatables loaded');
        $('#sidebar_applyManager').addClass('active');
        var table = function(){
            console.log(api.getAuditList);
            $('#user-table').DataTable( {
                ajax:api.getAuditList,
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
                bLengthChange: false,
                searching: false,
                ordering:false,
                "columns":[
                    {'data':'u_account'},
                    {'data':'adt_id',mRender:function(data, type,full){
                        return '无名';
                    }},
                    {'data':'adt_mobile'},
                    {'data':'cfg_name'},
                    {'data':'adt_cdate'},
                    {'data':'adt_id',mRender:function(data, type,full){
                        return '<button type="button" class="btn btn-primary btn-xs mrm">通过</button><button type="button" class="btn btn-warning btn-xs">拒绝</button>';
                    }}
                ]
            });
        };

        table();
        /**
         获取json数据请参考下面地址
         */
        // https://datatables.net/reference/api/ajax.json()
        /**
         拷贝导出
         */
        //table.buttons().container().appendTo( $('.dbt', table.table().container()));
    });
});

