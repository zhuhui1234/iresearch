/**
 * Created by robinwong51 on 03/01/2017.
 */
/**
 * Created by Hank on 2016/12/28.
 */
define(['helper', 'app/main', 'cropper', 'cropper-main', 'upload', 'app/user/left-menu'], function (Helper) {
    $(function () {
        $("#sidebar_userInfo").addClass("active");

        $('#avatarInput').filestyle({
            input: false,
            iconName: 'fa fa-folder-open',
            buttonText: '选择照片',
            buttonName: 'btn-primary'
        });

        $(".userAvatar").error(function () {
            $(this).attr('src', './public/img/head_default.png');
        });

        $("#saveMyInfo").click(function () {
            var pStatus = true;
            var myInfo = {};
            if ($('#username').val().length > 0) {
                myInfo.uname = $('#username').val();
            }

            if ($("#position").val().length > 0) {
                myInfo.position = $("#position").val();
            }

            if ($('.avatar-src').val().length > 0) {
                myInfo.headImg = $('.avatar-src').val();
            }

            if (Object.keys(myInfo).length > 0) {
                console.log(myInfo);
                Helper.post('updateUserInfo', myInfo, function (ret) {
                    console.log(ret);
                    alert(ret.resMsg);
                    location.reload();
                }, function (errRet) {
                    alert("更新错误");
                });
            }
        });

        //SCAN WECHAT
        Helper.WeChatQRCode('bindingWeChat', 'bindingUser','https://ic.irs01.com/iResearchDataWeb/public/css/wechat.css');

    });

});
