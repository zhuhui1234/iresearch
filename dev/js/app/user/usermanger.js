/**
 * Created by robinwong51 on 27/10/2016.
 */
/*! datatables */
define(['jquery', 'helper', 'api', 'datatables.net', 'datatables.net-bs', 'select2'], function ($, Helper, api) {
    $(function () {
        console.log('Module datatables loaded');
        $('#sidebar_userManager').addClass('active');
        var table = function () {
            $('#user-manger-tb').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": api.getUserInfoList,
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
                "columns": [
                    {
                        'data': 'u_account',
                        mRender: function (data, type, full) {
                            console.log(full.u_head);
                            if (full.u_head == null || full.u_head == '' || full.u_head == 'head.png' || full.u_head == 'head2.png') {
                                return '<img src="public/img/user-head.png" />' + data;
                            } else {
                                return '<img src="' + api.user_head + full.u_head + '"/>' + data;
                            }
                        }
                    },
                    {'data': 'u_department'},
                    {'data': 'u_position'},
                    {
                        'data': 'u_state', mRender: function (data, type, full) {
                        if (data == 0) {
                            return '<span class="text-primary">已有权限</span>';
                        } else if (data == 1) {
                            return '<span class="text-danger">已冻结</span>';
                        } else {
                            return '<span class="text-danger">未知</span>';
                        }
                    }
                    },
                    {
                        'data': 'u_id', mRender: function (data, type, full) {
                        return '<a href="?m=user&a=userAccessDetail&u_account=' + full.u_account + '"><i class="fa fa-edit"></i></a>';
                    }
                    }

                ],
                //禁止排序
                ordering: false,
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
        };
        /**
         获取json数据请参考下面地址
         */
        // https://datatables.net/reference/api/ajax.json()
        /**
         拷贝导出
         */
        //table.buttons().container().appendTo( $('.dbt', table.table().container()));
        table();
    });

    $('.data-select').select2({
        theme: "bootstrap",
        placeholder: "请选择",
        minimumResultsForSearch: Infinity,
    });
});

