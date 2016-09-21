define(['jquery','domReady','validator'], function ($,domReady,sd) {
    console.log('Module bootstrapvalidator loaded.');
    //表单验证
    domReady(function(){
        $(function () {
            if (typeof sd == "undefined")
            {
                console.log(sd);
            }
            $('#loginForm').bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'fa fa-check',
                    invalid: 'fa fa-remove',
                    validating: 'fa fa-refresh'
                },
                fields: {
                    username: {
                        message: '用户名无效',
                        validators: {
                            notEmpty: {
                                message: '用户名不能为空'
                            },
                            //密码长度
                            // stringLength: {
                            //     min: 6,
                            //     max: 30,
                            //     message: 'The username must be more than 6 and less than 30 characters long'
                            // },
                            /*remote: {
                             url: 'remote.php',
                             message: 'The username is not available'
                             },*/
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: '密码不能为空'
                            },
                            stringLength: {
                                min: 6,
                                max: 30,
                                message: '密码长度6位到30位'
                            },
                        }
                    },
                    verification: {
                        validators: {
                            notEmpty: {
                                message: '请输入验证码'
                            }
                        }
                    },
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
                    psw: {
                        validators: {
                            notEmpty: {
                                message: '新密码不能为空'
                            },
                            stringLength: {
                                min: 6,
                                max: 30,
                                message: '密码长度6位到30位'
                            },
                            identical: {
                                field: 'confirmPassword',
                                message: '两次密码不一致'
                            }
                        }
                    },
                    confirmpsw: {
                        validators: {
                            notEmpty: {
                                message: '新密码不能为空'
                            },
                            identical: {
                                field: 'password',
                                message: '两次密码不一致'
                            }
                        }
                    },
                }
            });

            $('#index-login').bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'fa fa-check',
                    invalid: 'fa fa-remove',
                    validating: 'fa fa-refresh'
                },
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: '邮箱不能为空'
                            },
                            emailAddress: {
                                message: '请输入正确的邮箱格式'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: '密码不能为空'
                            }
                        }
                    },
                    yzm: {
                        validators: {
                            notEmpty: {
                                message: '请输入验证码'
                            }
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
});