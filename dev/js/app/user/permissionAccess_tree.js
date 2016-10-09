/**
 *
 * Created with JetBrains PhpStorm.
 * User: david
 * Date: 16-9-26
 * Time: 上午11:11
 * To change this template use File | Settings | File Templates.
 */
define(['jquery', 'treeview'], function ($) {

    console.log('Module treeview.init loaded.');
    // console.log($.fn.bootstrapSwitch);
    $(function () {

        function setReport(cfg_id) {
            var rs = false;
            var url = '?m=industry&a=getConfigListJsonAPI';
            $.ajax({
                async: false,
                type: 'POST',
                data: {"cfg_id": cfg_id},
                url: url,
                success: function (res) {
                    rs = $.parseJSON(res);
                    rs = rs.content;
                }
            });
            return rs;
        }

        function getPermissionsList(cfg_id) {
            var rs = false;
            var url = '?m=industry&a=getPermissionsListAPI';
            $.ajax({
                async: false,
                type: 'POST',
                data: {"cfg_id": cfg_id},
                url: url,
                success: function (res) {
                    rs = $.parseJSON(res);
                }
            });
            return rs;
        }

        var defaultData = setReport(7);
        $('#treeview').treeview({
            showTags: true,
            data: defaultData,
            onNodeSelected: function (event, data) {
                console.log(data);
            }
        });
        $("#bigIndustry").on("change", function (e) {
            var bigClass = $(this).val();
            var url = '?m=industry&a=getMinIndustryAPI';
            $.ajax({
                type: 'POST',
                data: {"ity_sid": bigClass},
                url: url,
                success: function (res) {
                    rs = $.parseJSON(res);
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
                }
            });
        });
        function showTree() {
            var smallClassID = $("#smallIndustry").val();
            var defaultData = setReport(smallClassID);
            $('#treeview').treeview({
                showTags: true,
                data: defaultData,
                onNodeSelected: function (event, data) {
                    console.log(data);
                }
            });
        }
    });
});