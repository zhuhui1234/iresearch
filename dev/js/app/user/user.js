/**
 * Created by robinwong51 on 03/01/2017.
 */
/**
 * Created by Hank on 2016/12/28.
 */
define(['app/main','cropper','cropper-main','upload','app/user/left-menu'], function() {
    $(function () {
        $('#avatarInput').filestyle({
            input : false,
            iconName : 'fa fa-folder-open',
            buttonText: '选择照片',
            buttonName : 'btn-primary'
        });
    });

});
