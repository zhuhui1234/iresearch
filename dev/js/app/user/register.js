/**
 * Created by robinwong51 on 9/21/16.
 */
define(["helper", "jquery", "bootstrap", "validator"], function (helper, $) {
    console.log('Module register bootstrapvalidator loaded.');

    $(function () {
        console.log(helper);
        //helper.WeChatQRCode('wxLogin','wxLogin');
        $('#registerMail').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'fa fa-check',
                invalid: 'fa fa-remove',
                validating: 'fa fa-refresh'
            },
            fields: {
                registerMail: {
                    validators: {
                        notEmpty: {
                            message: '邮箱不能为空'
                        },
                        emailAddress: {
                            message: '请输入正确的邮箱格式'
                        }
                    }
                },
                vcode: {
                    validators: {
                        notEmpty: {
                            message: '请输入验证码'
                        }
                    }
                }


            }

        })
            .on('success.form.bv', function (e) {
                // Prevent form submission
                e.preventDefault();

                // Get the form instance
                var $form = $(e.target);

                // Get the BootstrapValidator instance
                var bv = $form.data('bootstrapValidator');

                $.post($form.attr('action'), $form.serialize())
                    .done(function (data) {
                        console.log(data);

                        if (data.resCode == "000000") {
                            alert('我们已经向您发送了注册邀请邮件, 请查看邮件,完成注册! 谢谢');
                            window.location.href = '?m=index'
                        } else {
                            alert(data.resMsg)
                        }
                    });
            });

        /**
         * 注册完善
         */
        $("#registerUserInfo").bootstrapValidator({
            message: '输入的信息不正确',
            feedbackIcons: {
                valid: 'fa fa-check',
                invalid: 'fa fa-remove',
                validating: 'fa fa-refresh'
            },
            field: {
                u_account: {
                    validators: {
                        notEmpty: {
                            message: '账号不能为空'
                        }
                    }
                },
                u_department: {},
                u_mobile: {
                    validators: {
                        notEmpty: {
                            message: '手机不能为空'
                        }
                    }
                },
                u_name: {
                    validators: {
                        notEmpty: {
                            message: '姓名不能为空'
                        }
                    }
                },
                u_password: {
                    validators: {
                        notEmpty: {
                            message: '密码不能为空'
                        }
                    }
                },
                u_position: {}
            }
        })
            .on('success.form.bv', function (e) {
                // Prevent form submission
                e.preventDefault();

                // Get the form instance
                var $form = $(e.target);

                // Get the BootstrapValidator instance
                var bv = $form.data('bootstrapValidator');

                $.post($form.attr('action'), $form.serialize())
                    .done(function (data) {
                        console.log(data);

                        if (data.resCode == "000000") {
                            alert('注册成功! 请在首页登入使用!');
                            window.location.href = '?m=index';
                        } else {
                            alert(data.resMsg)
                        }
                    });
            });


    });  // in function

});