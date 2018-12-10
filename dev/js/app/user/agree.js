define(['helper', 'app/main', 'validator', 'canvas'], function (Helper) {

        $(function(){
            console.log('helo');
            $('#disagree').click(function(){
                window.location.href="//irv.iresearch.com.cn";
            });
            $('#agree').click(function () {
                Helper.post('agree', null, function (ret) {
                    console.log(ret);
                    if (ret.resCode == "000000") {
                        location.reload();
                    }else{
                        alert('网络传输失败');
                    }
                });
            });
        });

    }
);