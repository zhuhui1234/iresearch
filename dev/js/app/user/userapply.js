/*! datatables */
define(['jquery', 'helper', 'api', 'datatables.net', 'datatables.net-bs'], function ($, helper, api) {
    $(function () {
        console.log('Module datatables loaded');
        $('#sidebar_applyManager').addClass('active');

        /**
         * 权限表
         */
        var table = function () {
            console.log(api.getAuditList);
            $('#user-table').DataTable({
                ajax: api.getAuditList,
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
                bLengthChange: false,
                searching: false,
                ordering: false,
                drawCallback: function (settings) {
                    var dtApi = this.api();
                    $('.allow').click(function () {
                        console.log($(this).attr('adt_id'));
                        var ret = confirm('确定要审核通过吗？');
                        if (ret) {

                            console.log('ok');
                            helper.post('upAudit', {'adt_id': $(this).attr('adt_id'), 'adt_state': 1}, function (ret) {
                                console.log(ret);
                                dtApi.ajax.reload();
                            })
                        } else {
                            console.log('cancel');
                        }
                    });

                    $('.deny').click(function () {
                        var ret = confirm('确认拒绝通过该申请吗？');
                        if (ret) {
                            console.log('deny');
                            helper.post('upAudit', {'adt_id': $(this).attr('adt_id'), 'adt_state': 2}, function (ret) {
                                console.log(ret);
                                dtApi.ajax.reload();
                            });
                        }
                    });
                },
                "columns": [
                    {'data': 'u_account'},
                    {
                        'data': 'adt_id', mRender: function (data, type, full) {
                        return '无名';
                    }
                    },
                    {'data': 'adt_mobile'},
                    {'data': 'cfg_name'},
                    {'data': 'adt_cdate'},
                    {
                        'data': 'adt_id', mRender: function (data, type, full) {
                        if (parseInt(full.adt_state == 0)) {
                            return '<button type="button" adt_id="' + data + '" class="allow btn btn-primary btn-xs mrm">通过</button>' +
                                '<button adt_id="' + data + '" type="button" class="btn deny btn-warning btn-xs">拒绝</button>';
                        }else{
                            if (parseInt(full.adt_state) == 1) {
                                return '<span class="text-primary">已通过审核</span>'
                            }else{
                                return '<span class="text-danger">审核已被拒绝</span>'
                            }
                        }

                    }
                    }
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

