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
                    console.log(rs);
                }
            });
            return rs;
        }
        function getPermissionsList(cfg_id){
            var rs = false;
            var url = '?m=industry&a=getPermissionsListAPI';
            $.ajax({
                async: false,
                type: 'POST',
                data: {"cfg_id": cfg_id},
                url: url,
                success: function (res) {
                    rs = $.parseJSON(res);
                    console.log(rs);
                }
            });
            return rs;
        }
        var defaultData = setReport(7);
        $('#treeview').treeview({
            showTags: true,
            data: defaultData
        });
    });
});