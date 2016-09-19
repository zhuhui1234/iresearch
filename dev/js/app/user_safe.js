define(['jquery', 'validator'], function ($) {
    console.log('Module bootstrapvalidator loaded.');
    //表单验证
    $(function () {
        $('#user_safe').bootstrapValidator({
            feedbackIcons: {
                valid: 'fa fa-check',
                invalid: 'fa fa-remove',
                validating: 'fa fa-refresh'
            },
            fields: {
                nowpsw: {
                    validators: {
                        notEmpty: {
                            message: '请输入当前密码'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: '密码长度6位到30位'
                        },
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: '新密码不能为空'
                        },
                        identical: {
                            field: 'confirmPassword',
                            message: '两次密码不一致'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: '密码长度6位到30位'
                        },
                    }
                },
                confirmPassword: {
                    validators: {
                        notEmpty: {
                            message: '确认新密码不能为空'
                        },
                        identical: {
                            field: 'password',
                            message: '两次密码不一致'
                        },

                    }
                },
            }
        })
        //ajax验证

            .on('success.form.bv', function (e) {
                // Prevent form submission
                e.preventDefault();

                // Get the form instance
                var $form = $(e.target);

                // Get the BootstrapValidator instance
                var bv = $form.data('bootstrapValidator');

                // Use Ajax to submit form data
                $.post($form.attr('action'), $form.serialize(), function (result) {
                    console.log(result);
                }, 'json');
            });
    });
});