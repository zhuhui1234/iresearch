/**
 * user login js
 */
define(['helper', 'app/main', 'validator', 'canvas'], function (Helper) {

    var height = window.innerHeight || (document.documentElement && document.documentElement.clientHeight) ||
        document.body.clientHeight;
    var width = window.innerWidth || (document.documentElement && document.documentElement.clientWidth) ||
        document.body.clientWidth;
    $(".main-image").css({
        height: height
    });
    $(".main").css({
        height: height
    });
    console.log(width);
    if(width >= 1000){
        var bodyH = (height-563)/2
        $("#jumbotron").css({"height":height+"px","padding-top":bodyH+"px","padding-bottom":bodyH+"px"});
    }


    $('.tab-p a').click(function () {
        $(this).addClass('actives').siblings().removeClass('actives');
    });

    function checkStart(){
        check(form);
    }

    function check(form) {
        var dataParams = {
            tel:$('#tel').val(),//手机号
            Emails:$('#Emails').val(),//邮箱
        };
        //手机号/邮箱验证正则
        var tel =  /^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/;
        var Emails = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/;
        $(".tab").each(function(){
            if($(this).hasClass('actives')== true){
                if ($(this).html() == '手机登录') {
                    if( !tel.test(dataParams.tel)
                    ){
                        $('#tip').show();
                    }else{
    //            console.log('数据完整');
                        $('#tip').hide();
    //            form.submit();
                    }
                }else if($(this).html() == '邮箱登录'){
                    if( !Emails.test(dataParams.Emails)
                    ){
                        $('#tip').show();
                    }else{
    //            console.log('数据完整');
                        $('#tip').hide();
    //            form.submit();
                    }
                }
            }
        });

    }

    $(document).ready(function () {
        $('#spinner').css('display',"none");
        $('.input-item .now:first').focus();
        $('.now').keydown(function (e) {
            e = window.event || evt;//兼容所有浏览器
            if (e.keyCode >= 48 && e.keyCode <= 57) {
                $(this).attr("type", "text");
            }

            return e.keyCode === 8 || (e.keyCode >= 48 && e.keyCode <= 57)
        });
        $('.now').keyup(function (e) {
            $(this).attr("type", "number");
            if (e.keyCode === 8 && $(this).index() !== 0 && !($(this).attr('fvalue'))) {
                $(this).prev().focus();
            }else

            if (e.keyCode >= 48 && e.keyCode <= 57) {
                //$(this).attr("type", "text");
                $(this).val(String.fromCharCode(e.keyCode));
            }
            $(this).attr('fvalue', $(this).val());
            //$(this).attr("type", "number");
            if (e.keyCode >= 48 && e.keyCode <= 57)
                if ($(this).index() < 6 && $(this).val() !== '') {
                    $(this).next('input').focus();
                }
            if ($(this).val() !== '' && $(this).next().val() !== '' && $(this).prev().val() !== '' && $(this).siblings()
                .val() !== '') {
                var Arr = [];
                var value = $('.input-item').find('.now');
                for (var i = 0; i < value.length; i++) {
                    Arr.push(value.eq(i).val())
                }
                $('#result').html(Arr.join(','));
                $('#spinner').css('display','block')
            }
        });
    });

});