/**
 * Created by robinwong51 on 07/09/2017.
 */

define(['jquery', 'datatables.net', 'datatables.net-bs', 'select2'], function ($) {
    $(function () {
        var table = $('#point_log').DataTable({
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
                "buttons": {
                    "copy": "拷贝",
                    "excel": "导出Excel",
                    "pdf": "导出PDF"
                },
                "oAria": {
                    "sSortAscending": ": 以升序排列此列",
                    "sSortDescending": ": 以降序排列此列"
                }
            },
            "ajax": "?m=user&a=pointListAPI",
            "columns": [
                {
                    "data": "point_explain",
                    "mRender": function (data, type, full) {

                        if (data !== null && data !== '') {
                            console.log(data);
                            console.log(data.indexOf('{'));
                            if (data.indexOf('}') >= 0) {
                                var ret = JSON.parse(data);
                                if (typeof(ret.Type !== 'undefined')) {
                                    ret.Type = parseInt(ret.Type);
                                    switch (ret.Type) {
                                        case 6:
                                            return "定制报告ID:" + ret.ID + ", 定制报告名称: " + ret.Name;
                                            break;
                                        default :
                                            return ret.Name;
                                            break;
                                    }
                                }
                            } else {
                                return data;
                            }

                        } else {
                            return '无内容';
                        }
                    }
                },
                {
                    "data": "u_name",
                    "mRender": function (data, type, full) {
                        if (data == null || data == '') {
                            return '匿名';
                        } else {
                            return data;
                        }
                    }
                },
                {
                    "data": "type",
                    "mRender": function (data) {
                        switch (data) {
                            case "1":
                                return '充值';
                                break;
                            case "2":
                                return '撤销';
                                break;
                            case "6":
                                return '定制报告';
                                break;
                            case "7":
                                return '撤销定制报告';
                                break;
                            default :
                                return data;
                                break;
                        }

                    }
                },
                {
                    "data": "point_value",
                    "mRender": function (data, type, full) {
                        if (parseInt(full.type) > 5) {
                            var sin = '-'
                        } else {
                            var sin = '';
                        }
                        return sin + data;
                    }
                },
                {
                    "data": "balance"
                },
                {
                    "data": "cdate"
                }
            ]
            //禁止排序
            // ordering:false,
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

    });

});
