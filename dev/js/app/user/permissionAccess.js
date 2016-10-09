/**
 * Created with JetBrains PhpStorm.
 * User: david
 * Date: 16-9-26
 * Time: 上午11:11
 * To change this template use File | Settings | File Templates.
 */
define(['jquery', 'datatables.net', 'datatables.net-bs', 'select2'], function ($) {
    $(function () {
        console.log('Module datatables loaded');
        var table = $('#user-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "?m=industry&a=getPermissionsListAPI&cfg_id=1",
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
                }
            },
            pageLength:2,
            "columns": [
                { "data": "u_account" },
                { "data": "cfg_id" },
                { "data": "adt_state" },
                {
                    "data": "adt_state",
                    mRender: function (data, type, full) {
                        if (data == 1) {
                            return '是';
                        } else {
                            return '否';
                        }
                    }
                }
            ],
            ordering:true
        });
    });

});
