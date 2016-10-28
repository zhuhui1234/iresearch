/**
 *
 * Created with JetBrains PhpStorm.
 * User: david
 * Date: 16-9-26
 * Time: 上午11:11
 * To change this template use File | Settings | File Templates.
 */
define(['jquery','helper', 'treeview', 'datatables.net', 'datatables.net-bs', 'select2'], function ($,Helper) {
    console.log('Module treeview.init loaded.');
    // console.log($.fn.bootstrapSwitch);
    $('#sidebar_permissionAccess').addClass('active');
    $(function () {
        function setReport(cfg_model) {
            // var rs = false;
            // var url = '?m=industry&a=getConfigListJsonAPI';
            // $.ajax({
            //     async: false,
            //     type: 'POST',
            //     data: {"cfg_id": cfg_id},
            //     url: url,
            //     success: function (res) {
            //         rs = $.parseJSON(res);
            //         rs = rs.content;
            //     }
            // });
            // return rs;
            var rs = false;
            Helper.post('getConfigListJsonAPI',{"cfg_model": cfg_model},function(res){
                rs = res.content;
            });
            return rs;
        }

        function getPermissionsList(cfg_id) {
            var rs = false;
            var url = '?m=industry&a=getPermissionsListAPI';
            // $.ajax({
            //     type: 'POST',
            //     data: {"cfg_id": cfg_id},
            //     url: url,
            //     success: function (res) {
            //         rs = $.parseJSON(res);
            //     }
            // });
            Helper.post('getPermissionsListAPI',{"cfg_id": cfg_id},function(res){
                rs = res;
            });
            return rs;
        }

        var table;
        var defaultData = setReport(7);
        drawTable(1);
        $('#treeview').treeview({
            showTags: true,
            data: defaultData,
            onNodeSelected: function (event, data) {
                table.destroy();
                drawTable(data.cfg_id);
            }
        });
        $("#bigIndustry").on("change", function (e) {
            var bigClass = $(this).val();
            // var url = '?m=industry&a=getMinIndustryAPI';
            // $.ajax({
            //     type: 'POST',
            //     data: {"ity_sid": bigClass},
            //     url: url,
            //     success: function (res) {
            //         rs = $.parseJSON(res);
            //         var smallClass = rs.content.data.IndustryMinList;
            //         var smallClassArray = new Array();
            //         $.each(smallClass, function (n, value) {
            //             smallClassArray[n] = {"id": value.ity_id, "text": value.ity_name};
            //         });
            //         $("#smallIndustry").html("");
            //         $("#smallIndustry").select2({
            //             data: smallClassArray,
            //             theme: "bootstrap",
            //             tags: true
            //         });
            //         showTree();
            //     }
            // });
            Helper.post('getMinIndustryAPI',{"ity_sid": bigClass},function(res){
                        rs = res;
                        var smallClass = rs.content.data.IndustryMinList;
                        var smallClassArray = new Array();
                        $.each(smallClass, function (n, value) {
                            smallClassArray[n] = {"id": value.ity_id, "text": value.ity_name};
                        });
                        $("#smallIndustry").html("");
                        $("#smallIndustry").select2({
                            data: smallClassArray,
                            theme: "bootstrap",
                            tags: true
                        });
                        showTree();
            });

        });
        function showTree() {
            var smallClassID = $("#smallIndustry").val();
            var defaultData = setReport(smallClassID);
            $('#treeview').treeview({
                showTags: true,
                data: defaultData,
                onNodeSelected: function (event, data) {
                    table.destroy();
                    drawTable(data.cfg_id);
                }
            });
        }

        function drawTable(cfg_id) {
            table = $('#user-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "?m=industry&a=getPermissionsListAPI&cfg_id=" + cfg_id,
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
                drawCallback: function (settings) {
                    //样式覆盖
                    $('[data-toggle="checkbox"]').click(function () {
                        if ($(this).val() > 0) {
                            console.log($(this).val());
                            console.log($(this).attr("name"));
                        }
                    });
                    $('[name="setAll"]').click(function () {
                        $("._setPerm").each(function () {
//                            $(this).removeAttr("checked");
                            $(this).prop("checked",false);
                        });
                        $("." + $(this).val()).each(function () {
                            $(this).prop("checked", true);
                        });
                    });
                    $('[data-toggle="checkbox"]').radiocheck();
                },
                pageLength: 10,
                "columns": [
                    { "data": "u_account" },
                    {
                        "data": "adt_state",
                        mRender: function (data, type, full) {
                            if (data == 1) {
                                var rs = '<div class="checkbox"><label><input type="radio" name="' + full.u_account + '" class="_p_yes _setPerm" data-toggle="checkbox" checked="true" value="0"></label></div>';
                                return rs;
                            } else {
                                var rs = '<div class="checkbox"><label><input type="radio" name="' + full.u_account + '" class="_p_yes _setPerm" data-toggle="checkbox" value="1" ></label></div>';
                                return rs;
                            }
                        }
                    },
                    {
                        "data": "adt_state",
                        mRender: function (data, type, full) {
                            if (data == 3) {
                                var rs = '<div class="checkbox"><label><input type="radio" name="' + full.u_account + '" class="_p_no _setPerm" data-toggle="checkbox" checked="true" value="0"></label></div>';
                                return rs;
                            } else {
                                var rs = '<div class="checkbox"><label><input type="radio" name="' + full.u_account + '" class="_p_no _setPerm" data-toggle="checkbox" value="3"></label></div>';
                                return rs;
                            }
                        }
                    },
                    {
                        "data": "adt_state",
                        mRender: function (data, type, full) {
                            if (data == 4) {
                                var rs = '<div class="checkbox"><label><input type="radio" name="' + full.u_account + '" class="_p_hidden _setPerm" data-toggle="checkbox" checked="true" value="0"></label></div>';
                                return rs;
                            } else {
                                var rs = '<div class="checkbox"><label><input type="radio" name="' + full.u_account + '" class="_p_hidden _setPerm" data-toggle="checkbox" value="4"></label></div>';
                                return rs;
                            }
                        }
                    }
                ],
                ordering: false
            });
        }
    });
});