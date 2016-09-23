/**
 * user login js
 */
define(['jquery', 'helper', 'validator'], function ($, Helper) {
    $(function () {
        $("#userLogin").bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'fa fa-check',
                invalid: 'fa fa-remove',
                validating: 'fa fa-refresh'
            },
            field: {
                email: {
                    validators: {
                        notEmpty: {
                            message: '邮箱不能为空'
                        },
                        emailAddress: {
                            message: '请输入正确的邮箱格式'
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
                            alert('登入成功');
                            window.location.href = '?m=index'
                        } else {
                            alert(data.resMsg)
                        }
                    });
            });
    });
});