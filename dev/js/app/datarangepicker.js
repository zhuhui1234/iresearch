define(['jquery','daterangepicker','moment'],function($,dt,moment) {
    console.log('Module daterangepicker loaded');
    $(function(){
        moment().format();
        moment.locale('zh-cn');
        $('#daterangepicker').daterangepicker({
            "ranges": {
                "今天": [
                    moment(),
                    moment()
                ],
                "昨天": [
                    moment().add(-1, 'day'),
                    moment().add(-1, 'day')
                ],
                "最近一周": [
                    moment(),
                    moment().add(7, 'day')
                ],
                "最近三个月": [
                    moment(),
                    moment().add(3,'month')
                ],
                "最近一年": [
                    moment(),
                    moment().add(1,'years')
                ]
            },
            "startDate": "2015-01-01",
            "endDate": "2015-02-01"
        }, function(start, end) {
            console.log(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
});

