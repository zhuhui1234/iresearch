define(['app/main'], function() {
    ;(function($) {
        $.fn.extend({
            getSms: function(value) {
                value = $.extend(
                    {
                        wait: 60 //参数, 默认60秒
                    },
                    value
                )
                var id = $(this).attr('id')
                var wait = value.wait
                //内部函数
                function time(id) {
                    if (wait == 0) {
                        $('#' + id).removeClass('disabled')
                        $('#' + id).text('获取验证码')
                        wait = value.wait
                    } else {
                        $('#' + id).addClass('disabled')
                        $('#' + id).text('重新发送(' + wait + ')')
                        wait--
                        setTimeout(function() {
                            time(id)
                        }, 1000)
                    }
                }
                $(this).click(function() {
                    time(id)
                })
            }
        })
    })(jQuery)
    $(function() {
        $('#verification').getSms()
        $('#step2').hide()
        $('#step3').hide()
        $('#setpBtn1').click(function() {
            $('#step1').hide()
            $('#step2').show()
            $('.step-con')
                .children('li')
                .eq(0)
                .removeClass('active')
            $('.step-con')
                .children('li')
                .eq(1)
                .addClass('active')
        })
        $('#setpBtn2').click(function(e) {
            var phoneVal = $('#mobile').val()
            if (phoneVal.length <= 0) {
                $('.alert:first')
                    .fadeIn()
                    .text('手机号码不能为空！')
                $('#mobile').focus()
                return false
            } else if (!/^1[34578]\d{9}$/.test(phoneVal)) {
                $('.alert:first')
                    .fadeIn()
                    .text('手机号码有误，请重填！')
                return false
            } else {
                $('#step2').hide()
                $('#step3').show()
                $('.step-con')
                    .children('li')
                    .eq(1)
                    .removeClass('active')
                $('.step-con')
                    .children('li')
                    .eq(2)
                    .addClass('active')
                e.preventDefault()
            }
        })
        $('#setpBtn3').click(function() {
            alert('跳转新产品')
        })
    })
})