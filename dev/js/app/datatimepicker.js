define(['jquery','datetimepicker'],function($){
    console.log('Module datetimepicker.init loaded.');
    $(function(){
        $('.form_datetime').datetimepicker({
            format: "yyyy-MM-dd",
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0,
            pickerPosition: "bottom-left"
        });
        $('.form_datetime1').datetimepicker({
            autoclose: 1,
            format: 'yyyy-mm-dd hh:ii',
            pickerPosition: "bottom-left"
        });
    });
});

